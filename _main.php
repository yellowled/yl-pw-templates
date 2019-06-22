<?php namespace ProcessWire;

/**
 * _main.php
 *
 * This file is automatically appended to all template files as a result of
 * $config->appendTemplateFile = '_main.php'; in /site/config.php.
 *
 */
?><!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>">
<?php echo renderCanonical($canonicalURL); ?>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/main.css">
</head>
<body>
    <main role="main">
        <article>
            <h1><?php echo $headline; ?></h1>

            <?php echo $content; ?>
        </article>
    </main>

    <script src="<?php echo $config->urls->templates?>scripts/main.js"></script>
</body>
</html>
