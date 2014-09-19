<?php
// if page's summary field is empty, use the summary of the home page
if($page->summary != '') {
    //
    echo "<meta name='description' content='{$page->summary}'>";
} else {
    echo "<meta name='description' content='{$pages->get(1)->summary}'>";
} ?>
