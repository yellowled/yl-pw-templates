<?php
// emit "Edit" link if page is editable by current user
if($page->editable()) echo "<a href='$page->editURL' class='edit'>Edit</a>";
