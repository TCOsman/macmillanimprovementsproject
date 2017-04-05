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

// to store the record ID to be deleted by user
$jobID = $_GET['jobID'];

// set the query to delete the chosen record
$query = "DELETE FROM jobRole WHERE jobID = '".$jobID."'";

// execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect); 
// go back to the previous page
header("Location: jobRoleListing_desc.php");
// Exits the script
exit();
?>
