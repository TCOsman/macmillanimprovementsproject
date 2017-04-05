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
				List Records
			</div>
			<br />
			<div id="menuOptions"> <!-- ======================== Specifies what type o action is needed ========================= -->
				<div id="menuButtons3"> 
					<a class="menubutton2" href="availabilityListing.php">AVAILABILITY</a>
					<a class="menubutton2" href="cklistListing_name.php">CHECKLIST</a>
					<a class="menubutton2" href="volunteerListing_contact.php">CONTACT DETAILS</a>
					<a class="menubutton2" href="dbsCertificateDates.php">DBS</a>
					<a class="menubutton2" href="driverDates.php">DRIVER</a>					
				</div>	
				<div id="menuButtons4"> 
				<a class="menubutton2" href="insuranceListingDates.php">INSURANCE</a>
					<a class="menubutton2" href="jobRoleListing_desc.php">JOB ROLE</a>
					<a class="menubutton2" href="locationListing_desc.php">LOCATIONS</a>
					<a class="menubutton2" href="motListingDates.php">MOT</a>
					<a class="menubutton2" href="nOfKinListing_name.php">NEXT OF KIN</a>
					<a class="menubutton2" href="WeeklyRotaDates.php">ROTAS</a>	
				</div>	
				<div id="menuButtons5">  								
					<a class="menubutton2" href="trainingListing_desc.php">TRAINING</a>
					<a class="menubutton2" href="trainingSessionsListing.php">TRAINING SESSIONS</a>
					<a class="menubutton2" href="vehicleListing_reg.php">VEHICLE</a>				
					<a class="menubutton2" href="volunteerListing_name.php">VOLUNTEER</a>
					<a class="menubutton2" href="workedHours.php">WORKED HOURS</a>
				</div>	
			</div>	
			<form name="exitform" action="logOut.php" method="get">
				<div = id="sendform"> <!-- ===== EXIT THE DATABASE form ============-->					
					<input type="Submit" Value="LOGOUT"></input>
				</div>
			</form>
			<form name="mainMenu" action="mainMenu.php" method="get">
				<div = id="sendform3"> <!-- ===== Goes back to the main Menu form ============-->					
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