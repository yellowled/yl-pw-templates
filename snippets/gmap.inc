<?php
// Create a map for gmaps.js from Google Map Marker field
echo "<div id='map' class='map' data-lat='{$page->event_map->lat}' data-lng='{$page->event_map->lng}' data-zoom='{$page->event_map->zoom}'>";
echo "<span><a href='https://maps.google.de/maps?q={$page->event_map->address}'>{$page->event_map->address}</a></span>";
echo "</div>";
