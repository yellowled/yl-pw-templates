<?php
/**
 * Search page template
 *
 */

// Search form texts
$matches_found  = 'Treffer für Ihre Suchanfrage';
$matches_none   = '<p>Keine Treffer für Ihre Suchanfrage.</p>';
$no_terms       = '<p>Geben Sie bitte einen oder mehrere Suchbegriffe in das Suchformular ein.</p>';

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
        $content = $matches_none;
    }

} else {
    // No search terms provided
    $content = $no_terms;
}

// Emit search form
$action = $pages->get('template=search')->url;

$content .= "<form id='search_form' action='$action' method='get'>\n";
$content .= "<div>\n";
$content .= "<label for='search_query'>Suche</label>\n";
$content .= "<input id='search_query' name='q' type='search' value='$q' placeholder='Suchbegriffe(e)'>\n";
$content .= "<input id='search_submit' type='submit' value='Suche'>\n";
$content .= "</div>\n";
$content .= "</form>\n";
