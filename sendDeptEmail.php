<?php

$jobNo = $_POST['jobID'];
$subject = $_POST['Subject'];
$email = $_POST['Email'];

$formattedEmail = nl2br($email);
$formattedJobNo = substr($jobNo,0,5);

// connect to the database
require "dbconn.php";

// Test to check if the database is connected
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
    {
	echo "Failed to connect to MYSQL: " . $connect->connect_error;
    }

// set up the SQL query
$query = "SELECT volEmail
		  FROM volunteer WHERE jobID = ('".$formattedJobNo."')";

// execute the query
$results = $connect->query($query);

// count the number of rows that will be selected from the table 
$numrow = $results->num_rows;

//$testEmailAddress = mysqli_fetch_row($results);


//  echo $testEmailAddress[0];
//echo $row[1];
//echo $numrow;
//echo $jobNo;
//echo $subject;
//echo" ";
//echo $formattedJobNo;
//echo $formattedEmail;

	 

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
while($row = mysqli_fetch_array($results)) {

 
	 $to = $row['volEmail']; 
$mail->addAddress($to);
 }
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
$mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($formattedEmail);
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
  
  
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 //   echo "Message sent!";
mysqli_close($connect); 
// jump to the next page
header( 'Location:jobDoneEmail.php');
// Exits the script
exit();
}
  
?>









<!DOCTYPE html>
<html>
<body>



</body>
</html>