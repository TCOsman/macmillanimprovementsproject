<?php

// ************************** SECURITY CHECKS **************************
// User Levels 1 and 2

// Starting Session
session_start();

// To check if the script was bypassed in the browser. User will be redirected to the LOG IN PAGE
if ( !isset($_SESSION['user_level']) )
  {
	// Deletes the buffer	
	ob_end_clean(); 
	// Redirects user to login page
	header("Location: index.html"); 
	// Exits the script
	exit(); 
  }
 
// To check if user does not have the right accessibility. User will be redirected to the LOG IN PAGE
if ( ( $_SESSION['user_level'] != 1 ) && ( $_SESSION['user_level'] != 2 ) )  
    {
		// Deletes the buffer	
		ob_end_clean(); 
		// Redirects user to login page
		header("Location: index.html"); 
		// Exits the script
		exit(); 
    }
?>