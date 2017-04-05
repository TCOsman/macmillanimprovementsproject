<?php 
/*This forgot_password.php script is based on Chapter 18 of
PHP and MySQL for Dynamic Web Sites: Visual QuickPro Guide (4th Edition),
and is used to carry-out the forgot/change password process for the site. */

// This states a requirement to include the config file 
// an optional alternative page header, then set the page title.
//r//equire ('includes/config.inc.php'); 
//$page_title = 'Forgot Your Password';

// connect to the database
require "dbconn.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
	require (MYSQL);
	// This will assume nothing
	$idn = FALSE;

	// This will validate the email address
	if (!empty($_POST['email'])) 
            {
		// This will check for the existence of that email address
		$q = 'SELECT id_number FROM user WHERE email="'.  mysqli_real_escape_string ($dbc, $_POST['email']) . '"';
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 1) // This will retrieve the ID Number
                    { 
			list($idn) = mysqli_fetch_array ($r, MYSQLI_NUM); 
                    } 
                else // ELSE, if no database match made
                    { 
			echo '<div class="alert alert-danger" role="alert"><p class="error">The submitted email address does not match those on file!</p></div>';
                    }	
            }   
        else // ELSE, if no email address has been entered
            { 
		echo '<div class="alert alert-danger" role="alert"><p class="error">You forgot to enter your email address!</p></div>';
            } // End of empty($_POST['email']) IF.
	
	if ($idn) // Then, IF everything is set correctly
            { 
		// This will create a new random password
		$p = substr ( md5(uniqid(rand(), true)), 3, 10);

		// This will update the database
		$q = "UPDATE users SET password=SHA1('$p') WHERE id_number=$idn LIMIT 1";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		if (mysqli_affected_rows($dbc) == 1)  // If it ran OK.
                    {
			// This will send an email
			$body = "Your password to log into ACM Register has been temporarily changed to '$p'. Please log in using this password and this email address. Then you may change your password to something more familiar.";
			mail ($_POST['email'], 'Your temporary password.', $body, 'From: postmaster@localhost.com');
			
			// This will print a message and wrap up
			echo '<h3>Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</h3>';
			mysqli_close($dbc);
			include ('index.html');
			exit(); // This will exit the script		
                    } 
                else // ELSE, if everything it did not run correctly
                    { 
			echo '<div class="alert alert-danger" role="alert"><p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p></div>'; 
                    }

            } 
        else // ELSE, if the validation test failed
            { 
		echo '<div class="alert alert-danger" role="alert"><p class="error">Please try again.</p></div>';
            }

	mysqli_close($dbc); // This will close the database connection

} // End
?>