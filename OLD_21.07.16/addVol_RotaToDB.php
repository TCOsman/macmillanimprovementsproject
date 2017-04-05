<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php

require "dbconn.php";

$host = "localhost";
$user = "root";
$password = "";
$database = "mcl";

// Copy the variables that the form placed in the URL
// into these six variables
$auto   = 'auto_increment'; // it will allow the database to generate the auto_increment.
$rDate  = $_GET['rotaDate'];
$rLoc   = $_GET['wkLocID'];
$rTime  = $_GET['rotaTime'];
$rHrs   = $_GET['workedHs'];
$jno    = $_GET['jobID'];
$vno    = $_GET['volID'];


// to extract only the volunteerID (five characters), and not considering the name of the volunteer in order to store it into the database
$vno    = substr($vno,0,5);

// to extract only the workLocID (five characters), and not considering the registration and make of the vehicle in order to store it into the database
$rLoc    = substr($rLoc,0,5);

// to extract only the jobID (five characters), and not considering the registration and make of the vehicle in order to store it into the database
$jno    = substr($jno,0,5);

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
	
// set up the query using the values that were passed via the URL from the form
$query = "INSERT INTO vol_rota VALUES	('".$auto."','".$rDate."','".$rLoc."','".$rTime."','".$rHrs."','".$jno."','".$vno."')";

//execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect); 
// jump to the next page
header( 'Location:jobDoneVol_Rota.php');
// Exits the script
exit();
?>