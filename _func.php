<?php

/**
 * Shared functions used by template files
 */

/**
 * Render a breadcrumb navigation for the current page
 *
 * @return string
 *
 */

function renderBreadcrumbs() {
    $page = wire('page');

    $out = '';

    foreach($page->parents as $parent) {
        $out .= "<a href='{$parent->url}'>{$parent->title}</a><span> » </span>";
    }

    $out .= "$page->title";

    $out = "<div class='breadcrumb'>$out</div>";

    return $out;
}


/**
 * Render page edit link
 *
 * @param page $current The current $page
 * @return string
 *
 */

function renderEditLink($current) {
    $out = '';

    if($current->editable()) $out .= "<a href='$current->editURL' class='edit'>Edit</a>";

    return $out;
}


/**
 * Render markup for a GoogleMap with gmaps.js and the GoogleMaps marker module
 *
 * @param string $latitude  Latitude value
 * @param string $longitude Longitude value
 * @param string $zoom      Zoom value
 * @param string $address   Street address value
 * @param string $id        HTML id for the map container
 * @return string
 *
 */

function renderGoogleMap($latitude, $longitude, $zoom, $address, $id = 'map') {
    $out = '';

    $out .= "<div id='$id' class='map' data-lat='$latitude' data-lng='$longitude' data-zoom='$zoom'>\n";
    $out .= "<span><a href='https://maps.google.de/maps?q=$address'>$address</a></span>\n";
    $out .= "</div>\n";

    return $out;
}


/**
 * Given a group of pages, render a <ul> navigation
 *
 * @param array|PageArray $items
 * @param int $depth How many levels of navigation below current should it go?
 * @param string $fieldNames Any extra field names to display (separate multiple fields with a space)
 * @param string $class CSS class name for containing <ul>
 * @return string
 *
 */
function renderNav($items, $maxDepth = 0, $fieldNames = '', $class = 'nav') {
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
			if($class == 'nav') $class = 'nav nav-tree';
			$out .= renderNav($item->children, $maxDepth-1, $fieldNames, $class);
		}

		$out .= "</li>";
	}

	if($out) $out = "<ul class='$class'>$out</ul>";

	return $out;
}
