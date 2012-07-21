<ul><?php
// cycle through current $page's parents
foreach($page->parents as $parent) {
	echo "<li><a href='{$parent->url}'>{$parent->title}</a> » </li>";
}
?></ul>
