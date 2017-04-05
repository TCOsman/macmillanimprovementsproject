<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// Connects to the DB
require "dbconn.php";

// to store the location information
$iID     = $_GET['insID']; 
$pno     = $_GET['insPolicy'];
$iexp    = $_GET['insExpDate'];
$mot     = $_GET['MOT'];
$note    = $_GET['insNote'];

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}

// Update database with new information
$query1 =  "UPDATE insurance
           SET insPolicy='$pno', insExpDate='$iexp', MOT='$mot', insNote='$note'
           WHERE insID='$iID'";  

//execute the query
$results = $connect->query($query1);

// Closing Connection	
mysqli_close($connect); 
// go back to the previous page 
header("Location: MOTListingDates.php");
// Exits the script
exit();
?>