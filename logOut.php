<?php

//Starts session
session_start();

// Destroy session
session_destroy();

// Deletes the buffer	
ob_end_clean(); 

// Redirects user to login page
header("Location:index.html");

// exits script
exit();
?>

