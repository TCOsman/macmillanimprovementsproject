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
				Record has been added 
			</div>
			<br />
			<div id="menuOptions"> <!-- ======================== Specifies what type o action is needed ========================= -->
				<div id="menuButtons3"> 
					<a class="menubutton1" href="addInsurance.php">ADD ANOTHER RECORD</a><br /><br />
					<br /><br />						
					<a class="menubutton1" href="listRecords.php">LISTING MENU</a>
				</div>	
			</div>	
			<form name="exitform" action="index.html" method="get">
				<div = id="sendform"> <!-- ===== EXIT THE DATABASE form ============-->					
					<input type="Submit" Value="EXIT"></input>
				</div>
			</form>
			<form name="mainMenu" action="addRecords.php" method="get">
				<div = id="sendform3"> <!-- ===== Goes back to the main Menu form ============-->					
					<input type="Submit" Value="ADD RECORDS MENU"></input>
				</div>
			</form>
		</div>
		<div id="footer"> <!-- ======================== Main page footer ========================= -->
			Jorge Souza - Bournemouth University  
			| For more information, please contact us by email i7250872@bournemouth.ac.uk
		</div>
	</body>
</html>