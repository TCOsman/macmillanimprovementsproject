<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "");

// Selecting Database
$db = mysql_select_db("mcl", $connection);

// Starting Session
session_start();

// Storing Session
$user_check=$_SESSION['user_level'];

// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select username from users where username='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['user_level'];
if(!isset($login_session)){
mysql_close($connection); // Closing Connection
header('Location: login-window-admin.php'); // Redirecting To Home Page or login screen
}

// Deletes the buffer	
ob_end_clean(); 
// Exits the script
exit();
?>