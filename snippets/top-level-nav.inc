<ul>
<?php
    // list children of homepage
    $homepage = $pages->get("/");
    $children = $homepage->children;
    // prepend homepage to pages array to include it
    $children->prepend($homepage);

    foreach($children as $child) {
        // indicate current section with class='on'
        $class = $child === $page->rootParent ? " class='on'" : '';
        echo "<li><a$class href='{$child->url}'>{$child->title}</a></li>";
    }
?>
</ul>
