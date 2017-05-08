<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 
require "session1.php";
?>
<?php
// connect to the database
require "dbconn.php";

$oldword    = $_GET['oldpassword'];
$newword   = $_GET['newpassword'];
$confword =  $_GET['confirmpassword'];
$username = $_SESSION['login_user'];


$hashword = password_hash($newword, PASSWORD_DEFAULT)."\n";

		// To protect MySQL injection for Security purpose, all the backslashs are removed.
				$oldword = stripslashes($oldword);
				$newword = stripslashes($newword);
				$confword = stripslashes($confword);

				// To protect MySQL injection for Security purpose, escapes special characters. 
				$oldword = mysql_real_escape_string($oldword);
				$newword = mysql_real_escape_string($newword);
				$confword = mysql_real_escape_string($confword);
$connect = new mysqli($host, $user, $password, $database);


if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
	
// set up the query using the values that were passed via the URL from the form
$query = "SELECT * FROM usersview u, volunteer v WHERE u.username = ('".$username."') and u.volID = v.volID";
		  
		  

//execute the query
$results = $connect->query($query);

$numrow1 = $results->num_rows;
 $userrecord = mysqli_fetch_array ($results); 
				 
				 extract($userrecord);
$password = trim($password);



if (password_verify($oldword,$password) and $newword == $confword) {



$updatequery = "UPDATE usersview SET password='$hashword' 
		  WHERE username='$username'";

//execute the query
$results2 = $connect->query($updatequery);
header( 'Location:jobDoneUserUpdatePassword.php');
// Closing Connection	
mysqli_close($connect); 
}


else {
header( 'Location:userUpdatePassword.php');}











?>