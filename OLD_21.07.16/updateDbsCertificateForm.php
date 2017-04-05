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
$dbsID = $_GET['dbsID'];

// set the SQL query
$query = "SELECT d.dbsCertNumber, d.dbsSentDate, d.dbsCertDate, d.volID, d.dbsID,
		    v.volName, v.volSurname   
			FROM dbsCertificate d, volunteer v
			WHERE dbsID = '".$dbsID."'
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
			<div id="title">Edit DBS Certificate Details</div>
			<!-- form with two fields and a submit button -->
				<form name="updateDBS" action="updateDbsCertificate.php" method="get">
					<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
						<br /><br />
						<label for="volunteer">Name:</label><input id="notEditable" type="text" name="volunteer" 
						value="<?php echo $row['volName']." ".$row['volSurname']; ?>"  readonly="true"></input>
						<br /><br />
						<label for="dbsID">DBS ID:</label><input id="notEditable" type="text" name="dbsID" size="2" 
							value="<?php echo $row['dbsID']; ?>" readonly="true"></input>
						<br /><br />
						<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
						<label for="dbsSentDate">*DBS Sent date:</label>    
							<input type="text" id="datepicker1" name="dbsSentDate" 
								value="<?php echo $row['dbsSentDate']; ?>" required></input>	
						<br /><br />
						<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
						<label for="dbsCertDate">*DBS Exp. Date:</label>    
							<input type="text" id="datepicker2" name="dbsCertDate" 
								value="<?php echo $row['dbsCertDate']; ?>" required></input>			
						<br /><br />
						<label for="dbsCertNumber">*DBS Cert No:</label> 
							<input type="text" name="dbsCertNumber" maxlength="10" size="10" 
							   value="<?php echo $row['dbsCertNumber']; ?>" required></input>	


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