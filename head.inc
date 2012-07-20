<?php // Global site header include file ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="de"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="de"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="de"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="de"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title><?php echo $page->get("headline|title"); ?></title>
	<meta name="description" content="<?php echo $page->summary; ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>css/style.css">
	<script src="<?php echo $config->urls->templates?>js/libs/modernizr-2.6.0.min.js"></script>
</head>
<body>
