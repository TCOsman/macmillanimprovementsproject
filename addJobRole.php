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
			<div id="title">Job Role Details</div>
			<br />
			<!-- form with one field and a submit buttons -->
			<form name="inputJobRole" action="addJobRoleToDB.php" method="get">
				<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
					<br />
					<label for="jobDescription">*Description:</label>    
					<input type="text" name="jobDescription" maxlength="40" size="40" required></input>
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
			<form name="resetform" action="addJobRole.php" method="get">
				<div = id="sendform3"> <!-- ===== reset form ============-->					
					<input type="Submit" Value="RESET"></input>
				</div>
			</form>
				<br />
			<div id="footer"> <!-- ======================== Main page footer ========================= -->
				Jorge Souza - Bournemouth University  
				| For more information, please contact us by email i7250872@bournemouth.ac.uk
			</div>
		</div>
	</body>
</html>