<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connects to the DB
require "dbconn.php";


// to store the vehicle information
$vehID	 	    = $_GET['vehID'];
$vehReg 	    = $_GET['vehReg'];
$vehMake 	    = $_GET['vehMake'];
$vehNOfDoors 	= $_GET['vehNOfDoors'];
$vehNote 	    = $_GET['vehNote'];

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}

// Update database with new information
$query1 =  "UPDATE vehicle
           SET vehReg='$vehReg', vehMake='$vehMake', vehMake='$vehMake',
               vehNOfDoors='$vehNOfDoors', vehNote='$vehNote'	   
           WHERE vehID='$vehID'";  		   
		   
		   
//execute the query
$results = $connect->query($query1);

// Closing Connection	
mysqli_close($connect); 
// go back to the previous page 
header("Location: vehicleListing_reg.php");
// Exits the script
exit();
?>