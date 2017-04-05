<?php 
/*This change_password.php script is based on Chapter 18 of
PHP and MySQL for Dynamic Web Sites: Visual QuickPro Guide (4th Edition),
and is used to carry-out the change password process for the site. */

// This states a requirement to include the config file 
// an optional alternative page header, then set the page title.
//require ('includes/config.inc.php'); 
//$page_title = 'Change Your Password';
//include ('includes/header.html');

// IF no first_name session variable exists, redirect the user
//if (!isset($_SESSION['first_name'])) 
//    {   //If the Session isn't set and therefore not logged in
//	ob_end_clean(); // This will delete the buffer
//	header("Location: index.html"); // This returns the user to the Login page
//	exit(); // This will exit the script
//    }

// connect to the database
require "dbconn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
	require (MYSQL);
			
	// This will check for a new password and match against the confirmed password
	$p = FALSE;
	if (preg_match ('/^(\w){4,20}$/', $_POST['password1']) )
            {
		if ($_POST['password1'] == $_POST['password2']) 
                    {
			$p = mysqli_real_escape_string ($dbc, $_POST['password1']);
                    } 
                else 
                    {
                        echo '<p class="error">Your password did not match the confirmed password!</p>';
                    }
            } 
        else 
            {
		echo '<p class="error">Please enter a valid password!</p>';
            }
	
	if ($p) // Then, IF everything is set correctly
            {
		// This will carry-out the query
		$q = "UPDATE users SET password=SHA1('$p') WHERE volID={$_SESSION['volID']} LIMIT 1";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1)  //  Then, IF everything ran correctly
                    {
			// This will confirm the change
			echo '<h3>Your password has been changed.</h3>';
			mysqli_close($dbc); // Close the database connection.
			include ('includes/footer.html'); // Include the HTML footer.
			exit();			
                    } 
                else 
                    { // ELSE, if everything it did not run correctly		
			echo '<p class="error">Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think an error occurred.</p>'; 
                    }
            } 
        else 
            { // ELSE, if the validation test failed
		echo '<p class="error">Please try again.</p>';		
            }
	
	mysqli_close($dbc); // This will close the database connection
} // End 
?>
<div class="card signin-card clearfix text-center">
    <div class="textwhite" id="Header">ACM Register</div>
    <h1 class="textwhite">Change Password</h1>
    <p class="textwhite"><small>Use only letters, numbers, and the underscore. <br>Must be between 4 and 20 characters long.</small></p>   
        <form class="form-group" role="form" action="change_password.php" method="post">
            <div class="form-group form-group-lg">
               <input type="password" name="password1" placeholder="New Password" class="form-control input-lg text-center" maxlength="20">
            </div>
            <div class="form-group form-group-lg">
               <input type="password" name="password2" placeholder="Confirm Password" class="form-control input-lg text-center" maxlength="20">
            </div>
            <div class="form-group form-group-lg" align="center">    
               <button type="submit" name="submit" value="Change My Password" class="btn btn-primary btn-lg btn-block">Change My Password</button>
            </div>
        </form>             
</div>

<?php
// <?php include ('includes/footer.html'); //

/**
  * write_mysql_log($message, $db)
  *
  * Author(s): thanosb, ddonahue
  * Date: May 11, 2008
  * 
  * Writes the values of certain variables along with a message in a database.
  *
  * Parameters:
  *  $message: Message to be logged
  *  $db: Object that represents the connection to the MySQL Server    
  *
  * Returns array:
  *  $result[status]:   True on success, false on failure
  *  $result[message]:  Error message
  */
 
 $something_happened = rand(0,1);
 
if($something_happened == 1) {
  write_mysql_log("Something happened!", $dbc);
}
function write_mysql_log($message, $dbc)
{
  // Check database connection
  if( ($dbc instanceof MySQLi) == false) {
    return array(status => false, message => 'MySQL connection is invalid');
  }
 
  // Check message
  if($message == '') {
    return array(status => false, message => 'Message is empty');
  }
 
  // Get IP address
  if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
    $remote_addr = "REMOTE_ADDR_UNKNOWN";
  }
 
  // Get requested script
  if( ($request_uri = $_SERVER['REQUEST_URI']) == '') {
    $request_uri = "REQUEST_URI_UNKNOWN";
  }
 
  // Escape values
  $message     = $dbc->escape_string($message);
  $remote_addr = $dbc->escape_string($remote_addr);
  $request_uri = $dbc->escape_string($request_uri);
 
  // Construct query
  $q = "INSERT INTO my_log (remote_addr, request_uri, message) VALUES('$remote_addr', '$request_uri','$message')";
 
  // Execute query and save data
  $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
 
  if (mysqli_affected_rows($dbc) == 0)
      
      {
    return array(status => false, message => 'Unable to write to the database');
  }
}
?>