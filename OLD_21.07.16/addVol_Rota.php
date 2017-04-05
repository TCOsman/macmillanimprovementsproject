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

// set up the SQL query to retrive wkLoc ID
$query2 = "SELECT wkLocID, wkLocDescription
		  FROM workLoc
		  ORDER BY wkLocDescription";

// execute query2
$results2 = $connect->query($query2);

// count the number of rows that will be selected from the table 
$numrow2 = $results2->num_rows;

// set up the SQL query to retrive job Role ID
$query3 = "SELECT jobID, jobDescription
		  FROM jobRole
		  ORDER BY jobDescription";

// execute query3
$results3 = $connect->query($query3);

// count the number of rows that will be selected from the table 
$numrow3 = $results3->num_rows;
?>

<html lang="en" xml:lang="en">  
	<head>  
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
		<title>Jorge Souza - Macmillan Caring Locally Database System</title>
		<script src="JS_Web/fontsize.js"></script>
		<link type="text/css" href="Jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="Jquery/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="Jquery/js/jquery-ui-1.10.4.custom.min.js"></script>	
		<script type="text/javascript" src="JS_Web/datepicker2.js"></script>
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Weekly Rota Details</div>
			<!-- form with six fields and a submit buttons -->
			<form name="inputRota" action="addVol_RotaToDB.php" method="get">
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

						*Location:	
						<select name="wkLocID" required>
							<optgroup label=""><option></option></optgroup>  <!-- =====blanked first option ====== -->
							<optgroup label="Location">

							<?php
								// workLoc display loop for each row of data, put the values into an array called $row2
								$count2 = 0;
								while ($count2 < $numrow2) 
									{
									   // pull one record of data out of the $results2 array and copy it to $row2
										$row2 = $results2->fetch_assoc();
											
										// extract the values from the $row2 array, and copy them into variables that
										// have the same names as the field names in the table
										extract ($row2);
									
										echo "<option>"; 
										echo $wkLocID." >>  ".$wkLocDescription;
										echo "</option>";
										echo  "<br />";	
												
										// workLoc display loop for each row of data, put the values into an array called $row2
										$count2 = $count2 + 1;
									}
									
							?> 
							</optgroup>
						</select>

						*Job Role:	
						<select name="jobID" required>
							<optgroup label=""><option></option></optgroup>  <!-- =====blanked first option ====== -->
							<optgroup label="Job Role">

							<?php
								// jobRole display loop for each row of data, put the values into an array called $row3
								$count3 = 0;
								while ($count3 < $numrow3) 
									{
									   // pull one record of data out of the $results3 array and copy it to $row3
										$row3 = $results3->fetch_assoc();
											
										// extract the values from the $row3 array, and copy them into variables that
										// have the same names as the field names in the table
										extract ($row3);
									
										echo "<option>"; 
										echo $jobID." >>  ".$jobDescription;
										echo "</option>";
										echo  "<br />";	
												
										// jobRole display loop for each row of data, put the values into an array called $row3
										$count3 = $count3 + 1;
									}
									
							?> 
							</optgroup>
						</select>
					</div>	
					<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
					<label for="rotaDate">Rota Date:</label>             
						<input type="text" id="datepicker2" name="rotaDate" required></input> <br /><br />
					<!--Time: <input type="text" name="rotaTime"></input> -->
					<label for="rotaTime">Time:</label><Br /> 	    
								<input type="radio" name="rotaTime" value="1AM" checked="checked" />AM<Br />
								<input type="radio" name="rotaTime" value="2LUNCH">LUNCH<br />
								<input type="radio" name="rotaTime" value="3PM">PM<Br />
								<input type="radio" name="rotaTime" value="4EVE">EVEN <Br />
					<br />
					<label for="workedHs">*Worked Hs:</label>  
						<input type="text" name="workedHs" maxlength="3" size="3" required></input>
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
			<form name="resetform" action="addVol_Rota.php" method="get">
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