<?php
/**
 * Search page template
 */

// Search form texts
$matches_found  = _x('Treffer für Ihre Suchanfrage', 'search');
$matches_none   = _x('Keine Treffer für Ihre Suchanfrage', 'search');
$no_terms       = _x('Geben Sie bitte einen oder mehrere Suchbegriffe in das Suchformular ein.', 'search');
$search_label   = _x('Suchbegriffe(e)', 'search');
$search_button  = _x('Suchen', 'search');

// Sanitite GET variable named 'q'
$q = $sanitizer->text($input->get->q);

if($q) {
    // Send sanitized query 'q' to the whitelist where it will be
    // picked up and echoed in the search box by _main.php file.
    $input->whitelist('q', $q);

    // Sanitize for placement within a selector string.
    $q = $sanitizer->selectorValue($q);

    // Search title and body for query, limit results to 50 pages.
    $selector = "title|body~=$q, limit=50";

    // If user has access to admin pages, exclude them from search results.
    if($user->isLoggedin()) $selector .= ", has_parent!=2";

    // Find pages that match the selector
    $matches = $pages->find($selector);

    if($matches->count) {
        $content = "<h3>$matches->count $matches_found</h3>";

        $content .= renderNav($matches, 0, 'summary');
    } else {
        $content = "<p class='msg-warning'>$matches_none</p>\n";
    }

} else {
    // No search terms provided
    $content = "<p class='msg-warning'>$no_terms</p>\n";
}

// Emit search form
$action = $pages->get('template=search')->url;

$content .= "<form id='search-form' action='$action' method='get'>\n";
$content .= "<label for='search-query'>$search_label</label>\n";
$content .= "<input id='search-query' name='q' type='search' value='$q'>\n";
$content .= "<input type='submit' value='$search_button'>\n";
$content .= "</form>\n";
