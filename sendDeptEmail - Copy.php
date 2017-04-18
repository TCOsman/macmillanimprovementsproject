<?php>







</?>


<?php>
// connect to the database
require "dbconn.php";

// Copy the variables that the form placed in the URL
// into these five variables
$jobNo    = $_GET['jobID'];
$subject   = $_GET['Subject'];
$email   = $_GET['email'];


echo $jobNo;
echo $subject;
echo $email;




</?>
