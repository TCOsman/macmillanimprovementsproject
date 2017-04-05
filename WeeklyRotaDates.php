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

// set up the SQL query to retrive Location
$query1 = "SELECT  DISTINCT (wkLocDescription)
                   FROM  weeklyRotaView
				   ORDER BY rotaDate";
		 
// execute query1
$results1 = $connect->query($query1);

// count the number of rows that will be selected from the table 
$numrow1 = $results1->num_rows;
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
		<script type="text/javascript" src="JS_Web/datepicker1.js"></script>
		<script type="text/javascript" src="JS_Web/datepicker2.js"></script>
		<link rel="stylesheet" type="text/css" href="css/listing.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Weekly Rota Dates</div>
			<br />
			<!-- form with two fields and a submit button -->
			<form name="sessionDates" action="weeklyRotaListing.php" method="get">
						<div id="dateLeft"> <!-- ======================== search training sessions by dates ========================= -->
							<h3>Date Range</h3>
							<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
							<label for="startDate">*Start Date:</label>        
								<input type="text" id="datepicker1" name="startDate" required></input><br />
							<br />
							<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
							<label for="endDate">*End Date:</label>        
								<input type="text" id="datepicker2" name="endDate" required></input><br />
							
						</div>
						<!-- form with one field and a submit button -->
						<div id="dateRight"> <!-- ======================== search training sessions by names ========================= -->
						<div id="identification"> <!-- ======================== Volunteer information ========================= -->
						<h3>Work Location</h3>
						*Location:	
						<select name="wkLocDescription" required>
							<optgroup label=""><option>
							<optgroup label="Locations">
							<?php
								// Volunteer display loop for each row of data, put the values into an array called $row1
								$count1 = 0;
								while ($count1 < $numrow1) 
									{
									   // pull one record of data out of the $results1 array and copy it to $row1
										$row1 = $results1->fetch_assoc();
											
										// extract the values from the $row1 array, and copy them into variables that
										// have the same names as the field names in the table
										extract ($row1);
									
										echo "<option>"; 
										echo $wkLocDescription;
										echo "</option>";
										echo  "<br />";	
												
										// Volunteer display loop for each row of data, put the values into an array called $row
										$count1 = $count1 + 1;
									}	
							?> 
							</optgroup>
						</select>
						<br /><br /><br />
						<div id="sendform1"> <!-- ===== sending form ============-->					
								<input type="Submit" Value="SUBMIT"></input>
						</div>
			</form>	
					</div>	
				</div>																	
			<form name="listingMenu" action="listRecords.php" method="get">
			<div = id="sendform2"> <!-- ===== sending form ============-->					
					<input type="Submit" Value="LISTING MENU"></input>
			</div>
			</form>
			<form name="mainMenu" action="mainMenu.php" method="get">
				<div = id="sendform2"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="MAIN MENU"></input>
				</div>
			</form>
			<form name="resetform" action="trainingSessionsListing.php" method="get">
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