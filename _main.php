<?php

/**
 * _main.php
 *
 * This file is automatically appended to all template files as a result of
 * $config->appendTemplateFile = '_main.php'; in /site/config.php.
 *
 */
?><!doctype html>
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="de"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="de"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="de"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $description; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="dns-prefetch" href="//ajax.googleapis.com">
<!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/oldie.css">
<![endif]-->
<!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/master.css">
<!--<![endif]-->
    <script src="<?php echo $config->urls->templates?>scripts/modernizr/modernizr.js"></script>
</head>
<body>
	<!-- top navigation -->
	<ul class='topnav'>
		<?php
		// top navigation consists of homepage and its visible children
		foreach($homepage->and($homepage->children) as $item) {
			if($item->id == $page->rootParent->id) echo "<li class='current'>";
				else echo "<li>";
			echo "<a href='$item->url'>$item->title</a></li>";
		}

		// output an "Edit" link if this page happens to be editable by the current user
		if($page->editable()) echo "<li class='edit'><a href='$page->editURL'>Edit</a></li>";
		?>
	</ul>

	<form class='search' action='<?php echo $pages->get('template=search')->url; ?>' method='get'>
		<input type='text' name='q' placeholder='Search' value='<?php echo $sanitizer->entities($input->whitelist('q')); ?>' />
		<button type='submit' name='submit'>Search</button>
	</form>

	<!-- breadcrumbs -->
	<div class='breadcrumbs'>
		<?php
		// breadcrumbs are the current page's parents
		foreach($page->parents() as $item) {
			echo "<span><a href='$item->url'>$item->title</a></span> ";
		}
		// optionally output the current page as the last item
		echo "<span>$page->title</span> ";
		?>
	</div>

	<div id='main'>

		<!-- main content -->
		<div id='content'>
			<h1><?php echo $title; ?></h1>
			<?php echo $content; ?>
		</div>

		<!-- sidebar content -->
		<?php if($sidebar): ?>
		<div id='sidebar'>
			<?php echo $sidebar; ?>
		</div>
		<?php endif; ?>

	</div>

	<!-- footer -->
	<footer id='footer'>
		<p>
		Powered by <a href='http://processwire.com'>ProcessWire CMS</a>  &nbsp; / &nbsp;
		<?php
		if($user->isLoggedin()) {
			// if user is logged in, show a logout link
			echo "<a href='{$config->urls->admin}login/logout/'>Logout ($user->name)</a>";
		} else {
			// if user not logged in, show a login link
			echo "<a href='{$config->urls->admin}'>Admin Login</a>";
		}
		?>
		</p>
	</footer>

<!--[if lt IE 8]> <p id="old-ie" class="chromeframe">Ihr Browser ist veraltet! <a href="http://browsehappy.com/">Verwenden Sie einen anderen Browser</a> oder <a href="http://www.google.com/chromeframe/?redirect=true">installieren Sie Google Chrome Frame</a>, damit diese Website korrekt angezeigt wird.</p> <![endif]-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo $config->urls->templates?>scripts/jquery/dist/jquery.min.js"><\/script>')</script>
    <script src="<?php echo $config->urls->templates?>scripts/master.js"></script>
</body>
</html>
