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
 
// Variables to store dates in order to query the database	
$startDate = $_GET['startDate'];
$endDate   = $_GET['endDate'];	 
 
			// ***************  First query related to availability by work location
 
//set up the SQL query related to units
$query1 = "SELECT sum(workedHs) AS total
			FROM vol_rota 
			WHERE rotaDate >= '".$startDate."' 
			AND   rotaDate <= '".$endDate."'";  

// execute the query
$results1 = $connect->query($query1);
$row = $results1->fetch_assoc();
$results1 = $row['total'];

			// ***************  Second set of queries related to hs worked by location 

// to count the total of records found
$query2 = "SELECT sum(r.workedHs), w.wkLocDescription 
				FROM vol_rota r, workLoc w 
				WHERE rotaDate >= '".$startDate."' 
				AND   rotaDate <= '".$endDate."'
				AND r.wkLocID = w.wkLocID
				GROUP BY w.wkLocDescription
				ORDER BY w.wkLocDescription";
		  
// execute the query
$results2 = $connect->query($query2);

//count records for pagination 
$record_count = $results2->num_rows;

//max displayed records per page
$per_page = 15;
@$start = $_GET['start'];

// variable which defines how many pages will be displayed - ceil is used to round the number up 
$max_pages =  ceil ($record_count / $per_page); 

if (!$start)
   $start = 0;
		  
		  
// set up the SQL query related to volunteers and to 
// to set a variable which holds the query results -- It just considers volunteers who are Active or On hold.
$get = $connect->query("SELECT sum(r.workedHs) AS total, w.wkLocDescription 
							FROM vol_rota r, workLoc w 
							WHERE rotaDate >= '".$startDate."' 
							AND   rotaDate <= '".$endDate."'
							AND r.wkLocID = w.wkLocID
							GROUP BY w.wkLocDescription
							ORDER BY w.wkLocDescription
							LIMIT $start, $per_page"); 

// count the number of rows that will be selected from the table 
$numrow2 = $get->num_rows;
?>

<!DOCTYPE html> 
<html lang="en" xml:lang="en">  
	<head>  
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
		<title>
			Jorge Souza - MacMillan Caring Locally Database System
		</title>
		<link rel="stylesheet" type="text/css" href="css/Listing.css"/>
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Worked Hours Listing</div>
			<div id="listing"> <!-- ======================== form ========================= -->
				</br></br>
				<div id="locations"> <!-- ======================== to display the total of worked hours ========================= -->
					</br></br>
					<?php	
						
						// to store the dates with a different format
						$date1 = strtotime($startDate);
						$date2 = strtotime($endDate);
						
						echo "<h1>The total of Worked Hour from</h1>";
						echo "<h1>".date("j F Y", $date1);
						echo " to ";
						echo date("j F Y", $date2)."</h1>";
						echo "<h1>by the volunteers is: ".$results1."</h1>";
					?> 
				</div>
				<div id="volunteers"> <!--To set up a table containing hours worked by location, with pagination-->
					</br></br>
					<table border="1">
						<th class="fifteen">Location</th>
						<th class="ten">Worked Hours</th>
						
						<?php
							// for each row of data, put the values into an array called $row2
							$count = 0;
							while ($count < $numrow2)
								{
									// pull one record of data out of the $results array and copy it to $row2
									$row2 = $get->fetch_assoc(); 
											
									// extract the values from the $row2 array, and copy them into variables that
									// have the same names as the field names in the table
									extract ($row2);
											
									// send the values to the browser as a row in a table
									echo "<tr>";
									echo "<td>";
									echo $wkLocDescription;
									echo "</td>";
									
									echo "<td>";
									echo $total;
									echo "</td>";
						
									// increase the value of the variable 
									$count = $count + 1;
								}	
					echo "</table>";
					echo "<br />";	
					echo "</div>";					
							// defining variables to hold pagination
							$prev = $start - $per_page;
							$next = $start + $per_page;
							echo "<div id='pagination'>"; // ====== pagination 			
								if (!($start<=0))
									echo "<a href='workedHoursListing.php?start=$prev'>&#9668</a>";
									
									//set variable for first page number
									$i=1;

								//show page numbers
								for ($x = 0; $x < $record_count; $x = $x + $per_page)
										{
											if ($start != $x)
												echo "<a href='workedHoursListing.php?start=$x'>$i</a>";
											else
												echo "<a href='workedHoursListing.php?start=$x'><b>$i</b></a>";
											$i++;
										}

								//show next button
								if (!($start >= $record_count - $per_page))
									   echo "<a href='workedHoursListing.php?start=$next'>&#9658</a>";	
					echo "</div>"; 
						?>
			</div>
				</br></br>
				<form name="listingMenu" action="listRecords.php" method="get">
					<div = id="sendform1"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="LISTING MENU"></input>
					</div>
				</form>
				<form name="gobackform" action="workedHours.php" method="get">
					<div = id="sendform2"> <!-- ===== Generates PDF Report ============-->					
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