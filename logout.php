<?php
session_start();
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $yesterday = time() - (24 * 60 * 60);
    $params = session_get_cookie_params();
    setcookie(session_name (), '', $yesterday,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
header("location: index.php?logout=success");
?>
