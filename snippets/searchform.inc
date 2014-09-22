<form id="search_form" action='<?php echo $pages->get('template=search')->url; ?>' method="get">
    <div>
        <label for="search_query">Suche</label>
        <input id="search_query" name="q" type="search" value='<?php echo $sanitizer->entities($input->whitelist('q')); ?>' placeholder="Suchbegriffe(e)">
        <input id="search_submit" type="submit" value="Suche">
    </div>
</form>
