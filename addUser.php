<?php
// ************************** SECURITY CHECKS **************************
//User Level 1
//require "session1.php";
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
$query = "SELECT volID, volName, volSurname
		  FROM volunteer
		  ORDER BY volName";

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
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">User Details</div>
			<br />
			<!-- form with four fields and a submit buttons -->
			<form name="inputUser" action="addUserToDB.php" method="get">
				<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
						<div id="identification"> <!-- ======================== identification information ========================= -->
							*System User:	
							<select name="volID" required>
								<optgroup label=""><option></option></optgroup>  <!-- =====blanked first option ====== -->
								<optgroup label="Available Volunteer">

								<?php
									// Volunteer displays loop for each row of data, put the values into an array called $row
									$count = 0;
									while ($count < $numrow) 
										{
										   // pull one record of data out of the $results array and copy it to $row
											$row = $results->fetch_assoc();
												
											// extract the values from the $row array, and copy them into variables that
											// have the same names as the field names in the table
											extract ($row);
										
											echo "<option>"; 
											echo $volID." >> ".$volName." ".$volSurname;
											echo "</option>";
											echo  "<br />";	
													
											// Volunteer displays loop for each row of data, put the values into an array called $row
											$count = $count + 1;
										}								
								?> 
								</optgroup>
							</select>
						</div>
					<br />
					<label for="username">*Username:</label>     
						<input type="text" name="username" maxlength="15" size="15" required></input><br /><br />
					<label for="password">*Temporary <br />
										  Password:</label>     
						<input type="text" name="password" maxlength="15" size="15" required></input><br /><br />
					<label for="userLevel">User Level:</label> 	 
									<br />
									<input type="radio" name="userLevel" value=1>System Admin 
									<br />
									<input type="radio" name="userLevel" value=2>Management 
									<br />
									<input type="radio" name="userLevel" value=3 checked="checked" >User 
					<br /><br />
					<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
					<label for="RegDate">*Registered Date:</label>        
						<input type="text" id="datepicker" name="RegDate" required></input><br /><br />
					
				</div>	
				<br />
				<div = id="sendform"> <!-- ===== sending form ============-->					
					<input type="Submit" Value="SUBMIT"></input>
				</div>
			</form>
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