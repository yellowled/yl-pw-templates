<?php
// Search page template

// look for a GET variable named 'q' and sanitize it
$q = $sanitizer->text($input->get->q);

if($q) {
    // Send our sanitized query 'q' variable to the whitelist where it will be
    // picked up and echoed in the search box by _main.php file.
    $input->whitelist('q', $q);

    // Sanitize for placement within a selector string.
    $q = $sanitizer->selectorValue($q);

    // Search title and body for query, limit results to 50 pages.
    $selector = "title|body~=$q, limit=50";

    // If user has access to admin pages, lets exclude them from the search results.
    if($user->isLoggedin()) $selector .= ", has_parent!=2";

    // Find pages that match the selector
    $matches = $pages->find($selector);

    if($matches->count) {
        $content = "<h3>$matches->count Treffer für Ihre Suchanfrage:</h3>";

        $content .= renderNav($matches, 0, 'summary');
    } else {
        $content = "<p>Keine Treffer für Ihre Suchanfrage.</p>";
    }

} else {
    // No search terms provided
    $content = "<p>Geben Sie bitte einen oder mehrere Suchbegriffe in das Suchformular ein.</p>";
}
