<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connect to the database
require "dbconn.php";

// Copy the variables that the form placed in the URL
// into these five variables
$vhno   = $_GET['vehID']; // it will allow the database to generate the auto_increment.
$reg    = $_GET['vehReg'];
$make   = $_GET['vehMake'];
$doors  = $_GET['vehNOfDoors'];
$note   = $_GET['vehNote'];

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
	
// set up the query using the values that were passed via the URL from the form
$query = "INSERT INTO vehicle VALUES	('".$vhno."','".$reg."','".$make."','".$doors."','".$note."')";

//execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect); 
// jump to the next page
header( 'Location:jobDoneVehicle.php');
// Exits the script
exit();
?>