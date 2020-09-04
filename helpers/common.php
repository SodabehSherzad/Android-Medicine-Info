<?php

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
    include("../lang/en.php");
}
