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

// set up the SQL query to retrive volunteer ID
$query1 = "SELECT trID, trDescription
		  FROM training
		  ORDER BY trDescription";

// execute query1
$results1 = $connect->query($query1);

// count the number of rows that will be selected from the table 
$numrow1 = $results1->num_rows;

// set up the SQL query to retrive wkLoc ID
$query2 = "SELECT volID, volName, volSurname
		  FROM volunteer
		  ORDER BY volName";

// execute query2
$results2 = $connect->query($query2);

// count the number of rows that will be selected from the table 
$numrow2 = $results2->num_rows;

?>

<html lang="en" xml:lang="en">  
	<head>  
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
		<title>
			Jorge Souza - Macmillan Caring Locally Database System
		</title>
		<link rel="stylesheet" type="text/css" href="../css/feedback.css"/>
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
			<div id="title">Volunteers Training Details</div>
			<!-- form with four fields and a submit buttons -->
			<form name="inputDriver" action="addVol_TrainingToDB.php" method="get">
				<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
					<div id="identification"> <!-- ======================== identification information ========================= -->
						*Training:	
						<select name="trID" required>
							<optgroup label=""><option></option></optgroup>  <!-- =====blanked first option ====== -->
							<optgroup label="Training">

							<?php
								// Training display loop for each row of data, put the values into an array called $row1
								$count1 = 0;
								while ($count1 < $numrow1) 
									{
									   // pull one record of data out of the $results1 array and copy it to $row1
										$row1 = $results1->fetch_assoc();
											
										// extract the values from the $row1 array, and copy them into variables that
										// have the same names as the field names in the table
										extract ($row1);
									
										echo "<option>"; 
										echo $trID." >> ".$trDescription;
										echo "</option>";
										echo  "<br />";	
												
										// Volunteer display loop for each row of data, put the values into an array called $row1
										$count1 = $count1 + 1;
									}
									
							?> 
							</optgroup>
							<br />
						</select>
						*Volunteer:	
						<select name="volID" required>
							<optgroup label=""><option></option></optgroup>  <!-- =====blanked first option ====== -->
							<optgroup label="Volunteer">
							<?php
								// Volunteer display loop for each row of data, put the values into an array called $row2
								$count2 = 0;
								while ($count2 < $numrow2) 
									{
									   // pull one record of data out of the $results2 array and copy it to $row2
										$row2 = $results2->fetch_assoc();
											
										// extract the values from the $row2 array, and copy them into variables that
										// have the same names as the field names in the table
										extract ($row2);
									
										echo "<option>"; 
										echo $volID." >> ".$volName." ".$volSurname;
										echo "</option>";
										echo  "<br />";	
												
										// workLoc display loop for each row of data, put the values into an array called $row2
										$count2 = $count2 + 1;
									}
									
							?> 
							</optgroup>
							<br />
						</select>	
					</div>					
					<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
					<label for="TrDate">*Session Date:</label>          
						<input type="text" id="datepicker1" name="TrDate" required></input> <br /><br />
					<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
					<label for="vTrExpDate">*Expiration Date:</label>    
						<input type="text" id="datepicker2" name="vTrExpDate" required></input> <br /><br />				
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
			<form name="resetform" action="addVol_Training.php" method="get">
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