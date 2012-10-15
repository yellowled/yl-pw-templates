<?php // Global site header include file ?>
<!doctype html>
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="de"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="de"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="de"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title><?php echo $page->get("headline|title"); ?></title>
	<meta name="description" content="<?php echo $page->summary; ?>">
	<meta name="viewport" content="width=device-width">
<!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/oldie.css">
<![endif]-->
<!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/master.css">
<!--<![endif]-->
	<script src="<?php echo $config->urls->templates?>scribts/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
<!--[if lt IE 7]> <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p> <![endif]-->
