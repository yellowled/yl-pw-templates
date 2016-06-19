<?php
/**
 * Contact form page template
 */

// Form recipient
$emailTo            = '';
// Default subject line
$emailSubject       = "[{$config->httpHost}] Kontaktformular";

$formHint           = _x('Mit einem Stern (*) markierte Felder sind Pflichtfelder und müssen ausgefüllt werden.', 'contact');
$formConfirm        = _x('Ihre Nachricht wurde erfolgreich versandt.', 'contact');
$requiredFields     = _x('Sie haben nicht alle Pflichtfelder korrekt ausgefüllt.', 'contact');
$form_name_label    = _x('Name', 'contact');
$form_name_place    = _x('z.B. Max Mustermann', 'contact');
$form_mail_label    = _x('E-Mail-Adresse', 'contact');
$form_mail_place    = _x('z.B. max@example.org', 'contact');
$form_hint_label    = _x('Website', 'contact');
$form_hint_place    = _x('Bitte hier nichts eingeben.', 'contact');
$form_mesg_label    = _x('Nachricht', 'contact');
$form_send_label    = _x('Senden', 'contact');


// Set and sanitize our form field values
$form = array(
    'name' => $sanitizer->text($input->post->name),
    'mail' => $sanitizer->email($input->post->mail),
    'site' => $sanitizer->text($input->post->site),
    'mesg' => $sanitizer->textarea($input->post->mesg),
);

// Initialize runtime vars
$sent = false;
$error = '';


// Primary content: page's body copy
$content = $page->body;

// Secondary content: contact form
if(!$input->post->submit) {
    // If form was not yet submitted
    $content .= "<p class='msg-warning'>$formHint</p>\n";
}

// Check if form was submitted
if($input->post->submit) {
    // Check if site is empty
    if(!empty($form[site])) $error = "<p class='msg-warning'>$requiredFields</p>\n";
    // Determine if any fields were ommitted or didn't validate
    foreach($form as $key => $value) {
        // Exclude all fields which are *not* required
        if($key != 'site') {
            if(empty($value)) $error = "<p class='msg-warning'>$requiredFields</p>\n";
        }
    }
    // No errors, email the form results
    if(!$error) {
        $headers  = "From: $form[mail]\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
        $headers .= "Content-Transfer-Encoding: quoted-printable\r\n";
        $subject  = $emailSubject;
        $message  = '';
        $message .= "$form[name] ($form[mail])";
        $message .= ":\n\n$form[mesg]";

        mail($emailTo, $subject, $message, $headers);
        $sent = true;
    }
}

if($sent) {
    $content .= "<p class='msg-success'>$formConfirm</p>\n";
} else {
    // Encode values for placement in markup
    foreach($form as $key => $value) {
        $form[$key] = htmlentities($value, ENT_QUOTES, "UTF-8");
    }
    // Emit the form
    $content .= $error;
    $content .= "<form action='./' method='post'>\n";
    $content .= "<div class='form-field'>\n";
    $content .= "<label for='fullname'>{$form_name_label}*</label>\n";
    $content .= "<input id='fullname' name='name' type='text' value='' placeholder='$form_name_place' required>\n";
    $content .= "</div>\n";
    $content .= "<div class='form-field'>\n";
    $content .= "<label for='email'>{$form_mail_label}*</label>\n";
    $content .= "<input id='email' name='mail' type='email' value='' placeholder='$form_mail_place' required>\n";
    $content .= "</div>\n";
    $content .= "<div class='form-hide'>\n";
    $content .= "<label for='site'>{$form_hint_label}</label>\n";
    $content .= "<input id='site' name='site' type='text' value='' placeholder='$form_hint_place'>\n";
    $content .= "</div>\n";
    $content .= "<div class='form-area'>\n";
    $content .= "<label for='comments'>{$form_mesg_label}*</label>\n";
    $content .= "<textarea id='comments' name='mesg' rows='10' required></textarea>\n";
    $content .= "</div>\n";
    $content .= "<input name='submit' type='submit' value='$form_send_label'>\n";
    $content .= "</form>\n";
}
