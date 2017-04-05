<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connects to the DB
require "dbconn.php";

// to store the Driver information
$trID	 	    = $_GET['trID'];
$trDescription 	= $_GET['trDescription'];
$trType 	    = $_GET['trType'];

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}

// Update database with new information
$query1 =  "UPDATE training
           SET trDescription='$trDescription', trType='$trType' 
           WHERE trID='$trID'";  		   
		   
		   
//execute the query
$results = $connect->query($query1);

// Closing Connection	
mysqli_close($connect);  
/// go back to the previous page 
header("Location: trainingListing_desc.php");
// Exits the script
exit();
?>

