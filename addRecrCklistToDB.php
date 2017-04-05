<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connect to the database
require "dbconn.php";

// Copy the variables that the form placed in the URL
// into these fourteen variables
$auto   = 'auto_increment'; // it will allow the database to generate the auto_increment.
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
$query = "INSERT INTO recruitmentCkList VALUES	('".$auto."','".$centry."','".$cfsent."','".$cfrec."','".$cffile."','".$cinter."','".$cintwer."',
                                                 '".$cstat."','".$cref1."','".$cref2."','".$crwork."','".$chclear."','".$cnkin."','".$cagree."',
												 '".$vno."')";

//execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect); 
// jump to the next page
header( 'Location:jobDoneRecrCklist.php');
// Exits the script
exit();
?>