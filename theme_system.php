<?php
if (!isset($_SESSION)) session_start();
include "function.php";
include "data.php";

// ===================
// echo "<pre>";
// print_r($users);
// echo "</pre>";
// ===================
// L'utilisateur se connecte.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["username"]) && isset($_POST["password"])) {
    user_connect($_POST["username"], $_POST["password"], $users);
}
set_the_theme();
$theme = get_the_theme();


// ===================
