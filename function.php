<?php

// Fonction de création de cookie
function SetCookieLive($name, $value = '', $expire = 0, $path = '', $domain = '', $secure = false, $httponly = false)
{
    $_COOKIE[$name] = $value;
    return setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
}


function user_connect($entry_login, $entry_password, $list_of_users)
{
    // Système de connexion je boucle sur chaque utilisateur pour trouver celui correspondant avec les données de l'utilsateur.
    for ($i = 1; $i <= 3; $i++) {
        // Si les données correspondent.
        if (($list_of_users[$i]["login"] == $entry_login) && ($list_of_users[$i]["password"] == $entry_password)) {
            // Je stock l'ID du user.
            $_SESSION["user_id"] = $i;
        };
    }
}

function set_the_theme()
{
    // Variable par défaut si cette variable est affiché, le code n'est pas bon.
    $theme = "light default";
    $cookietheme = $_COOKIE['theme_cookie'];
    // Est-il connecté ?
    if (isset($_SESSION["user_id"])) {
        // =============OUI=============
        // Récupération du thème de l'utilisateur
        if (isset($cookietheme[0])) {
            $theme = $cookietheme[0];
        }
        // L'utilisateur appui sur le bouton, la valeur du cookie doit changer.
        if (isset($_POST['dark']) || isset($_POST['light'])) {
            $theme = isset($_POST['dark']) ? 'dark' : 'light';
        }
        SetCookieLive("theme_cookie[0]", $theme, strtotime('+7 days'), "/");
        SetCookieLive("theme_cookie[1]", $_SESSION["user_id"], strtotime('+7 days'), "/");
    } else {
        // =============NON=============
        // L'utilisateur appui sur le bouton
        if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
            $theme = isset($_POST['dark']) ? 'dark' : 'light';
        }
        // Création/Edition du cookie.
        SetCookieLive("theme_cookie", $theme, strtotime('+7 days'), "/");
    }
}

function get_the_theme()
{
    $theme = "light";
    if (isset($_COOKIE["theme_cookie[1]"]) && isset($_SESSION["user_id"])) {
        // L'utilisateur est t'il le même que que la dernière fois ?
        if (($_COOKIE["theme_cookie[1]"] == $_SESSION["user_id"])) {
            $theme = $_COOKIE["theme_cookie[0]"];
        }
    } elseif (!is_array($_COOKIE["theme_cookie"])) {
        $theme = $_COOKIE["theme_cookie"];
    }
    return $theme;
}
