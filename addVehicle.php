<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<!DOCTYPE html>   
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
			<div id="title">Vehicle Details</div>
			<!-- form with four fields and a submit buttons -->
			<form name="inputVehicle" action="addVehicleToDB.php" method="get">
				<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
					<br />
					<label for="vehReg">*Registration:</label>   
						<input type="text" name="vehReg" maxlength="10" size="10" required></input> <br /><br />
					<label for="vehMake">*Make:</label> 
						<input type="text" name="vehMake" maxlength="20" size="20" required></input> <br /><br />
					<label for="vehNOfDoors">*No Of Doors:</label> 
						<input type="text" name="vehNOfDoors" maxlength="2" size="2" required></input><br /><br />
					<label for="vehNote">Notes:</label> 
						<input type="text" name="vehNote"maxlength="40" size="40"></input>
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
			<form name="resetform" action="addVehicle.php" method="get">
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
// Exits the script
exit();
?>