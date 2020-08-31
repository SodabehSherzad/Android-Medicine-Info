<?php
	require_once "config/config.php";

	$link = @mysqli_connect(HOST,USERNAME,PASSWORD, DATABASE);
	if(!$link) {
		die('I cannot connect to MySQL Server. ' . mysqli_connect_error());
	}