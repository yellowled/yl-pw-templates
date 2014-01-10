<?php // Global site header include file ?>
<!doctype html>
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="de"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="de"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="de"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title><?php echo $page->get("headline|title"); ?></title>
	<meta name="description" content="<?php echo $page->summary; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/oldie.css">
<![endif]-->
<!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/master.css">
<!--<![endif]-->
	<script src="<?php echo $config->urls->templates?>scripts/modernizr/modernizr.js"></script>
</head>
<body>
<!--[if lt IE 8]> <p id="old-ie" class="chromeframe">Ihr Browser ist veraltet! <a href="http://browsehappy.com/">Verwenden Sie einen anderen Browser</a> oder <a href="http://www.google.com/chromeframe/?redirect=true">installieren Sie Google Chrome Frame</a>, damit diese Website korrekt angezeigt wird.</p> <![endif]-->
<p id="enable-js" class="chromeframe">Damit diese Website korrekt und mit vollem Funktionsumfang angezeigt wird, benötigen Sie JavaScript. <a href="http://www.enable-javascript.com/de/">Wie Sie JavaScript in Ihrem Browser einschalten</a>.</p>