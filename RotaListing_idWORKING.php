<?php

// connect to the database
require "dbconn.php";

//$host = "localhost";
//$user = "root"; == for the assignment a better security control level will be implemented
//$password = "";
//$database = "mcl";

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
$query = "SELECT volID
		  FROM volunteer";

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

// to set a variable which holds the query results - Ordered by ckListID
$get = $connect->query("SELECT r.rotaID, r.rotaDate, r.wkLocID, r.rotaTime, r.workedHs, r.jobID, r.volID,
							v.volName, v.volSurname, j.jobDescription, w.wkLocDescription
							FROM vol_rota r, volunteer v, jobrole j, workloc w
							WHERE r.rotaDate >= '".$startDate."'
							AND   r.rotaDate <= '".$endDate."'
							AND   r.volID = v.volID
							AND   r.jobID = j.jobID
							AND   r.wkLocID = w.wkLocID
							GROUP BY r.rotaDate, w.wkLocDescription, r.rotaTime, r.workedHs,    			
									 j.jobDescription, v.volName, v.volSurname
							ORDER BY r.rotaDate, w.wkLocDescription, r.rotaTime, j.jobDescription, v.volName");


// to set a variable which holds the query results
$get = $connect->query("SELECT r.rotaID, r.rotaDate, r.wkLocID, r.rotaTime, r.workedHs, r.jobID, r.volID,
							v.volName, v.volSurname, j.jobDescription, w.wkLocDescription
							FROM vol_rota r, volunteer v, jobrole j, workloc w
							WHERE r.rotaDate >= '".$startDate."'
							AND   r.rotaDate <= '".$endDate."'
							AND   r.volID = v.volID
							AND   r.jobID = j.jobID
							AND   r.wkLocID = w.wkLocID
							GROUP BY r.rotaDate, w.wkLocDescription, r.rotaTime, r.workedHs,    			
									 j.jobDescription, v.volName, v.volSurname
							ORDER BY r.rotaDate, w.wkLocDescription, r.rotaTime, j.jobDescription, v.volName
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
			<div id="title">Weekly Listing</div>
			<br />
				<div id="listingFontSize"> <!-- ======================== List of volunteer with smaller fontSize ========================= -->
					<table border="1" class="tableStyle" >
					<th class="ten">DATE<span class="symbol"> &#x1F589 </span></th>
					<th class="fifteen">Location</th>
					<th class="fifteen">Job Role</th>
					<th class="ten">Monday</th>
					<th class="ten">Tuesday</th>
					<th class="ten">Wednesday</th>
					<th class="one">Thursday</th>
					<th class="ten">Friday</th>
					<th class="ten">Saturday</th>
					<th class="ten">Sunday</th>
					<th class="ten">DELETE</th>
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
								echo $rotaDate ; 
								echo "</td>";
								
								echo "<td>";
								echo $wkLocDescription; 
								echo "</td>";
								
								echo "<td>";
								echo $jobDescription; 
								echo "</td>";
								
								echo "<td>";
								echo substr($rotaTime, 1); 
								echo "</td>";
								
								echo "<td>";
								echo $workedHs; 
								echo "</td>";
								
								echo "<td>";
								echo $volName." ".$volSurname; 
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
								echo "<a href='cklistlisting_id.php?start=$prev'>&#9668</a>";
								
								//set variable for first page number
								$i=1;

							//show page numbers
							for ($x = 0; $x < $record_count; $x = $x + $per_page)
									{
										if ($start != $x)
											echo "<a href='cklistlisting_id.php?start=$x'>$i</a>";
										else
											echo "<a href='cklistlisting_id.php?start=$x'><b>$i</b></a>";
										$i++;
									}

							//show next button
							if (!($start >= $record_count - $per_page))
								   echo "<a href='cklistlisting_id.php?start=$next'>&#9658</a>";
						echo "</div>"; 								   
						?> 
				<div id="records"> <!-- ======================== number of records found ========================= -->		
				Records <?php echo $record_count; ?>
				</div>
				<form name="listingMenu" action="listRecords.php" method="get">
					<div = id="sendform1"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="LISTING MENU"></input>
					</div>
				</form>
				<form name="pdfform" action="PDF" method="get">
					<div = id="sendform2"> <!-- ===== Generates PDF Report ============-->					
						<input type="Submit" Value="PDF"></input>
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