<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connect to the database
require "dbconn.php";

// Copy the variables that the form placed in the URL
// into these seven variables
$iID     = $_GET['insID']; // it will allow the database to generate the auto_increment.
$pno     = $_GET['insPolicy'];
$iexp    = $_GET['insExpDate'];
$mot     = $_GET['MOT'];
$note    = $_GET['insNote'];
$vno     = $_GET['volID'];
$vhno    = $_GET['vehID'];

// to extract only the volunteerID (five characters), and not considering the name of the volunteer in order to store it into the database
$vno    = substr($vno,0,5);

// to extract only the vehicleID (five characters), and not considering the registration and make of the vehicle in order to store it into the database
$vhno    = substr($vhno,0,5);

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
	
// set up the query using the values that were passed via the URL from the form
$query = "INSERT INTO insurance VALUES	('".$iID."','".$pno."','".$iexp."','".$mot."','".$note."','".$vno."','".$vhno."')";

//execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect);  
// jump to the next page
header( 'Location:jobDoneInsurance.php');
// Exits the script
exit();
?>