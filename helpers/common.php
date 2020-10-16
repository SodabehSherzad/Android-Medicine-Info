<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// set time zone to use date/time functions without warnings
date_default_timezone_set('Asia/Kabul');

// set true if production environment else false for development
define('IS_ENV_PRODUCTION', true);

// configure error reporting options
if (IS_ENV_PRODUCTION) {
    ini_set('display_errors', 0); // Don't display errors
    error_reporting(0);          // Turn OFF all error reporting
    ini_set('error_log', '../log/php_errors.log'); // Log the errors permanently
} else {
    ini_set('display_errors', 1); // Show display errors
    ini_set('display_startup_errors', 1); // Show display startup errors
    error_reporting(E_ALL); // Turn ON all error reporting
    ini_set('error_log', 'C:\\Windows\\temp\\php_errors.log'); // Log the errors temporarily
}

function clean_data($data)
{
    return htmlspecialchars(trim($data));
}

// set preferred language
if (isset($_COOKIE['lang'])) {
    $language = $_COOKIE['lang'];
    include("../lang/$language.php");
} else {
    $language = "en";
    include("../lang/$language.php");
}
