<?php
/**
 * Creates an RSS feed using the MarkupRSS module
 */

// Template used for posts
$feedtpl = 'news';

// Generate feed
$rss = $modules->get("MarkupRSS");
$items = $pages->find("template=$feedtpl, sort=-modified, limit=10");
$rss->render($items);
