<?php
// Number of thumbnails per page
$per_page = 9;
// Thumbnail size
$thumb_width = 200;
$thumb_height = 150;

$start = ($input->pageNum - 1) * $per_page;
$total = count($page->images);
$images = $page->images->slice($start,$per_page);
$a = new PageArray();
foreach ($images as $unused) $a->add(new Page());
$a->setTotal($total);
$a->setLimit($per_page);
$a->setStart($start);

// Gallery
echo "<ul class='gallery'>";
foreach ($images as $item) {
    // thumbnail size
    $thumb = $item->size($thumb_width,$thumb_height);
    echo "<li><a href='{$item->url}'><img src='{$thumb->url}' alt='{$item->description}'></a></li>";
}
echo "</ul>";

// Pager
echo $a->renderPager(array(
    'nextItemLabel' => 'Weiter &raquo;',
    'previousItemLabel' => '&laquo; Zurück',
    'listMarkup' => "<ul class='pager'>{out}</ul>",
    'itemMarkup' => "<li>{out}</li>",
    'linkMarkup' => "<a href='{url}'>{out}</a>"
));
