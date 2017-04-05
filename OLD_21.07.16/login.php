<?php

// Starting Session
session_start(); 

// Variable To Store Error Message
$error=''; 

if (isset($_POST['submit'])) 
	{
		// Extra security mesuare, as the text fields in the index form do not send empty field.
		if (empty($_POST['username']) || empty($_POST['password'])) 
			{
				$error = "Either Username or Password is invalid";
			}
		else
			{
				// Define $username and $password
				$username=$_POST['username'];
				$password=$_POST['password'];
				
				// Establishing Connection with Server by passing server_name, username and password as a parameter
				$connection = mysqli_connect("localhost", "root", "", "mcl");

				// To protect MySQL injection for Security purpose, all the backslashs are removed.
				$username = stripslashes($username);
				$password = stripslashes($password);

				// To protect MySQL injection for Security purpose, escapes special characters. 
				$username = mysql_real_escape_string($username);
				$password = mysql_real_escape_string($password);

				echo $username;
				echo $password;

				// SQL query to fetch information of registerd users and finds user match.
				$query = "select * 
							FROM usersview  
							WHERE password='$password' 
							AND username='$username'";
										
				 // executes query
				 $result = mysqli_query($connection, $query);
				 
				 // identifies how many entries were found.			
				$rows = mysqli_num_rows($result);
 
				 // extracts the information from query2
				 $userrecord = mysqli_fetch_array ($result); 
				 
				 extract($userrecord);
				 
					mysqli_free_result($result); // frees the memory 
					//mysqli_close($db);
					
				
				if ($rows ==1)
					{	
						// Session is intialised
						$_SESSION['login_user']=$username; 
                        $_SESSION['user_level']=$userLevel; 
						if ($userLevel == 1)
									{
										// This will redirect to the System Adminstrator - The highest user accessibility level
										ob_end_clean(); // Deletes the buffer
										header("Location: adminHome.php");
										exit(); // Exits script
									}
									
								elseif ($userLevel == 2)
								{
									// This will redirect to the management - Second highest user accessibility level
									
									ob_end_clean(); // Deletes the buffer
									
									header("Location: mainMenu.php");
															
									exit(); // Exits script
								}
								
								else
									{
										// This will redirect to the lowest user accessibility level
										// If they are not either a System Administrator or Management User, 
										ob_end_clean(); // Deletes the buffer
										header("Location: singleListingMenu.php"); // future work
										exit(); // userLevel script
									}
								
					} 
	
				else
					{
				 
						$error = "Either Username or Password is invalid";
						echo $error;
						header("location: index.html"); // Redirecting To this page if login is successful
				 
					}
				
 				
			}
			
// Closing Connection	
mysqli_close($connection); 
// Exits the script
exit(); 

	}
?>