<?php
// ************************** SECURITY CHECKS **************************
//User Level 1 
require "session1.php";
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
				Manage Files
			</div>
			<br />
			<div id="menuOptions"> <!-- ======================== Specifies what type o action is needed ========================= -->
				<div id="menuButtons1"> 
					<a class="menubutton1" href="upload.php">Upload</a>
				</div>	
				<div id="menuButtons2"> 
					<a class="menubutton1" href="exportToCsv.php">Download</a>
				</div>	
			</div>	
		</div>
			<form name="exitform" action="logOut.php" method="get">
				<div = id="sendform"> <!-- ===== EXIT THE DATABASE form ============-->					
					<input type="Submit" Value="LOGOUT"></input>
				</div>
			</form>
			<form name="exitform" action="adminHome.php" method="get">
				<div = id="sendform3"> <!-- ===== Redirects user to adm page ============-->					
					<input type="Submit" Value="SYSTEM ADMIN"></input>
				</div>
			</form>
		</div>
		<div id="footer"> <!-- ======================== Main page footer ========================= -->
			Jorge Souza - Bournemouth University  
			| For more information, please contact us by email i7250872@bournemouth.ac.uk
		</div>
	</body>
</html>