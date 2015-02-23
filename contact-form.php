<?php
/**
 * Contact form page template
 *
 */

// Form recipient
$emailTo = '';
// Default subject line
$emailSubject = "[{$config->httpHost}] Kontaktformular";
// Emitted before the form
$formHint = "<p>Mit einem Stern (*) markierte Felder sind Pflichtfelder und <strong>müssen</strong> ausgefüllt werden.</p>\n";
// Emitted after form has been sent
$formConfirm = "<p>Ihre Nachricht wurde erfolgreich versandt.</p>\n";
// Emitted if not all required fields have been filled out
$requiredFields = "<p>Sie haben nicht alle Pflichtfelder korrekt ausgefüllt.</p>\n";

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
    $content .= $formHint;
}

// Check if form was submitted
if($input->post->submit) {
    // Check if site is empty
    if(!empty($form[site])) $error = $requiredFields;
    // Determine if any fields were ommitted or didn't validate
    foreach($form as $key => $value) {
        // Exclude all fields which are *not* required
        if($key != 'site') {
            if(empty($value)) $error = $requiredFields;
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
    $content .= $formConfirm;
} else {
    // Encode values for placement in markup
    foreach($form as $key => $value) {
        $form[$key] = htmlentities($value, ENT_QUOTES, "UTF-8");
    }
    // Emit the form
    $content .= $error;
    $content .= "<form action='./' method='post'>\n";
    $content .= "<div class='form-field'>\n";
    $content .= "<label for='fullname'>Name</label>\n";
    $content .= "<input id='fullname' name='name' type='text' value='' placeholder='z.B. Max Mustermann' required>\n";
    $content .= "</div>\n";
    $content .= "<div class='form-field'>\n";
    $content .= "<label for='email'>E-Mail-Adresse*</label>\n";
    $content .= "<input id='email' name='mail' type='email' value='' placeholder='z.B. max@example.org' required>\n";
    $content .= "</div>\n";
    $content .= "<div class='form-hide'>\n";
    $content .= "<label for='site'>Website</label>\n";
    $content .= "<input id='site' name='site' type='text' value='' placeholder='Bitte hier nichts eingeben.'>\n";
    $content .= "</div>\n";
    $content .= "<div class='form-area'>\n";
    $content .= "<label for='comments'>Nachricht*</label>\n";
    $content .= "<textarea id='comments' name='mesg' rows='10' required></textarea>\n";
    $content .= "</div>\n";
    $content .= "<input name='submit' type='submit' value='Senden'>\n";
    $content .= "</form>\n";
}
