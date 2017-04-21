<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connects to the DB
require "dbconn.php";

// to store the volunteer information
$vno     = $_GET['volID'];  
$vname   = $_GET['volName'];
$vsur    = $_GET['volSurname'];
$vdbo    = $_GET['volDOB'];
$vadd1   = $_GET['volAddress1'];
$vadd2   = $_GET['volAddress2'];
$vadd3   = $_GET['volAddress3'];
$vtown   = $_GET['volTown'];
$vpc     = $_GET['volPostcode'];
$vmob    = $_GET['volMobile'];
$vldn    = $_GET['volLandline'];
$vemail  = $_GET['volEmail'];
$vsdate  = $_GET['volStarDate'];
$vedate  = $_GET['volEndDate'];
$vterm   = $_GET['volTermReason']; 
$vtitle   = $_GET['volTitle'];
$vjobID = $_GET['jobID'];

//$formattedvJobID = "NULL";
//$formattedvJobID = null;
//$formattedvJobID = "";

//if(!empty($_GET['jobID'])){
//$formattedvJobID = substr($vjobID,0,5); }
//else {
	//$formattedvJobID = NULL;
//}

//echo $formattedvJobID;

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
//jobID='$formattedvJobID'
// Update database with new information
$query1 =  "UPDATE volunteer
           SET volName='$vname', volSurname='$vsur', volDOB='$vdbo', 
		       volAddress1='$vadd1', volAddress2='$vadd2', volAddress3='$vadd3',
               volTown='$vtown', volPostcode='$vpc', volMobile='$vmob',
               volLandline='$vldn', volEmail='$vemail', volStarDate='$vsdate',
               volEndDate='$vedate', volTermReason='$vterm', volTitle='$vtitle'";

		if(!empty($_GET["jobID"])){
			$formattedvJobID = substr($vjobID,0,5);
			$query1 .= ", jobID='$formattedvJobID'";
		}
			   
$query1 = $query1 . " WHERE volID='$vno'";  		   
		   
		   
//execute the query
$results = $connect->query($query1);

// Closing Connection	
mysqli_close($connect);  

// go back to the previous page 
header("Location: volunteerListing_name.php");
// Exits the script
exit(); 
?>