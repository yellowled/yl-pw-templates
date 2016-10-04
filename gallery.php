<?php namespace ProcessWire;
/**
 * Gallery page template
 */

// Thumbnails per page
$thumb_per_page = 9;
// Thumbnail dimensions
$thumb_width    = 200;
$thumb_height   = 150;
// Pager labels
$pager_next     = _x('Weiter', 'gallery');
$pager_prev     = _x('Zurück', 'gallery');

$gallery_start = ($input->pageNum - 1) * $thumb_per_page;
$gallery_total = count($page->images);
$gallery_images = $page->images->slice($gallery_start,$thumb_per_page);

$a = new PageArray();
foreach ($gallery_images as $unused) $a->add(new Page());

$a->setTotal($gallery_total);
$a->setLimit($thumb_per_page);
$a->setStart($gallery_start);

// Primary content: page's body copy
$content = $page->body;

// Secondary content: image gallery
$content .= "\n<ul class='gallery'>\n";
foreach ($gallery_images as $item) {
    $thumb = $item->size($thumb_width,$thumb_height);
    $content .= "<li><a href='{$item->url}' title='{$item->description}'><img src='{$thumb->url}' alt='{$item->description}'></a></li>\n";
}
$content .= "</ul>\n";

// Emit pager
$content .= $a->renderPager(array(
    'nextItemLabel' => $pager_next,
    'previousItemLabel' => $pager_prev,
    'nextItemClass' => "gallery-next",
    'previousItemClass' => "gallery-prev",
    'currentItemClass' => "gallery-current",
    'listMarkup' => "<ul class='gallery-pager'>{out}</ul>",
    'itemMarkup' => "<li class='{class}'>{out}</li>",
    'linkMarkup' => "<a href='{url}'>{out}</a>"
));
