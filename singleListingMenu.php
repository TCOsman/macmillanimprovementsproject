  <?php
// ************************** SECURITY CHECKS **************************
//User Level 3
require "session3.php";
?>

<?php

// connect to the database
require "dbconn.php";

// Test to check if the database is connected
$connect = new mysqli($host, $user, $password, $database);

$username = $_SESSION['login_user'];

if ($connect->connect_errno)
    {
	echo "Failed to connect to MYSQL: " . $connect->connect_error;
    }

// set up the SQL query to retrive volunteer username
$query = "SELECT *
		  FROM singleAvailabilitysView 
		  WHERE username = '".$username."'";
		  
// execute query
$results = $connect->query($query);

// count the number of rows that will be selected from the table 
$numrow = $results->num_rows;
?>

<html lang="en" xml:lang="en">  
	<head>  
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
		<title>
			Jorge Souza - Macmillan Caring Locally Database System
		</title>
		<script src="JS_Web/fontsize.js"></script>
		<link type="text/css" href="Jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="Jquery/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="Jquery/js/jquery-ui-1.10.4.custom.min.js"></script>	
		<script type="text/javascript" src="JS_Web/datepicker1.js"></script>
		<script type="text/javascript" src="JS_Web/datepicker2.js"></script>
		<link rel="stylesheet" type="text/css" href="css/listing.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Single Listing</div>
			<br />
			<!-- form with two fields and a submit button -->
			<form name="sessionDates" action="singleListingRota.php" method="get">
						<div id="dateLeft"> <!-- ======================== search training sessions by dates ========================= -->
							<h3>Rotas Dates:</h3>
							<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
							<label for="startDate">*Start Date:</label>        
								<input type="text" id="datepicker1" name="startDate" required></input><br />
							<br />
							<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
							<label for="endDate">*End Date:</label>        
								<input type="text" id="datepicker2" name="endDate" required></input><br />
							<br />
							<div id="sendform1"> <!-- ===== sending form ============-->					
								<input type="Submit" Value="SUBMIT"></input>
							</div>
			</form>	
						</div>
			<!-- form with one field and a submit button -->
			<form name="sessionsNames" action="trainingSessionsListing_name.php" method="get">
				<div id="dateRight"> <!-- ======================== search training sessions by names ========================= -->
					
							<?php
							// pull one record of data out of the $results array and copy it to $row
							$row = $results->fetch_assoc();
							
							// extract the values from the $row array, and copy them into variables that
							// have the same names as the field names in the table
							extract ($row);
							echo "<h3>";
							echo "Welcome ".$volName." ".$volSurname;
							echo "</h3>";
							
							echo "<th>";
							echo "Availability";
							echo "</th>";
					?>
					<table border="1" class="tableStyle" >
						<th class="twenty">Location</th>
						<th class="five">FREQUENCY</th>
						<th class="ten">DAY</th>
						<th class="five">TIME</a></th>
						<th class="fifteen">JOB ROLE</th>
						<th class="fourty">EXTRA NOTES</th>
					<?php								
						// for each row of data, put the values into an array called $row2
						// for each row of data, put the values into an array called $row
						$count  = 0;
						while ($count < $numrow)
							{
								// pull one record of data out of the $results array and copy it to $row
								$row = $results->fetch_assoc();
									
								// extract the values from the $row array, and copy them into variables that  // bcdefecho "substr"($availFreq,0,5); 
								// have the same names as the field names in the table	
								if ($row !== NULL)
									extract ($row);
								
								echo "<tr>";
								echo "<td>";
								echo  $wkLocDescription; 		
								echo "</td>";			
								
								echo "<td>";
								echo substr($availFreq, 1);    
								echo "</td>";
								
								echo "<td>";
								echo substr($availDay, 1); 
								echo "</td>";
								
								echo "<td>";
								echo substr($availTime, 1); 
								echo "</td>";
								
								echo "<td>";
								echo $jobDescription; 
								echo "</td>";
								
								echo "<td>";
								echo $availNote; 
								echo "</td>";							
								
								// increase the value of the variable 
								$count = $count + 1;
								 
							}	
					  echo "</table>";
					  echo "<br />";		
					?> 
			</form>	

				</div>																	
			<form name="resetform" action="singleListingMenu.php" method="get">
				<div = id="sendform2"> <!-- ===== reset form ============-->					
						<input type="Submit" Value="RESET"></input>
				</div>
			</form>
				<form name="logOut" action="logOut.php" method="get">
			<div = id="sendform3"> <!-- ===== sending form ============-->					
					<input type="Submit" Value="LOGOUT"></input>
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