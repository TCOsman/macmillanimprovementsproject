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

// to store the DBS Certificate information 
$nkinID = $_GET['nkinID'];

// set the SQL query
$query = "SELECT nkinID, nkinName, nkinSurname, 
			nkinPhone1, nkinPhone2, nkinRelationship 
			FROM nOfKin 
			WHERE nkinID = '".$nkinID."'"; 

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
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Edit Next of Kin Details</div>
			<!-- form with two fields and a submit button -->
				<form name="updateNofKin" action="updateNofKin.php" method="get">
					<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
						<br /> 
						<label for="nkinID">nKinID:</label><input id="notEditable" type="text" name="nkinID"  size="2" 
							value="<?php echo $row['nkinID']; ?>"  readonly="true"></input>
						<br /><br /> 						
						<label for="nkinName">*Name:</label>                 
							<input type="text" name="nkinName" maxlength="20" size="20" 
								value="<?php echo $row['nkinName']; ?>" required></input><br /><br />
						<label for="nkinSurname">*Surname:</label>           
							<input type="text" name="nkinSurname" maxlength="20" size="20" 
								value="<?php echo $row['nkinSurname']; ?>" required></input><br /><br />
						<label for="nkinPhone1">*Contact1:</label>           
							<input type="text" name="nkinPhone1"maxlength="15" size="15"
							value="<?php echo $row['nkinPhone1']; ?>" </input><br /><br />
						<label for="nkinPhone2">Contact2:</label>             
							<input type="text" name="nkinPhone2" maxlength="15" size="15" 
								value="<?php echo $row['nkinPhone2']; ?>" required></input><br /><br />
						<label for="relationship">*Relationship:</label>
						<select name="nkinRelationship" required>
								<optgroup label=""><option></option></optgroup> <!-- =====blanked first option ======-->
								<optgroup label="Relationship">
									<option>Brother</option>
									<option>Colleague</option>
									<option>Daughter</option>
									<option>Father</option>
									<option>Husband</option>
									<option>Mother</option>
									<option>Partner</option>
									<option>Son</option>
									<option>Sister</option>
									<option>Step Daughter</option>
									<option>Step Son</option>
									<option>Wife</option>
								</optgroup>
						</select>
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
				<form name="resetform" action="nOfKinListing_name.php" method="get">
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
