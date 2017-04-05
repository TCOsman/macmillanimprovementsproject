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
$insID = $_GET['insID'];

// set the SQL query
$query = "SELECT i.insID, i.insPolicy, i.insExpDate, i.MOT, i.insNote, i.volID, i.vehID,
		    v.volName, v.volSurname, h.vehReg   
			FROM insurance i, volunteer v, vehicle h
			WHERE i.insID = '".$insID."'
			AND i.volID = v.volID
			AND i.vehID = h.vehID"; 

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
		<script src="JS_Web/fontsize.js"></script>
		<link type="text/css" href="Jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="Jquery/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="Jquery/js/jquery-ui-1.10.4.custom.min.js"></script>	
		<script type="text/javascript" src="JS_Web/datepicker1.js"></script>
		<script type="text/javascript" src="JS_Web/datepicker2.js"></script>
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Edit Car Insurance Details</div>
			<!-- form with two fields and a submit button -->
				<form name="updateDBS" action="updateInsurance.php" method="get">
					<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
						<br /><br />
						<label for="insID">insID:</label><input id="notEditable" type="text" name="insID"  size="2" 
							value="<?php echo $row['insID']; ?>"  readonly="true"></input>
						<br /> 
						<label for="volunteer">Driver:</label><input id="notEditable" type="text" name="volunteer" 
							value="<?php echo $row['volName']." ".$row['volSurname']; ?>"  readonly="true"></input>
						<br /> 
						<label for="vehReg">Registration:</label><input id="notEditable" type="text" name="vehReg" size="5" 
							value="<?php echo $row['vehReg']; ?>" readonly="true"></input>
						<br /><br />

						
						<label for="insPolicy">*Policy No:</label> 
							<input type="text" name="insPolicy" maxlength="10" size="10" 
							   value="<?php echo $row['insPolicy']; ?>" required></input>	
						
						
						<br /><br />
						<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
						<label for="insExpDate">*Policy Exp Date:</label>    
							<input type="text" id="datepicker1" name="insExpDate" 
								value="<?php echo $row['insExpDate']; ?>" required></input>	
						<br /><br />
						<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
						<label for="MOT">*MOT Date:</label>    
							<input type="text" id="datepicker2" name="MOT" 
								value="<?php echo $row['MOT']; ?>" required></input>			
						<br /><br />
						<label for="insNote">Notes:</label> 
							<input type="text" name="insNote" maxlength="40" size="40" 
							   value="<?php echo $row['insNote']; ?>" required></input>	
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
				<form name="resetform" action="dbsCertificateDates.php" method="get">
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
