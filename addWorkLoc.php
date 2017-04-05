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
			<div id="title">Work Location Details</div>
			<!-- form with two fields and a submit button -->
				<form name="inputWorkLoc" action="addWorkLocToDB.php" method="get">
					<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
						<br /><br />
						<label for="wkLocDescription">Description:</label>   
							<input type="text" name="wkLocDescription" maxlength="30" size="30" required></input>
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
				<form name="resetform" action="addWorkLoc.php" method="get">
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
// Closing Connection	
mysqli_close($connect);  
// jump to the next page
exit();
?>