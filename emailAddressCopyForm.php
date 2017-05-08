<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php

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
		  FROM volunteer";

// execute the query
$results = $connect->query($query);

// count the number of rows that will be selected from the table 
$numrow = $results->num_rows;


?>

<!DOCTYPE html>   
<html lang="en" xml:lang="en">  
	<head>  
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
		<title>
			Jorge Souza - Macmillan Caring Locally Database System
		</title>
		<script src="JS_Web/fontsize.js"></script>
		<link type="text/css" href="Jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="Jquery/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="Jquery/js/jquery-ui-1.10.4.custom.min.js"></script>	
		<script type="text/javascript" src="JS_Web/datepicker.js"></script>
		<script src="clipboard.js-master/dist/clipboard.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>
		
		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Copy all Volunteer Email Addresses</div>
			<br />
			<!-- form with four fields and a submit buttons -->
			
				<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
					 
					<br />
					
					
						<textarea name="emailtext" rows="20" cols="100" ><?php $count = 0;
									while ($count < $numrow) 
										{
										   // pull one record of data out of the $results array and copy it to $row
											$row = $results->fetch_assoc();
												
											// extract the values from the $row array, and copy them into variables that
											// have the same names as the field names in the table
											extract ($row);
										
											 
											echo $volEmail.","." ";
										
										
													
											// Volunteer displays loop for each row of data, put the values into an array called $row
										$count = $count + 1;                              }?>  </textarea>
		
					
					<br>

<br/>


				
				<br />
				
		
			
			
			<form name="exitform" action="logOut.php" method="get">
				<div = id="sendform2"> <!-- ===== EXIT THE DATABASE form ============-->					
					<input type="Submit" Value="LOGOUT"></input>
				</div>
			</form>
			<form name="mainMenu" action="mainMenu.php" method="get">
				<div = id="sendform3"> <!-- ===== Goes back to the main Menuform ============-->					
					<input type="Submit" Value="MAIN MENU"></input>
				</div>
			</form>
			<form name="admHome" action="adminHome.php" method="get">
				<div = id="sendform3"> <!-- ===== Redirects user to adm page ============-->					
					<input type="Submit" Value="SYSTEM ADMIN"></input>
				</div>
			</form>			
			<br />
		</div>
		<div id="footer"> <!-- ======================== Main page footer ========================= -->
			Jorge Souza - Bournemouth University  
			| For more information, please contact us by email i7250872@bournemouth.ac.uk
		</div>
	</body>
</html>

<?php
// Closing Connection	
mysqli_close($connect); 
// Exits the script
exit();
?>