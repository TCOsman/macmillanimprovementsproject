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
			<div id="menus">
				Database System <br />
				Add Records
			</div>
			<br />
			<div id="menuOptions"> <!-- ======================== Specifies what type o action is needed ========================= -->
				<div id="menuButtons3"> 
					<a class="menubutton2" href="addVol_Availability.php">AVAILABILITY</a>
					<a class="menubutton2" href="addRecrCklist.php">CHECKLIST</a>
					<a class="menubutton2" href="addDbsCertificate.php">DBS CERT.</a>					
					<a class="menubutton2" href="addDriver.php">DRIVER</a>	
				</div>	
				<div id="menuButtons4"> 
					<a class="menubutton2" href="addInsurance.php">INSURANCE</a>
					<a class="menubutton2" href="addJobRole.php">JOB ROLE</a>	
					<a class="menubutton2" href="addWorkLoc.php">LOCATIONS</a>	
					<a class="menubutton2" href="addNOfKin.php">NEXT OF KIN</a>	
				</div>	
				<div id="menuButtons5"> 
					<a class="menubutton2" href="addVol_Rota.php">ROTAS</a>		
					<a class="menubutton2" href="addTraining.php">TRAINING</a>		
					<a class="menubutton2" href="addVol_Training.php">TRAINING SESSION</a>
					<a class="menubutton2" href="addVehicle.php">VEHICLE</a>					
					<a class="menubutton2" href="addVolunteer.php">VOLUNTEER</a>
				</div>	
			</div>	
			<form name="exitform" action="logOut.php" method="get">
				<div = id="sendform"> <!-- ===== EXIT THE DATABASE form ============-->					
					<input type="Submit" Value="LOGOUT"></input>
				</div>
			</form>
			<form name="mainMenu" action="mainMenu.php" method="get">
				<div = id="sendform3"> <!-- ===== Goes back to the main Menuform ============-->					
					<input type="Submit" Value="MAIN MENU"></input>
				</div>
			</form>
		</div>
		<div id="footer"> <!-- ======================== Main page footer ========================= -->
			Jorge Souza - Bournemouth University  
			| For more information, please contact us by email i7250872@bournemouth.ac.uk
		</div>
	</body>
</html>