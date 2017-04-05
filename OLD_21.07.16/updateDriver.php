<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connects to the DB
require "dbconn.php";

// to store the Driver information
$volID	 	    = $_GET['volunteer'];
$drLicence 	    = $_GET['drLicence'];
$drExpDate 	    = $_GET['drExpDate'];
$drTestedDate 	= $_GET['drTestedDate'];

// substring to get only the volunteer ID
$volID    = substr($volID,0,5);

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}

// Update database with new information
$query1 =  "UPDATE driver
           SET drLicence='$drLicence', drExpDate='$drExpDate', drTestedDate='$drTestedDate' 
           WHERE volID='$volID'";  		   
		   
		   
//execute the query
$results = $connect->query($query1);

// Closing Connection	
mysqli_close($connect);  
// go back to the previous page 
header("Location: DriverDates.php");
// Exits the script
exit();
?>