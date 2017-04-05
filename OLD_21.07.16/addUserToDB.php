<?php
// ************************** SECURITY CHECKS **************************
//User Level 1 
require "session1.php";
?>

<?php
// connect to the database
require "dbconn.php";

// Copy the variables that the form placed in the URL
// into these five variables
$vno    = $_GET['volID'];
$name   = $_GET['username'];
$word   = $_GET['password'];
$level  = $_GET['userLevel'];
$jno    = $_GET['RegDate'];


// to extract only the volunteerID (five characters), and not considering the name of the volunteer in order to store it into the database
echo $vno    = substr($vno,0,5);

// To protect MySQL injection for Security purpose, all the backslashs are removed.
$name = stripslashes($name);
$word = stripslashes($word);

// To protect MySQL injection for Security purpose, escapes special characters. 
$name = mysql_real_escape_string($name);
$word = mysql_real_escape_string($word);


//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
	
// set up the query using the values that were passed via the URL from the form
$query = "INSERT INTO users VALUES	('".$vno."','".$name."','".$word."','".$level."','".$jno."')";

//execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect); 
// jump to the next page
header( 'Location:jobDoneUser.php');
// Exits the script
exit();
?>