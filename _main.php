<?php

/**
 * _main.php
 *
 * This file is automatically appended to all template files as a result of
 * $config->appendTemplateFile = '_main.php'; in /site/config.php.
 *
 */
?><!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="de"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="de"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>">
<?php echo renderCanonical($canonicalURL); ?>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="dns-prefetch" href="//ajax.googleapis.com">
    <link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/master.css">
    <script src="<?php echo $config->urls->templates?>scripts/modernizr/modernizr.js"></script>
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <main>
        <article>
            <h1><?php echo $headline; ?></h1>

            <?php echo $content; ?>
        </article>
    </main>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo $config->urls->templates?>scripts/jquery/dist/jquery.min.js"><\/script>')</script>
    <script src="<?php echo $config->urls->templates?>scripts/master.js"></script>
</body>
</html>
