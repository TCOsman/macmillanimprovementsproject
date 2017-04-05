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
$auto   = 'auto_increment'; // it will allow the database to generate the auto_increment.
$cdbssent  = $_GET['ckListDbsSentDate'];
$cdbsdate  = $_GET['ckListDbsCertDate'];
$cdbscert  = $_GET['ckListDbsCertNumber']; 
$vno       = $_GET['volID']; 

// to extract only the volunteerID (five characters), and not considering the name of the volunteer in order to store it into the database
$vno    = substr($vno,0,5);

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
	
// set up the query using the values that were passed via the URL from the form
$query = "INSERT INTO dbsCertificate VALUES	('".$auto."','".$cdbssent."','".$cdbsdate."','".$cdbscert."','".$vno."')";

//execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect); 
// Deletes the buffer	
header( 'Location:jobDoneDbsCertificate.php');
// Exits the script
exit();
?>