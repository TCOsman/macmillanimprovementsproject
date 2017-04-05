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

// to set a variable which holds the query results - Ordered by volID
$get = $connect->query("SELECT volName, volSurname, volAddress1, volAddress2, volAddress3,
						  volTown, volPostcode 
						  FROM volunteer
						  WHERE volTermReason = ' '
						  ORDER BY volName");
						  
// count the number of rows that will be selected from query 
$numrow = $get->num_rows;
?>

<!DOCTYPE html> 
<html lang="en" xml:lang="en">  
	<head>  
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
		<title>
			Jorge Souza - MacMillan Caring Locally Database System
		</title>
		<link rel="stylesheet" type="text/css" href="css/listing.css"/>
	</head>
	<body>
		<div id="title">Export Details</div>
		<br />		
			<table border="1" class="tableStyle" >
				<th class="twenty">Name</th>				
				<th class="thirty">Address1</th>
				<th class="thirty">Address2</th>
				<th class="thirty">Address3</th>
				<th class="ten">Town</th>
				<th class="ten">Postcode</th>
				<?php	
					// for each row of data, put the values into an array called $row
					$count = 0;
					while ($count < $numrow)
						{
							// pull one record of data out of the $results array and copy it to $row
							$row = $get->fetch_assoc(); 
								
							// extract the values from the $row array, and copy them into variables that
							// have the same names as the field names in the table
							extract ($row);
								
							// send the values to the browser as a row in a table

							echo "<tr>";
							echo "<td>";
							echo $volName." ".$volSurname; 
							echo "</td>";

							echo "<td>";
							echo $volAddress1; 
							echo "</td>";
							
							echo "<td>";
							echo $volAddress2; 
							echo "</td>";
							
							echo "<td>";
							echo $volAddress3; 
							echo "</td>";
							
							echo "<td>";
							echo $volTown; 
							echo "</td>";
							
							echo "<td>";
							echo $volPostcode; 
							echo "</td>";
							
							// increase the value of the variable 
							$count = $count + 1;
							 
						}	
			echo "</table>";						
					?> 
				<form name="listingMenu" action="listRecords.php" method="get">
					<div = id="sendform1"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="LISTING MENU"></input>
					</div>
				</form>
				<form name="pdfform" action="exportAddress.php" method="get">
					<div = id="sendform2"> <!-- ===== Generates Excel file ============-->					
						<input type="Submit" Value="EXPORT TO EXCEL"></input>
					</div>
				</form>
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