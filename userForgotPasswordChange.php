<?php
// ************************** SECURITY CHECKS **************************
//User Level 1 
//require "session1.php";
?>

<?php
// connect to the database
require "dbconn.php";

// Copy the variables that the form placed in the URL
// into these five variables
$email    = $_GET['Email'];
$username   = $_GET['Username'];

$newword = substr(uniqid(rand(), true), 3, 15);

echo $newword;






// To protect MySQL injection for Security purpose, all the backslashs are removed.
$email = stripslashes($email);
$username = stripslashes($username);

// To protect MySQL injection for Security purpose, escapes special characters. 
$email = mysql_real_escape_string($email);
$username = mysql_real_escape_string($username);

echo $email;
echo $username;



//hash the password for security 
$hashword = password_hash($newword, PASSWORD_DEFAULT)."\n"; 
//Connect to MYSQL
//echo $hashword;


$connect = new mysqli($host, $user, $password, $database);


if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
	
// set up the query using the values that were passed via the URL from the form
$query = "SELECT * FROM volunteer v, usersview u   
		  WHERE u.username =('".$username."')
		  AND v.volEmail =('".$email."')
		  and v.volID = u.volID";
		  
		  

//execute the query
$results = $connect->query($query);

$numrow1 = $results->num_rows;


Echo $numrow1;

if($numrow1 != 1){
	header( 'Location:newForgotPasswordForm.php');
				}
	else {
		
		while($row = mysqli_fetch_array($results)) {

 
		$volID = $row['volID']; 
		$volEmail = $row['volEmail'];
		}
		echo $volID;
		echo $volEmail;
	}


$passwordquery = "UPDATE usersview SET password='$hashword' 
		  WHERE volID='$volID'";
		  
		  

//execute the query
$results2 = $connect->query($passwordquery);


	


date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();


 
$mail->addAddress($volEmail);
 
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "smtp.gmail.com";

//enable this if you are using gmail smtp, for mandrill app it is not required
$mail->SMTPSecure = 'ssl';                            

//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 465;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "macmillanemailtest@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "Macmillan1";
//Set who the message is to be sent from

$mail->setFrom('macmillanemailtest@gmail.com', 'Anita ');
//Set an alternative reply-to address
$mail->addReplyTo('reply-to@yoursitename.com', 'Reply-to Name');
//Set who the message is to be sent to

  
//Set the subject line
$mail->Subject = "New Pasword";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("Hello <br> Your new password is " .$newword . " <br> Regards, <br> The Macmillan Application Team");
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
  
  
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 //   echo "Message sent!";
// Closing Connection	
mysqli_close($connect); 
// jump to the next page
header( 'Location:jobDoneForgotPassword.php');
// Exits the script
exit();
}

?>