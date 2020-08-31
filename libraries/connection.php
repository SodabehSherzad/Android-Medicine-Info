<?php

	// Set the database access information as constants.
	define("HOST", "localhost:3306");
	define("USERNAME", "root");
	define("PASSWORD", "");
	define("DATABASE", "medicineinfo");
	
	// Make the connection.
	$GLOBALS['DB'] = @mysqli_connect(HOST,USERNAME,PASSWORD, DATABASE);
	if (!$GLOBALS['DB']) {
	  echo 'Error No. ' . mysqli_connect_errno() . PHP_EOL . '<br>';
	  echo 'Error: ' . mysqli_connect_error() . PHP_EOL . '<br>';
	  exit('Error: Unable to connect to MySQL' . PHP_EOL);
	}
	
	// Set proper character sets
	mysqli_set_charset($GLOBALS['DB'], 'utf8');