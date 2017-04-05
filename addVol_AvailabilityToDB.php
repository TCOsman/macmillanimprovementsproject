<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connect to the database
require "dbconn.php";

// Copy the variables that the form placed in the URL
// into these eight variables
$aID    = $_GET['availID']; // it will allow the database to generate the auto_increment.
$aday   = $_GET['availDay'];
$atime  = $_GET['availTime'];
$afreq  = $_GET['availFreq'];
$anote  = $_GET['availNote'];
$vno    = $_GET['volID'];
$jno    = $_GET['jobID'];
$lno    = $_GET['wkLocID'];


// to extract only the volunteerID (five characters), and not considering the name of the volunteer in order to store it into the database
$vno    = substr($vno,0,5);

// to extract only the JobRoleID (five characters), and not considering the description in order to store it into the database
$jno    = substr($jno,0,5);

// to extract only the WkLocationID (five characters), and not considering the description in order to store it into the database
$lno    = substr($lno,0,5);

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
	
// set up the query using the values that were passed via the URL from the form
$query = "INSERT INTO vol_Availability VALUES	('".$aID."','".$aday."','".$atime."','".$afreq."','".$anote."','".$vno."','".$jno."','".$lno."')";

//execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect); 
// jump to the next page
header( 'Location:jobDoneVol_Availability.php');
// Exits the script
exit();
?>