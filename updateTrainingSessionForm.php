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
$vTrID = $_GET['vTrID'];

// set the SQL query
$query = "SELECT s.vTrID, s.TrDate, s.trID, s.volID, s.vTrExpDate,
		    v.volName, v.volSurname, t.trDescription 
			FROM vol_training s, volunteer v, training t
			WHERE s.vTrID = '".$vTrID."'
			AND s.volID = v.volID
			AND s.trID = t.trID"; 

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
			<div id="title">Edit Training Sessions Details</div>
			<!-- form with two fields and a submit button -->
				<form name="updateTrainingSession" action="updateTrainingSession.php" method="get">
					<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
						<br /><br />
						<label for="insID">ID:</label><input id="notEditable" type="text" name="vTrID"  size="2" 
							value="<?php echo $row['vTrID']; ?>"  readonly="true"></input>
						<br /> 
						<label for="volunteer">Volunteer:</label><input id="notEditable" type="text" name="volunteer" 
							value="<?php echo $row['volName']." ".$row['volSurname']; ?>"  readonly="true"></input>
						<br /> 
						<label for="trDescription">Description:</label> 
							<input type="text" name="trDescription" maxlength="20" size="20"  id="notEditable"
							   value="<?php echo $row['trDescription']; ?>"></input>	
						<br /><br />
						<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
						<label for="TrDate">*Sesion Date:</label>    
							<input type="text" id="datepicker1" name="TrDate" 
								value="<?php echo $row['TrDate']; ?>" required></input>	
						<br /><br />
						<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
						<label for="vTrExpDate">*Retake Until:</label>    
							<input type="text" id="datepicker2" name="vTrExpDate" 
								value="<?php echo $row['vTrExpDate']; ?>" required></input>			
						<br /><br />
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
				<form name="resetform" action="trainingSessionsListing.php" method="get">
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
