<?php
// Contact form page template

// Settings
// --------------------------------------------------------------------
// Form recipient
$emailTo = '';
// Default subject line
$emailSubject = 'Kontaktformular';
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


// Primary content is the page's body copy
$content = $page->body;


// Secondary content is a contact form
if(!$input->post->submit) {
    // If form was not yet submitted
    $content .= $formHint;
}

// check if the form was submitted
if($input->post->submit) {
    // check if site is empty
    if(!empty($form[site])) $error = $requiredFields;
    // determine if any fields were ommitted or didn't validate
    foreach($form as $key => $value) {
        // Exclude all fields which are *not* required
        if($key != 'site') {
            if(empty($value)) $error = $requiredFields;
        }
    }
    // if no errors, email the form results
    if(!$error) {
        $subject = $emailSubject;
        $message = '';
        $message .= "$form[name] ($form[mail])";
        $message .= ":\n\n$form[mesg]";
        // foreach($form as $key => $value) $message .= "$key: $value\n";
        mail($emailTo, $subject, $message, "From: $form[mail]");
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
    // Output the form
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
