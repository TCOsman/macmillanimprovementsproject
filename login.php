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
				$postusername=$_POST['username'];
				$postpassword=$_POST['password'];
				
				// Establishing Connection with Server by passing server_name, username and password as a parameter
				$connection = mysqli_connect("localhost", "root", "", "mcl");

				// To protect MySQL injection for Security purpose, all the backslashs are removed.
				$postusername = stripslashes($postusername);
				$postpassword = stripslashes($postpassword);

				// To protect MySQL injection for Security purpose, escapes special characters. 
				$postusername = mysql_real_escape_string($postusername);
				$postpassword = mysql_real_escape_string($postpassword);

//				echo $postusername;
	//			echo $postpassword;

				// SQL query to fetch information of registerd users and finds user match.
				/*
				$query = "select * 
							FROM usersview  
							WHERE password='$password' 
							AND username='$username'";
							
							*/
				$query = "select * 
							FROM usersview  
							WHERE  username='$postusername'";	
							
					/*	$query = "select volID, username, password
							FROM usersview  
							WHERE  username='$postusername'";	
						*/	
				 // executes query
				 $result = mysqli_query($connection, $query);
				 
				 // identifies how many entries were found.			
				$rows = mysqli_num_rows($result);
 
				 // extracts the information from query2
				 $userrecord = mysqli_fetch_array ($result); 
				 
				 extract($userrecord);
				 
					mysqli_free_result($result); // frees the memory 
					//mysqli_close($db);
					
			//		echo $volID;
				//	echo $username;
				//	echo $password.'apple';
				//	echo $userLevel;
					
				//	echo $rows;
					
			
			$password = trim($password);
			
				//if ($rows ==1)
					
				/*
					if (password_verify($postpassword,$password))
					{
					echo "yes"; }
					else { echo "no";}
					*/
					if (password_verify($postpassword,$password)) {
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