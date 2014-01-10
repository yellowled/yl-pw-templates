<?php
// Search template
$out = '';
if($q = $sanitizer->selectorValue($input->get->q)) {
	// Send sanitized 'q' to whitelist; will be picked up and echoed in search box by head.inc.
	$input->whitelist('q', $q);
	// Search title, body and sidebar for query, limit results to 50 pages, excludes 'admin'.
	$matches = $pages->find("title|body|sidebar~=$q, limit=50");
	$count = count($matches);

	if($count) {
		$out .= "<h3>$count Treffer für Ihre Suchanfrage:</h3>" . "<ul>";

		foreach($matches as $m) {
			$out .= "<li><a href='{$m->url}'>{$m->title}</a></li>";
		}

		$out .= "</ul>";
	} else {
		$out .= "<p>Keine Treffer für Ihre Suchanfrage.</p>";
	}
} else {
	$out .= "<p>Geben Sie bitte einen oder mehrere Suchbegriffe in das Suchformular ein.</p>";
}

include("./head.inc");

echo $out;

include("./foot.inc");
