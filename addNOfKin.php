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
$query1 = "SELECT volID, volName, volSurname
		  FROM volunteer
		  ORDER BY volName";

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
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Next of Kin Details</div>
			<br />
			<!-- form with seven fields and a submit buttons -->
			<form name="inputNOfkin" action="addNofKinToDB.php" method="get">
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
														
												// Volunteer display loop for each row of data, put the values into an array called $row
												$count1 = $count1 + 1;
											}									
									?> 
									</optgroup>
								</select>
					</div>									
					<br />
					<label for="nkinName">*Name:</label>                 
						<input type="text" name="nkinName" maxlength="20" size="20" required></input><br /><br />
					<label for="nkinSurname">*Surname:</label>           
						<input type="text" name="nkinSurname" maxlength="20" size="20" required></input><br /><br />
					<label for="nkinPhone1">*Contact1:</label>           
						<input type="text" name="nkinPhone1"maxlength="15" size="15" required></input><br /><br />
					<label for="nkinPhone2">Contact2:</label>             
						<input type="text" name="nkinPhone2" maxlength="15" size="15"></input><br /><br />
					<label for="relationship">*Relationship:</label>
						<select name="nkinRelationship" required>
								<optgroup label=""><option></option></optgroup> <!-- =====blanked first option ======-->
								<optgroup label="Relationship">
									<option>Brother</option>
									<option>Colleague</option>
									<option>Daughter</option>
									<option>Father</option>
									<option>Husband</option>
									<option>Mother</option>
									<option>Partner</option>
									<option>Son</option>
									<option>Sister</option>
									<option>Step Daughter</option>
									<option>Step Son</option>
									<option>Wife</option>
								</optgroup>
						</select>
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
			<form name="resetform" action="addNOfKin.php" method="get">
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