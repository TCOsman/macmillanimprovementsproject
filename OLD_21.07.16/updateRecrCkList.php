<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connects to the DB
require "dbconn.php";

// to store the cklist information
$ckListID  = $_GET['cklistID'];
$centry    = $_GET['ckListDateOfEntry'];
$cfsent    = $_GET['ckListAppFormSentDate'];
$cfrec     = $_GET['ckListAppFormRecDate'];
$cffile    = $_GET['ckListAppFormOnFile'];
$cinter    = $_GET['ckListInterviwer'];
$cintwer   = $_GET['ckListInterviewDate'];
$cstat     = $_GET['ckListStatus'];
$cref1     = $_GET['ckListRef1'];
$cref2     = $_GET['ckListRef2'];
$crwork    = $_GET['ckListRightToWork'];
$chclear   = $_GET['ckListHealthClearance'];
$cnkin     = $_GET['ckListNOfKinForm'];
$cagree    = $_GET['ckListConfAgreement'];

//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}

// Update database with new information
$query1 =  "UPDATE recruitmentCkList
           SET ckListDateOfEntry='$centry', ckListAppFormSentDate='$cfsent', ckListAppFormRecDate='$cfrec', 
		       ckListAppFormOnFile='$cffile', ckListInterviwer='$cinter', ckListInterviewDate='$cintwer',
               ckListStatus='$cstat', ckListRef1='$cref1', ckListRef2='$cref2',
               ckListRightToWork='$crwork', ckListHealthClearance='$chclear', ckListNOfKinForm='$cnkin',
               ckListConfAgreement='$cagree' 	   
           WHERE ckListID='$ckListID'";  		   
		   
		   
//execute the query
$results = $connect->query($query1);

// Closing Connection	
mysqli_close($connect); 
// go back to the previous page 
header("Location: cklistListing_name.php");
// Exits the script
exit();
?>





?>