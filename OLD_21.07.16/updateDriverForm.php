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

// to store the Driver information 
$volID = $_GET['volID'];

echo $volID;

// set the SQL query
$query = "SELECT d.volID, d.drLicence, d.drExpDate, d.drTestedDate,  
		    v.volName, v.volSurname   
			FROM driver d, volunteer v
			WHERE d.volID = '".$volID."'
			AND d.volID = v.volID";

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
			<div id="title">Edit Driver's Details</div>
			<!-- form with two fields and a submit button -->
				<form name="updateDriver" action="updateDriver.php" method="get">
					<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
						<br /><br />
						<label for="volunteer">Driver:</label><input id="notEditable" type="text" name="volunteer" 
						value="<?php echo $row['volID']." ".$row['volName']." ".$row['volSurname']; ?>"  readonly="true"></input>
						<br /><br />
						<label for="drLicence">*DL Number:</label> 
							<input type="text" name="drLicence" maxlength="10" size="10" 
							   value="<?php echo $row['drLicence']; ?>" required></input>
						<br /><br />
						<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
						<label for="drExpDate">*DL Exp. Date:</label>    
							<input type="text" id="datepicker1" name="drExpDate" 
								value="<?php echo $row['drExpDate']; ?>" required></input>	
						<br /><br />
						<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
						<label for="drTestedDate">*Driver Tested on:</label>    
							<input type="text" id="datepicker2" name="drTestedDate" 
								value="<?php echo $row['drTestedDate']; ?>" required></input>			
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
				<form name="resetform" action="driverDates.php" method="get">
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
