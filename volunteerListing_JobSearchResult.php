<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php

// connect to the database
require "dbconn.php";
$search    = $_GET['searchjob'];


//echo $search;
// Test to check if the database is connected 
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
    {
	echo "Failed to connect to MYSQL: " . $connect->connect_error;
    }

// to set a variable which gets how many records are in this query
$query = "SELECT v.volID
		  FROM volunteer v, jobrole j 
		  WHERE j.jobDescription = '".$search."'
		  AND v.jobID = j.jobID" ;

// execute the query
$results = $connect->query($query);

//count records for pagination 
$record_count = $results->num_rows;

//max displayed records per page
$per_page = 20;
@$start = $_GET['start'];

// variable which defines how many pages will be displayed - ceil is used to round the number up 
$max_pages =  ceil ($record_count / $per_page); 

if (!$start)
   $start = 0;

 
$get = $connect->query("SELECT v.volID, v.volName, v.volSurname, v.volDOB, v.volAddress1, v.volAddress2, v.volAddress3, v.volTown, v.volPostcode, v.volMobile, v.volLandline, v.volEmail, v.volStarDate, v.volEndDate, v.volTermReason, v.volTitle, v.jobID, j.jobDescription, j.jobID 
FROM volunteer v 

LEFT JOIN jobrole j
ON v.jobID = j.jobID
WHERE jobDescription = '".$search."' 
 ORDER BY volName
		  LIMIT $start, $per_page");



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
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Search Results</div>
			<br />
			<div id="searchBar">
			<form name="searchBar" action="volunteerListing_JobSearchResult.php" method="get">
			<label for="Subject">Search Job</label>     
						<input type="text" name="searchjob" size="30" 
						value="<?php echo $search; ?>"></input><br />
						
			<form>
			</div>
			
				<div id="listingFontSize"> <!-- ======================== List of volunteer with smaller fontSize ========================= -->
					<table border="1" class="tableStyle" >
					<th class="thirty"><a a class="link" href="volunteerListing_name.php">Name <!---<span class="symbol"> &#x1F589 </span> --></th>
					<th class="ten"><a a class="link" href="volunteerListing_DOB.php">DOB</th>
					<th class="twenty">Address1</th>
					<th class="twenty">Address2</th>
					<th class="twenty">Address3</th>					
					<th class="ten"><a a class="link" href="volunteerListing_town.php">Town</th>
					<th class="ten">Postcode</th>
					<th class="ten">Mobile</th>
					<th class="ten">Landline</th>
					<th class="twenty">Email</th> 
					<th class="ten"><a a class="link" href="volunteerListing_start.php">Start Date</th>
					<th class="ten">Termination Date</th>
					<th class="ten"><a a class="link" href="volunteerListing_term.php">Termination Reason</th>
					<th class="twenty headings"><a a class="link" href="volunteerListing_job.php">Job</th>
					<th class="ten"><a a class="link" href="volunteerListing_Service.php">Length of Service (Months)</th>
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
								echo "<td>";
								echo 
								"<a class='link' href='updateVolunteerForm.php?volID=".$volID."'>".$volName." ".$volSurname."</a>";
								echo "</td>";
								
								echo "<td>";
								echo $volDOB; 
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
								
								echo "<td>";
								echo $volMobile; 
								echo "</td>";
								
								echo "<td>";
								echo $volLandline; 
								echo "</td>";
								
								echo "<td>";
								echo $volEmail; 
								echo "</td>";
								
								echo "<td>";
								echo $volStarDate; 
								echo "</td>";
								
								echo "<td>";
								echo $volEndDate; 
								echo "</td>";
								
								echo "<td>";
								echo $volTermReason; 
								echo "</td>";
								
								echo "<td class='headings'>";
								echo $jobDescription; 
								echo "</td>";
								
								echo "<td>";
								$today = date("Y-m-d");
								$serviceLength = ((strtotime($today) - strtotime($volStarDate))/2592000 );
								$serviceLength = round( $serviceLength, 1, PHP_ROUND_HALF_UP);
								echo $serviceLength;
								echo "</td>";
								
								// delete button with a warning box
								echo "<td class='center'>";
								echo 	"<a class='delete' href='deleteVolunteer.php?volID=".$volID."' 
										onclick=\"return confirm('Do you wish to delete the record?')\">&#9003</a>";
								echo "</td>";
								
								// increase the value of the variable 
								$count = $count + 1;
								 
							}	
					echo "</table>";
				echo "</div>";
				echo "<br />";										
					echo "<br> <br>";
					echo "<Br> <br>";
					echo "<Br> <br>";
					echo "<Br> <br>";
					echo "<br> <br>";
							// defining variables to hold pagination
						$prev = $start - $per_page;
						$next = $start + $per_page;
						echo "<div id='pagination'>"; // ====== pagination 			
							if (!($start<=0))
								echo "<a href='volunteerListing_JobSearchResult.php?start=$prev&searchjob=$search'>&#9668</a>";
								
								//set variable for first page number
								$i=1;

							//show page numbers
							for ($x = 0; $x < $record_count; $x = $x + $per_page)
									{
										if ($start != $x)
											echo "<a href='volunteerListing_JobSearchResult.php?start=$x&searchjob=$search'>$i</a>";
										else
											echo "<a href='volunteerListing_JobSearchResult.php?start=$x&searchjob=$search'><b>$i</b></a>";
										$i++;
									}

							//show next button
							if (!($start >= $record_count - $per_page))
								   echo "<a href='volunteerListing_JobSearchResult.php?start=$next&searchjob=$search'>&#9658</a>";
						echo "</div>"; 								   
						?> 
				<form name="listingMenu" action="listRecords.php" method="get">
					<div = id="sendform1"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="LISTING MENU"></input>
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