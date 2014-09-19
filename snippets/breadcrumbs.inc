<div class="breadcrumb">
<?php
// cycle through current $page's parents
foreach($page->parents as $parent) {
    echo "<a href='{$parent->url}'>{$parent->title}</a><span> » </span>";
}
echo "{$page->title}";
?>
</div>
