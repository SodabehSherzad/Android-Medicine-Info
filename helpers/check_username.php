<?php

require_once('../libraries/connection.php');
$valid = 'true';

if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($GLOBALS['DB'],$_POST['username']);
    $sql = sprintf('SELECT user_name FROM users WHERE user_name = "%s" LIMIT 1', $username);
    $result = mysqli_query($GLOBALS['DB'], $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $valid = 'false';
    }
}


echo $valid;
