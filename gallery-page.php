<?php
// Gallery page template

// Settings
$thumb_per_page = 9;
$thumb_width    = 200;
$thumb_height   = 150;

$gallery_start = ($input->pageNum - 1) * $thumb_per_page;
$gallery_total = count($page->images);
$gallery_images = $page->images->slice($gallery_start,$thumb_per_page);

$a = new PageArray();
foreach ($gallery_images as $unused) $a->add(new Page());

$a->setTotal($gallery_total);
$a->setLimit($thumb_per_page);
$a->setStart($gallery_start);

// Primary content is the page's body copy
$content = $page->body;

// Secondary content is an image gallery
$content .= "\n\n<ul class='gallery'>\n";
foreach ($gallery_images as $item) {
    $thumb = $item->size($thumb_width,$thumb_height);
    $content .= "<li><a href='{$item->url}'><img src='{$thumb->url}' alt='{$item->description}'></a></li>\n";
}
$content .= "</ul>\n";

// Pager
$content .= $a->renderPager(array(
    'nextItemLabel' => 'Weiter &raquo;',
    'previousItemLabel' => '&laquo; Zurück',
    'listMarkup' => "<ul class='pager'>{out}</ul>",
    'itemMarkup' => "<li>{out}</li>",
    'linkMarkup' => "<a href='{url}'>{out}</a>"
));
