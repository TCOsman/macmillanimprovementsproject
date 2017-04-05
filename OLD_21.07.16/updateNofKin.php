<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connects to the DB
require "dbconn.php";

$nkno    = $_GET['nkinID'];  
$nkname  = $_GET['nkinName'];
$nksur   = $_GET['nkinSurname'];
$nkph1   = $_GET['nkinPhone1'];
$nkph2   = $_GET['nkinPhone2'];
$nkrel   = $_GET['nkinRelationship'];
$vno     = $_GET['volID'];


//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}

// Update database with new information
$query1 =  "UPDATE nOfKin
           SET nkinName='$nkname', nkinSurname='$nksur', nkinPhone1='$nkph1', 
		       nkinPhone2='$nkph2', nkinRelationship='$nkrel'  
           WHERE nkinID='$nkno'";  

//execute the query
$results = $connect->query($query1);

// Closing Connection	
mysqli_close($connect); 
// go back to the previous page 
header("Location: nOfKinListing_name.php");
// Exits the script
exit();
?>



?>