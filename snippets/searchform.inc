<form id="search_form" action='<?php echo $config->urls->root?>suche/' method="get">
    <div>
        <label for="search_query" class="visuallyhidden">Suche</label>
        <input  id="search_query" name="q" type="search" value='<?php echo htmlentities($input->whitelist('q'), ENT_QUOTES, 'UTF-8'); ?>' placeholder="Suchbegriffe(e)">
        <input id="search_submit" type="submit" value="Suche">
    </div>
</form>
