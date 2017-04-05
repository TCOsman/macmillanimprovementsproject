<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connects to the DB
require "dbconn.php";

// to store the location information
$wkLocID 		= $_GET['wkLocID'];
$wkLocDesc 		= $_GET['wkLocDescription'];

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}

// Update database with new information
$query1 =  "UPDATE workLoc
           SET wkLocDescription='$wkLocDesc'
           WHERE wkLocID='$wkLocID'";  

//execute the query
$results = $connect->query($query1);

// Closing Connection	
mysqli_close($connect); 
// go back to the previous page 
header("Location: locationListing_desc.php");
// Exits the script
exit();
?>