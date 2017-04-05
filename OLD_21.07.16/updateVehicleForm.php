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

// to store the Driver information 
$vehID = $_GET['vehID'];


// set the SQL query
$query = "SELECT  vehID, vehReg, vehMake, vehNOfDoors, vehNote
			FROM  vehicle
			WHERE vehID = '".$vehID."'";

// execute the query
$results = $connect->query($query);

// Check number of rows returned
if ( $results->num_rows != 1 )
  die("Database did not return one result");
else
  {
  $row = $results->fetch_assoc();
  }
?>

<html lang="en" xml:lang="en">  
	<head>  
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
		<title>
			Jorge Souza - Macmillan Caring Locally 
		</title>
		<script src="JS_Web/fontsize.js"></script>
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Edit Vehicle's Details</div>
			<!-- form with two fields and a submit button -->
				<form name="updateVehicle" action="updateVehicle.php" method="get">
					<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
						<br /><br />
						<label for="vehID">Vehicle ID:</label>   
							<input type="text" id="notEditable" name="vehID" size="3" 
								value="<?php echo $row['vehID']; ?>" readonly="true"></input> <br /><br />
						<label for="vehReg">*Registration:</label>   
							<input type="text" name="vehReg" maxlength="10" size="10" 
								value="<?php echo $row['vehReg']; ?>" required></input> <br /><br />
						<label for="vehMake">*Make:</label> 
							<input type="text" name="vehMake" maxlength="20" size="20" 
								value="<?php echo $row['vehMake']; ?>" required></input> <br /><br />
						<label for="vehNOfDoors">*No Of Doors:</label> 
							<input type="text" name="vehNOfDoors" maxlength="2" size="2"  
								value="<?php echo $row['vehNOfDoors']; ?>" required></input> <br /><br />
						<label for="vehNote">Notes:</label> 
							<input type="text" name="vehNote"maxlength="40" size="40"
								value="<?php echo $row['vehNote']; ?>"></input> 		
						<br /><br />
					</div>
					<div = id="sendform"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="UPDATE"></input>
					</div>
				</form>
				<form name="mainMenu" action="mainMenu.php" method="get">
					<div = id="sendform2"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="MAIN MENU"></input>
					</div>
				</form>
				<form name="resetform" action="driverDates.php" method="get">
					<div = id="sendform3"> <!-- ===== reset form ============-->					
						<input type="Submit" Value="GO BACK"></input>
					</div>
				</form>
		</div>
		<div id="footer"> <!-- ======================== Main page footer ========================= -->
			Jorge Souza - Bournemouth University  
			| For more information, please contact us by email i7250872@bournemouth.ac.uk
		</div>
	</body>
</html>

