<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connects to the DB
require "dbconn.php";

// to store the location information
$dbsID 	    		= $_GET['dbsID'];
$dbsSentDate 	    = $_GET['dbsSentDate'];
$dbsCertDate 		= $_GET['dbsCertDate'];
$dbsCertNumber 		= $_GET['dbsCertNumber'];


//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}

// Update database with new information
$query1 =  "UPDATE dbsCertificate
           SET dbsSentDate='$dbsSentDate', dbsCertDate='$dbsCertDate', dbsCertNumber='$dbsCertNumber'
           WHERE dbsID='$dbsID'";  

//execute the query
$results = $connect->query($query1);

// Closing Connection	
mysqli_close($connect); 
// go back to the previous page 
header("Location: dbsCertificateDates.php");
// Exits the script
exit();
?>