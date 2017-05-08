<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// connect to the database
require "dbconn.php";

// store the location identification in order to filter queries 
$availabilityLocChosen = $_GET['wkLocID'];


$paginquery = "SELECT v.volID, v.volName, v.volSurname, a.availDay, a.availTime, a.availFreq, a.availNote,
                  j.jobDescription, w.wklocID, w.wkLocDescription, a.availID
				  FROM vol_availability a, volunteer v, jobrole j, workLoc w
				  WHERE a.wklocID = '".$availabilityLocChosen."' 
				  AND v.volID = a.volID
				  AND v.volTermReason = ' '  
				  AND a.jobID = j.jobID
				  GROUP BY a.availFreq, a.availDay, a.availTime, j.jobDescription 
				  ORDER BY a.availFreq, a.availDay, a.availTime, j.jobDescription";	
				  
$results3 = $connect->query($paginquery);				  
$record_count = $results3->num_rows;


//max displayed records per page
$per_page = 20;
@$start = $_GET['start'];

// variable which defines how many pages will be displayed - ceil is used to round the number up 
$max_pages =  ceil ($record_count / $per_page); 

if (!$start)
   $start = 0;



// Test to check if the database is connected
$connect = new mysqli($host, $user, $password, $database);



if ($connect->connect_errno)
    {
	echo "Failed to connect to MYSQL: " . $connect->connect_error;
    }
	
// set up the SQL query which defines the location description
$query1 = "SELECT *
		  FROM workLoc
		  WHERE wkLocID = '".$availabilityLocChosen."'";

// set up the SQL query the availability related to each locatation		  
$query2 = "SELECT v.volID, v.volName, v.volSurname, a.availDay, a.availTime, a.availFreq, a.availNote,
                  j.jobDescription, w.wklocID, w.wkLocDescription, a.availID
				  FROM vol_availability a, volunteer v, jobrole j, workLoc w
				  WHERE a.wklocID = '".$availabilityLocChosen."' 
				  AND v.volID = a.volID
				  AND v.volTermReason = ' '  
				  AND a.jobID = j.jobID
				  GROUP BY a.availFreq, a.availDay, a.availTime, j.jobDescription 
				  ORDER BY a.availFreq, a.availDay, a.availTime, j.jobDescription
				 ";		 
		  
// execute the query which gets the name of the unit
$results1 = $connect->query($query1);

// execute the query which gets the dates to be displayed as a header
// $results2 = $connect->query($query2);

// execute the query which gets information about availability
$results2 = $connect->query($query2);

// count the number of rows that will be selected from the table query1, even though it hasn't been used
$numrow1 = $results1->num_rows;
  
// count the number of rows that will be selected from the table query2
// $numrow2 = $results2->num_rows;
  
// count the number of rows that will be selected from the table query2
$numrow2 = $results2->num_rows;	


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
			<div id="title">Availability by Location</div>
				<div id="listing"> <!-- ======================== List of volunteer  ========================= -->
					<?php 
					// pull one record of data out of the $results array and copy it to $row
							$row1 = $results1->fetch_assoc();
							
							// extract the values from the $row array, and copy them into variables that
							// have the same names as the field names in the table
							extract ($row1);
								echo "<h1>";
								echo $wkLocDescription; 			
								echo "</h1>";
					?>
					<table border="1" class="tableStyle" >
						<th class="thirty">VOLUNTEER</th>
						<th class="five">FREQUENCY</th>
						<th class="ten">DAY</th>
						<th class="five">TIME</a></th>
						<th class="fifteen">JOB ROLE</th>
						<th class="fourty">EXTRA NOTES</th>
						<th class="five">DELETE</th>
					<?php								
						// for each row of data, put the values into an array called $row2
						// for each row of data, put the values into an array called $row
						$count  = 0;
						while ($count < $numrow2)
							{
								// pull one record of data out of the $results array and copy it to $row
								$row2 = $results2->fetch_assoc();
									
								// extract the values from the $row array, and copy them into variables that  // bcdefecho "substr"($availFreq,0,5); 
								// have the same names as the field names in the table
								extract ($row2);			
								
								echo "<tr>";
								echo "<td>";
								echo $volName." ".$volSurname; 
								//"<a class='link' href='availabilitySingleListing.php?
								//availID=".$availID."'>".substr($availID.$volName." ".$volSurname,5)."</a>";  
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
								
								// delete button with a warning box
								echo "<td class='center'>";
								echo "<a class='delete' href='deleteVol_Availability.php?availID=".$availID."' 
									onclick=\"return confirm('Do you wish to delete the record?')\">&#9003</a>";
								echo "</td>";
								
								// increase the value of the variable 
								$count = $count + 1;
								 
							}	
					  echo "</table>";
					  echo "</div>";
					echo "<br />";		
					
				echo "</div>";
				
				for ($x = 0; $x <= $record_count; $x++) {
					echo "<br>";
					
				}
				
					?> 
					
				
				
				<form name="availabilityListing" action="availabilityListing.php" method="get">
					<div = id="sendform1"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="AVAILABILITY"></input>
					</div>
				</form>
				<form name="mainMenu" action="mainMenu.php" method="get">
					<div = id="sendform2"> <!-- ===== Generates PDF Report ============-->					
						<input type="Submit" Value="MAIN MENU"></input>
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