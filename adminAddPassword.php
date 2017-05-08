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
$word   = $_GET['Password1'];
$word2  = $_GET['Password2'];

$formattedVolNo = substr($vno,0,5);

echo $vno;
echo $word;
echo $word2;
echo $formattedVolNo;

if ($word != $word2){
header( 'Location:adminchangepassword.php');}

else{


// to extract only the volunteerID (five characters), and not considering the name of the volunteer in order to store it into the database
//echo $vno    = substr($vno,0,5);

// To protect MySQL injection for Security purpose, all the backslashs are removed.
$word = stripslashes($word);
$word2 = stripslashes($word2);

// To protect MySQL injection for Security purpose, escapes special characters. 
$word = mysql_real_escape_string($word);
$word2 = mysql_real_escape_string($word2);

//hash the password for security 
$hashword = password_hash($word, PASSWORD_DEFAULT)."\n"; 
//Connect to MYSQL
//echo $hashword;


$connect = new mysqli($host, $user, $password, $database);


if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
	
// set up the query using the values that were passed via the URL from the form
$query = "UPDATE usersview SET password='$hashword' 
		  WHERE volID='$formattedVolNo'";

//execute the query
$results = $connect->query($query);

// Closing Connection	
mysqli_close($connect); 
// jump to the next page
header( 'Location:jobDonePasswordChange.php');
// Exits the script
exit();
}
?>