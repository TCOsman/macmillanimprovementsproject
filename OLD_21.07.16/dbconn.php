<?php

$host = "localhost"; 		// server
$user = "root"; 			// user identification
$password = "";				// chosen password
$database = "mcl";      	// database

$connect = new mysqli ($host, $user, $password, $database);
	if ($connect -> connect_errno)
		{
			echo "Failed to connect to MySQL: " . $connect -> connect_error;
		}
?>