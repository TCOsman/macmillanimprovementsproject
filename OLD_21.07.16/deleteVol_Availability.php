<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
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

// to store the record id to be deleted by user
$availID = $_GET['availID'];

// set the query to delete the chosen record
$query = "DELETE FROM vol_availability WHERE availID = '".$availID."'";

// execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect); 
// Deletes the buffer	
header("Location: availabilityListing.php");
// Exits the script
exit();
?>
