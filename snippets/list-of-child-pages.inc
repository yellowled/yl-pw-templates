<?php
// List linked child pages of current page
if($page->numChildren) {
    echo "<ul>";

    foreach($page->children as $child) {
        echo "<li><a href='{$child->url}'>{$child->title}</a></li>";
    }

    echo "</ul>";
}
?>
