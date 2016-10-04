<?php namespace ProcessWire;

/**
 * Shared functions used by template files
 */

/**
 * Render a breadcrumb navigation for the current page
 *
 * @param string $seperator A character used to seperate breadcrumb links
 * @return string
 *
 */

function renderBreadcrumbs($seperator = '»') {
    $page = wire('page');

    $out = '';

    foreach($page->parents as $parent) {
        $out .= "<a href='{$parent->url}'>{$parent->title}</a><span> " . $seperator ." </span>";
    }

    $out .= "$page->title";

    $out = "<nav class='breadcrumb' role='navigation'>$out</nav>";

    return $out;
}


/**
 * Render canonical URL link
 *
 * @param string $canonical The full canonical URL of the site (set in _init.php)
 * @return string
 *
 */

function renderCanonical($canonical) {
    $page = wire('page');

    if ($canonical != '') {
        $out = "    <link rel='canonical' href='$canonical$page->url'>\n";
    } else {
        $out = '';
    }

    return $out;
}


/**
 * Render page edit link
 *
 * @return string
 *
 */

function renderEditLink() {
    $page = wire('page');

    $out = '';

    if($page->editable()) $out .= "<a id='edit' href='$page->editURL'>Edit</a>";

    return $out;
}


/**
 * Given a group of pages, render a <ul> navigation
 *
 * @param array|PageArray $items
 * @param int $depth How many levels of navigation below current should it go?
 * @param string $fieldNames Any extra field names to display (separate multiple fields with a space)
 * @return string
 *
 */
function renderNav($items, $maxDepth = 0, $fieldNames = '') {
	// if we were given a single Page rather than a group of them, we'll pretend they
	// gave us a group of them (a group/array of 1)
	if($items instanceof Page) $items = array($items);

	$out = '';

	foreach($items as $item) {
		// if current item is the same as the page being viewed, add a "current" class to it
		$out .= $item->id == wire('page')->id ? "<li class='current'>" : "<li>";
		$out .= "<a href='$item->url'>$item->title</a>";

		// if there are extra field names specified, render markup for each one in a <div>
		// having a class name the same as the field name
		if($fieldNames) foreach(explode(' ', $fieldNames) as $fieldName) {
			$value = $item->get($fieldName);
			if($value) $out .= " <div class='$fieldName'>$value</div>";
		}

		// if the item has children and we're allowed to output tree navigation (maxDepth)
		// then call this same function again for the item's children
		if($item->hasChildren() && $maxDepth) {
			$out .= renderNav($item->children, $maxDepth-1, $fieldNames);
		}

		$out .= "</li>";
	}

	if($out) $out = "<ul>$out</ul>";

	return $out;
}
