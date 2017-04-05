<?php
// ************************** SECURITY CHECKS **************************
//User Level 1
require "session1.php";
?>

<?php

// connect to the database
require "dbconn.php";

// Test to check if the database is connected
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
    {
	echo "Failed to connect to MYSQL: " . $connect->connect_error;
    }

// to store the record ID to be deleted by user
$volID = $_GET['volID'];

// set the query to delete the chosen record
$query = "DELETE FROM users WHERE volID = '".$volID."'";

// execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect);  
// go back to the previous page
header("Location: userListing_name.php");
// Exits the script
exit();
?>