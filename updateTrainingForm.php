<?php

// connect to the database
require "dbconn.php";

// Test to check if the database is connected
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
    {
	echo "Failed to connect to MYSQL: " . $connect->connect_error;
    }

// to store the training information 
$trID = $_GET['trID'];

// set the SQL query
$query = "SELECT trID, trDescription, trType
		  FROM training
		  WHERE trID = '".$trID."'";

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
			Jorge Souza - Macmillan Caring Locally Database System
		</title>
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Edit Training Details</div>
			<!-- form with two fields and a submit button -->
				<form name="updateTraining" action="updateTraining.php" method="get">
					<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
						<br /><br />
						<label for="trID">Training ID:</label><input id="notEditable" type="text" name="trID" size="3"
							value="<?php echo $row['trID']; ?>" readonly="true"></input>
							
						<br /><br />
						<label for="trDescription">Description:</label>   
							<input type="text" name="trDescription" maxlength="60" size="60" 
								value="<?php echo $row['trDescription']; ?>" required></input>
						<br /><br />
						<label for="trType">Type:</label>    
								<input type="radio" name="trType" 
									<?=$row['trType']=="1Mandatory" ? "checked" : ""?> value="1Mandatory">Mandatory
								
								<input type="radio" name="trType" 
									<?=$row['trType']=="2Optional" ? "checked" : ""?> value="2Optional">Optional
								
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
				<form name="resetform" action="trainingListing_desc.php" method="get">
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

<?php
// Closing Connection	
mysqli_close($connect); 
// Exits the script
exit();
?>

