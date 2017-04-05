<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connect to the database
require "dbconn.php";

// Copy the variables that the form placed in the URL
// into these four variables
$vID     = $_GET['volID'];
$drlic   = $_GET['drLicence'];
$dexp    = $_GET['drExpDate'];
$dtest   = $_GET['drTestedDate'];

// to extract only the volunteerID (five characters), and not considering the name of the volunteer in order to store it into the database
$vID    = substr($vID,0,5);

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
	
// set up the query using the values that were passed via the URL from the form
$query = "INSERT INTO driver VALUES	('".$vID."','".$drlic."','".$dexp."','".$dtest."')";

//execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect); 
// jump to the next page
header( 'Location:jobDoneDriver.php');
// Exits the script
exit();
?>