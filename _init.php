<?php

/**
 * Initialize variables output in _main.php
 *
 * This file is automatically prepended to all template files as a result of:
 * $config->prependTemplateFile = '_init.php'; in /site/config.php.
 */

// Helper variables
$homepage = $pages->get('/');

// Meta data
$title = $page->get('headline|title');
$description = $page->summary;

// Content regions
$content = $page->body;

// Include shared functions
include_once("./_func.php");
