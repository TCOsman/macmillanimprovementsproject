<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connects to the DB
require "dbconn.php";

// to store the volunteer information
$vno     = $_GET['volID'];  
$vname   = $_GET['volName'];
$vsur    = $_GET['volSurname'];
$vdbo    = $_GET['volDOB'];
$vadd1   = $_GET['volAddress1'];
$vadd2   = $_GET['volAddress2'];
$vadd3   = $_GET['volAddress3'];
$vtown   = $_GET['volTown'];
$vpc     = $_GET['volPostcode'];
$vmob    = $_GET['volMobile'];
$vldn    = $_GET['volLandline'];
$vemail  = $_GET['volEmail'];
$vsdate  = $_GET['volStarDate'];
$vedate  = $_GET['volEndDate'];
$vterm   = $_GET['volTermReason']; 

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}

// Update database with new information
$query1 =  "UPDATE volunteer
           SET volName='$vname', volSurname='$vsur', volDOB='$vdbo', 
		       volAddress1='$vadd1', volAddress2='$vadd2', volAddress3='$vadd3',
               volTown='$vtown', volPostcode='$vpc', volMobile='$vmob',
               volLandline='$vldn', volEmail='$vemail', volStarDate='$vsdate',
               volEndDate='$vedate', volTermReason='$vterm'  	   
           WHERE volID='$vno'";  		   
		   
		   
//execute the query
$results = $connect->query($query1);

// Closing Connection	
mysqli_close($connect);  
// go back to the previous page 
header("Location: volunteerListing_name.php");
// Exits the script
exit(); 
?>