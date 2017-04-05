<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php

// requires DB connection
require "dbconn.php";

// Copy the variables that the form placed in the URL
// into these fourteen variables
$vno     = $_GET['volID']; // it will allow the database to generate the auto_increment.
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
$vtitle  = $_GET['volTitle']; 

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
	
// set up the query using the values that were passed via the URL from the form
$query = "INSERT INTO volunteer VALUES	('".$vno."','".$vname."','".$vsur."','".$vdbo."','".$vadd1."','".$vadd2."','".$vadd3."','".$vtown."',
                                         '".$vpc."','".$vmob."','".$vldn."','".$vemail."','".$vsdate."','".$vedate."','".$vterm."','".$vtitle."')";

//execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect); 
// jump to the next page
header( 'Location:jobDoneVolunteer.php');
// Exits the script
exit();
?>