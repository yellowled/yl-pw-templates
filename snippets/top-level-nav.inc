<ul>
<?php
    // nav items: homepage and its visible children
    foreach($homepage->and($homepage->children) as $item) {
        if($item->id == $page->rootParent->id) echo "<li class='current'>";
        else echo "<li>";
        echo "<a href='$item->url'>$item->title</a></li>";
    }
?>
</ul>
