<?php
if($user->isLoggedin()) {
    // user is logged in, show logout link
    echo "<a href='{$config->urls->admin}login/logout/'>Logout ($user->name)</a>";
} else {
    // user not logged in, show login link
    echo "<a href='{$config->urls->admin}'>Admin Login</a>";
}
?>
