<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php

// connect to the database
require "dbconn.php";

//$host = "localhost";
//$user = "root"; == for the assignment a better security control level will be implemented
//$password = "";
//$database = "mcl";

// Test to check if the database is connected
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
    {
	echo "Failed to connect to MYSQL: " . $connect->connect_error;
    }

// set up the SQL query to retrive volunteer ID
$query1 = "SELECT volID, volName, volSurname
		  FROM volunteer
		  ORDER BY volName";

// execute query1
$results1 = $connect->query($query1);

// count the number of rows that will be selected from the table 
$numrow1 = $results1->num_rows;

// set up the SQL query to retrive job role ID
$query2 = "SELECT jobID, jobDescription
		  FROM jobrole
		  ORDER BY jobDescription";

// execute query2
$results2 = $connect->query($query2);

// count the number of rows that will be selected from the table 
$numrow2 = $results2->num_rows;

// set up the SQL query to retrive wkLoc ID
$query3 = "SELECT wkLocID, wkLocDescription
		  FROM workLoc
		  ORDER BY wkLocDescription";

// execute query3
$results3 = $connect->query($query3);

// count the number of rows that will be selected from the table 
$numrow3 = $results3->num_rows;

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
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Volunteer Availability Details</div>
			<br />
			<!-- form with eight fields and a submit buttons -->
			<form name="inputAvailability" action="addVol_AvailabilityToDB.php" method="get">
				<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
					<div id="identification"> <!-- ======================== identification information ========================= -->
						*Volunteer:	
						<select name="volID" required>
							<optgroup label=""><option></option></optgroup>  <!-- =====blanked first option ====== -->
							<optgroup label="Volunteer">

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
										echo $volID." >> ".$volName." ".$volSurname;
										echo "</option>";
										echo  "<br />";	
												
										// Volunteer display loop for each row of data, put the values into an array called $row1
										$count1 = $count1 + 1;
									}									
							?> 
							</optgroup>
						</select>

						*Job Role:	
						<select name="jobID" required>
							<optgroup label=""><option></option></optgroup>  <!-- =====blanked first option ====== -->
							<optgroup label="JobRole">

							<?php
								// Job Role display loop for each row of data, put the values into an array called $row2
								$count2 = 0;
								while ($count2 < $numrow2) 
									{
									   // pull one record of data out of the $results2 array and copy it to $row2
										$row2 = $results2->fetch_assoc();
											
										// extract the values from the $row2 array, and copy them into variables that
										// have the same names as the field names in the table
										extract ($row2);
									
										echo "<option>"; 
										echo $jobID." >> ".$jobDescription;
										echo "</option>";
										echo  "<br />";	
												
										// workLoc display loop for each row of data, put the values into an array called $row2
										$count2 = $count2 + 1;
									}
									
							?> 
							</optgroup>
						</select>
						
						*Location:	
						<select name="wkLocID" required>
							<optgroup label=""><option></option></optgroup>  <!-- =====blanked first option ====== -->
							<optgroup label="Location">

							<?php
								// Location display loop for each row of data, put the values into an array called $row2
								$count3 = 0;
								while ($count3 < $numrow3) 
									{
									   // pull one record of data out of the $results2 array and copy it to $row2
										$row3 = $results3->fetch_assoc();
											
										// extract the values from the $row2 array, and copy them into variables that
										// have the same names as the field names in the table
										extract ($row3);
									
										echo "<option>"; 
										echo $wkLocID." >> ".$wkLocDescription;
										echo "</option>";
										echo  "<br />";	
												
										// workLoc display loop for each row of data, put the values into an array called $row2
										$count3 = $count3 + 1;
									}	
							?> 
							</optgroup>
						</select>	
					</div>
					<br /><br />
					<label for="availDay">Day:</label> 
								<input type="radio" name="availDay" value="1Monday" checked="checked" />Mon 
								<input type="radio" name="availDay" value="2Tuesday">Tue 
								<input type="radio" name="availDay" value="3Wednesday">Wed 
								<input type="radio" name="availDay" value="4Thursday">Thu 
								<input type="radio" name="availDay" value="5Friday">Fri 
								<input type="radio" name="availDay" value="6Saturday">Sat 
								<input type="radio" name="availDay" value="7Sunday">Sun
					<br />
					<br />
					<label for="availTime">Time:</label> 
								<input type="radio" name="availTime" value="1AM" checked="checked" />AM 
								<input type="radio" name="availTime" value="2LUNCH">Lunch 
								<input type="radio" name="availTime" value="3PM">PM 
								<input type="radio" name="availTime" value="4EVE">Even
					<br />
					<br />
					<label for="availFreq">Frequency:</label>  	    
								<input type="radio" name="availFreq" value="1WEEK" checked="checked" />Week 
								<input type="radio" name="availFreq" value="2BI-WEEK">Bi-Week 
								<input type="radio" name="availFreq" value="3MONTH">Month
								<input type="radio" name="availFreq" value="4RELIEVE">Relieve								
					<br />
					<br />
					<label for="availFreq">Note: </label> 
						<input type="text" name="availNote" maxlength="40" size="40" ></input>
					<br />
				</div>
				<div = id="sendform"> <!-- ===== sending form ============-->					
					<input type="Submit" Value="SUBMIT"></input>
				</div>
			</form>
			<form name="mainMenu" action="mainMenu.php" method="get">
				<div = id="sendform2"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="MAIN MENU"></input>
				</div>
			</form>
			<form name="resetform" action="addVol_Availability.php" method="get">
				<div = id="sendform3"> <!-- ===== reset form ============-->					
						<input type="Submit" Value="RESET"></input>
				</div>
			</form>
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