<?php

/**
 * Initialize variables output in _main.php
 *
 * This file is automatically prepended to all template files as a result of:
 * $config->prependTemplateFile = '_init.php'; in /site/config.php.
 */

// Settings
$canonicalURL = '';

// Helper variables
$homepage = $pages->get('/');

// Meta data
$title = $page->title;
// if page's summary field is empty, use the summary of the home page
if($page->summary != '') {
    $description = $page->summary;
} else {
    $description = $pages->get(1)->summary;
}

// Content regions
$headline = $page->get('headline|title');
$content = $page->body;

// Include shared functions
include_once("./_func.php");
