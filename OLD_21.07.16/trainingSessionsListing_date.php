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

// to set a variable which gets how many records are in this query
$query = "SELECT vTrExpDate
			FROM vol_training 
			WHERE vTrExpDate >= '".$startDate."'
			AND   vTrExpDate <= '".$endDate."'
			ORDER BY vTrExpDate";

// execute the query
$results = $connect->query($query);

//count records for pagination 
$record_count = $results->num_rows;

//max displayed records per page
$per_page = 15;
@$start = $_GET['start'];

// variable which defines how many pages will be displayed - ceil is used to round the number up 
$max_pages =  ceil ($record_count / $per_page); 

if (!$start)
   $start = 0;

// to set a variable which holds the query results - Order by session date (all volunteers)
$get = $connect->query ("SELECT s.vTrID, s.TrDate, s.trID, s.volID, s.vTrExpDate,
							v.volName, v.volSurname, t.trDescription, t.trType
							FROM vol_training s, training t, volunteer v
							WHERE s.vTrExpDate >= '".$startDate."'
							AND   s.vTrExpDate <= '".$endDate."'
							AND   s.volID = v.volID
							AND   s.trID = t.trID
							GROUP BY s.vTrExpDate
							ORDER BY s.vTrExpDate
						    LIMIT $start, $per_page");

		  
// count the number of rows that will be selected from query 
$numrow = $get->num_rows;

// to store todays date to check expiered documents
$today = date("Y-m-d");
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
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Training Sessions Listing</div>
			<br />
				<div id="listing"> <!-- ======================== List of Training Sessions for all Volunteers  ========================= -->
					<table border="1" class="tableStyle" >
					<th class="thirty">Volunteer Name<span class="symbol"> &#x1F589 </span></th>
					<th class="fourty">Training</th>
					<th class="fifteen">Retake Until</th>
					<th class="fifteen">Training Type</th>
					<th class="five">DELETE</th>
					
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
								echo "<td class='link'>";
								echo "<a class='link' href='updateTrainingSessionForm.php?vTrID=".$vTrID."'>".$volName." ".$volSurname."</a>";
								echo "</td>";
								
								echo "<td>";
								echo $trDescription; 
								echo "</td>";

								// to check if a required training has less than 30 to expire
								IF ( ((strtotime($vTrExpDate) - strtotime($today))/86400 ) >= 60)  
									{
										echo "<td class='center'>";
										echo $vTrExpDate; 
										echo "</td>";
									}
								ELSE
									{
										echo "<td class='center flag'>";
										echo $vTrExpDate; 
										echo "</td>";
									}

								echo "<td class='center'>";
								echo substr($trType,1); 
								echo "</td>";
								
								// delete button with a warning box
								echo "<td class='center'>";
								echo 	"<a class='delete' href='deleteTrainingSessions.php?vTrID=".$vTrID."' 
										onclick=\"return confirm('Do you wish to delete the record?')\">&#9003</a>";
								echo "</td>";
															
								// increase the value of the variable 
								$count = $count + 1;
								 
							}	
					echo "</table>";
				echo "</div>";
				echo "<br />";										
					
						// defining variables to hold pagination
						$prev = $start - $per_page;
						$next = $start + $per_page;
						echo "<div id='pagination'>"; // ====== pagination 			
							if (!($start<=0))
								echo "<a href='trainingSessionsListing_date.php?start=$prev'>&#9668</a>";

								//set variable for first page number
								$i=1;

							//show page numbers
							for ($x = 0; $x < $record_count; $x = $x + $per_page)
									{
										if ($start != $x)
										{
											echo "<a href='trainingSessionsListing_date.php?start=$x'>$i</a>";
											$startDate = $_GET['startDate'];
											$endDate   = $_GET['endDate'];	
										}
										else
										{
											echo "<a href='trainingSessionsListing_date.php?start=$x'><b>$i</b></a>";
											$startDate = $_GET['startDate'];
											$endDate   = $_GET['endDate'];	
										$i++;
										}
									}

							//show next button
							if (!($start >= $record_count - $per_page))
								   echo "<a href='trainingSessionsListing_date.php?start=$next'>&#9658</a>";
								     
						echo "</div>"; 								   
						?> 
				<form name="listingMenu" action="listRecords.php" method="get">
					<div = id="sendform1"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="LISTING MENU"></input>
					</div>
				</form>
				<form name="goBack" action="trainingSessionsListing.php" method="get">
					<div = id="sendform1"> <!-- ===== sending form ============-->					
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