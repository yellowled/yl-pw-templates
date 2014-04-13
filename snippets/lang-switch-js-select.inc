<select onchange='window.location=$(this).val();'>
<?php
// only works w/ active JS
    foreach($languages as $language) {
        $selected = '';
        // if this page isn't viewable (active) for the language, skip it
        if(!$page->viewable($language)) continue;
        // if language is current user's language, make it selected
        if($user->language->id == $language->id) $selected = " selected=selected";
        // determine the "local" URL for this language
        $url = $page->localUrl($language);
        // output the option tag
        echo "<option$selected value='$url'>$language->title</option>";
    }
?>
</select>
