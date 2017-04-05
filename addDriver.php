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
$query = "SELECT volID, volName, volSurname
		  FROM volunteer
		  ORDER BY volName";

// execute the query
$results = $connect->query($query);

// count the number of rows that will be selected from the table 
$numrow = $results->num_rows;
?>

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
		<script type="text/javascript" src="JS_Web/datepicker2.js"></script>
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Driver Details</div>
			<br />
			<!-- form with four fields and a submit buttons -->
			<form name="inputDriver" action="addDriverToDB.php" method="get">
				<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
						<div id="identification"> <!-- ======================== identification information ========================= -->
							*Driver ID:	
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
					<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
					<label for="drExpDate">*DL Exp. Date:</label>        
						<input type="text" id="datepicker" name="drExpDate" required></input><br /><br />
					<label for="drLicence">*Driving Licence:</label>     
						<input type="text" name="drLicence" maxlength="30" size="30" required></input><br /><br />
					<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
					<label for="drTestedDate">Driver Assessment:</label> 
						<input type="text" id="datepicker2" name="drTestedDate"></input> 
				</div>	
				<br />
				<div = id="sendform"> <!-- ===== sending form ============-->					
					<input type="Submit" Value="SUBMIT"></input>
				</div>
			</form>
			<form name="mainMenu" action="mainMenu.php" method="get">
				<div = id="sendform2"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="MAIN MENU"></input>
				</div>
			</form>
			<form name="resetform" action="addDriver.php" method="get">
				<div = id="sendform3"> <!-- ===== reset form ============-->					
						<input type="Submit" Value="RESET"></input>
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