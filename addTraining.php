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
				<div id="title">Training Details</div>
				<br />
				<!-- form with two fields and a submit buttons -->
				<form name="inputTraining" action="addTrainingToDB.php" method="get">
					<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
						<br />
						<label for="trID">*Description:</label>    
						<input type="text" name="trDescription" maxlength="60" size="60"required></input> <br /><br />
						<label for="trType">Type:</label>    
								<input type="radio" name="trType" value="1MANDATORY" checked="checked" />Mandatory 
								<input type="radio" name="trType" value="2OPTIONAL">Optional 							
					<br />
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
			<form name="resetform" action="addTraining.php" method="get">
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