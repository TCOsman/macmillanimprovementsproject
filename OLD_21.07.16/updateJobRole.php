<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// Connects to the DB
require "dbconn.php";

// to store the location information
$jobID 		= $_GET['jobID'];
$jobDesc 	= $_GET['jobDescription'];

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}

// Update database with new information
$query1 =  "UPDATE jobRole
           SET jobDescription='$jobDesc'
           WHERE jobID='$jobID'";  

//execute the query
$results = $connect->query($query1);

// Closing Connection	
mysqli_close($connect); 
// go back to the previous page 
header("Location: jobRoleListing_desc.php");
// Exits the script
exit();
?>