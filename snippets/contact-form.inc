<?php
// Some variables which need to be set manually or through a page field
// --------------------------------------------------------------------
// Form recipient
$emailTo = '';
// Default subject line
$emailSubject = 'Kontaktformular';
// Emitted before the form
$formHint = '<p>Mit einem Stern (*) markierte Felder sind Pflichtfelder und <strong>müssen</strong> ausgefüllt werden.</p>';
// Emitted after form has been sent
$formConfirm = '<p>Ihre Nachricht wurde erfolgreich versandt.';
// Emitted if not all required fields have been filled out
$requiredFields = '<p>Sie haben nicht alle Pflichtfelder korrekt ausgefüllt.</p>';
// --------------------------------------------------------------------

// set and sanitize our form field values
$form = array(
    'name' => $sanitizer->text($input->post->name),
    'mail' => $sanitizer->email($input->post->mail),
    'site' => $sanitizer->text($input->post->site),
    'mesg' => $sanitizer->textarea($input->post->mesg),
);
// initialize runtime vars
$sent = false;
$error = '';
// If form was not yet submitted
if(!$input->post->submit) {
    echo $formHint;
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
        mail($emailTo, $subject, $message, "From: $form[email]");
        $sent = true;
    }
}
if($sent) {
    echo $formConfirm;
} else {
    // encode values for placement in markup
    foreach($form as $key => $value) {
        $form[$key] = htmlentities($value, ENT_QUOTES, "UTF-8");
    }
    // output the form
    echo <<< _OUT

    $error
    <form action="./" method="post">
        <div class="form-field">
            <label for="fullname">Name</label>
            <input id="fullname" name="name" type="text" value="" placeholder="z.B. Max Mustermann">
        </div>

        <div class="form-field">
            <label for="email">E-Mail-Adresse*</label>
            <input id="email" name="mail" type="email" value="" placeholder="z.B. max@example.org" required>
        </div>

        <div class="form-hide">
            <label for="site">Website</label>
            <input id="site" name="site" type="text" value="" placeholder="Bitte hier nichts eingeben.">
        </div>

        <div class="form-area">
            <label for="comments">Nachricht*</label>
            <textarea id="comments" name="mesg" rows="10" required></textarea>
        </div>

        <input name="submit" type="submit" value="Senden">
    </form>
_OUT;
}
