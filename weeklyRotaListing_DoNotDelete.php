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
$location  = $_GET['wkLocDescription'];
	
// to set a variable which gets how many records are in this query
$query = "SELECT rotaDate
                FROM  weeklyRotaView
				WHERE wkLocDescription = '".$location."'
				AND   rotaDate >= '".$startDate."'
				AND   rotaDate <= '".$endDate."'";

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

// set up the SQL query which defines how many unique dates there are.
$query1 = "SELECT  DISTINCT (rotaDate) 
                FROM  weeklyRotaView
				WHERE wkLocDescription = '".$location."'
				AND   rotaDate >= '".$startDate."'
				AND   rotaDate <= '".$endDate."'
				GROUP BY rotaDate				
				ORDER BY rotaDate";


// execute the query which gets the dates to be displayed as a header
$results1 = $connect->query($query1);

// count the number of rows that will be selected from the table query2
$numrow1 = $results1->num_rows;

// set up the SQL query which defines how many unique dates there are.
$query2 = "SELECT  rotaDate, wkLocDescription, rotaTime, workedHs, 
				jobDescription, volName, volSurname, rotaID 
                FROM  weeklyRotaView
				WHERE wkLocDescription = '".$location."'
				AND   rotaDate >= '".$startDate."'
				AND   rotaDate <= '".$endDate."'	
				GROUP BY rotaTime,rotaDate  				
				ORDER BY  rotaTime,rotaDate";


// execute the query which gets the dates to be displayed as a header
$results2 = $connect->query($query2);

// count the number of rows that will be selected from the table query2
$numrow2 = $results2->num_rows;

//count records to be displyed 
$record_count2 = $results2->num_rows;

// first unit name test
$oldTime = " "; 

// set variable to test rota slot to be covered
$covered = "999"; 

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
			<div id="title">Weekly Rota Dates and Location</div>
			<br />
				<div id="listingFontSize"> <!-- ======================== List of volunteer with smaller fontSize ========================= -->					
				<h1><?php echo$location ?></h1>
				<div id="listing"> <!-- ======================== List of volunteer with smaller fontSize ========================= -->
						<table border="1" class="tableStyle" >
							<th class="rota ten">Time</th>
							<th class="rota fifteen">Monday</th>
							<th class="rota fifteen">Tuesday</th>
							<th class="rota fifteen">Wednesday</th>
							<th class="rota fifteen">Thursday</th>
							<th class="rota fifteen">Friday</th>
							<th class="rota fifteen">Saturday</th>
							<th class="rota fifteen">Sunday</th>
							<tr>
							    <!-- ======================== empty line ========================= -->
								<td class="solidLine"></td> 
								<?php
									// sets initial the initia value of a variable
									$count1 = 0;				
									// for each row of data, put the values into an array called $row2
									while ($count1 < $numrow1)
									   {
											// pull one record of data out of the $results array and copy it to $row2
											$row1 = $results1->fetch_assoc();
											
											// extract the values from the $row2 array, and copy them into variables that
											// have the same names as the field names in the table
											extract ($row1);
										
											echo "<td class='rota'>";
											// to change the date display format 
											$date = strtotime($rotaDate);
											echo date("d-m-y", $date);
											echo "</td>";
											
											// add 1 to variable
											$count1++;
										}
								?> 
						        <?php 
								// sets initial the initia value of a variable
								$count2 = 0;
								 while ($count2 < $numrow2)
								   {
										// pull one record of data out of the $results array and copy it to $row
										$row2 = $results2->fetch_assoc();
										
										// extract the values from the $row array, and copy them into variables that
										// have the same names as the field names in the table
										extract ($row2);
										
										// variable created in order to test if the student has new unitName
										$newTime = $rotaTime;
										
										// variable created in order to test if the student has new unitName
										$newTime = $rotaTime;
										
																		
										if( $newTime != $oldTime )
											{
												echo "<tr>";
												echo "<td class='center'>";
												echo substr($rotaTime,1);		
												echo"</td>";
												
												// to test if the a shift has to be covered
												if (strpos($volSurname, $covered) !== false)
													{
														echo "<td class='toBeCovered'>";
														echo "<a class='link' href='deleteRotaEntry.php?rotaID=".$rotaID."'>". 
															$volName." ".substr($volSurname,018)."</a>";
														echo "</br>";
														echo " Hs.: ".$workedHs;
														echo "</br>";
														// to change the date display format - JUST TO TEST IF THE DATES ARE ALIGNED
														$date = strtotime($rotaDate);
														echo " date.: ".date("d-m-y", $date);
														echo "</br>";
														echo $jobDescription;
														
													}
												else
													{
													
														echo "<td class='center'>";
														echo "<a class='link' href='deleteRotaEntry.php?rotaID=".$rotaID."'
														     onclick=\"return confirm('Do you wish to delete the record?')\">".
															 $volName." ".$volSurname."</a>";
														echo "</br>";
														echo " Hs.: ".$workedHs;
														echo "</br>";
														// to change the date display format - JUST TO TEST IF THE DATES ARE ALIGNED
														$date = strtotime($rotaDate);
														echo " date.: ".date("d-m-y", $date);
														echo "</br>";
														echo $jobDescription;
																									
													}	
													
													// to update the variable
													$oldTime = $rotaTime;
													
											}
										else 
											{
												// to test if the a shift has to be covered
												if (strpos($volSurname, $covered) !== false)
													{
														
														echo "<td class='toBeCovered'>";
														echo "<a class='link' href='deleteRotaEntry.php?rotaID=".$rotaID."'
														     onclick=\"return confirm('Do you wish to delete the record?')\">".
															 $volName." ".substr($volSurname,18)."</a>";
														echo "</br>";
														echo " Hs.: ".$workedHs;
														echo "</br>";
														// to change the date display format - JUST TO TEST IF THE DATES ARE ALIGNED
														$date = strtotime($rotaDate);
														echo " date.: ".date("d-m-y", $date);
														echo "</br>";
														echo $jobDescription;
														
													}
												
												else
													{
													
														echo "<td class='center'>";
														echo "<a class='link' href='deleteRotaEntry.php?rotaID=".$rotaID."'
														     onclick=\"return confirm('Do you wish to delete the record?')\">".
															 $volName." ".$volSurname."</a>";
														echo "</br>";
														echo " Hs.: ".$workedHs;
														echo "</br>";
														// to change the date display format - JUST TO TEST IF THE DATES ARE ALIGNED
														$date = strtotime($rotaDate);
														echo " date.: ".date("d-m-y", $date);
														echo "</br>";
														echo $jobDescription;
	
													}	
											}
												
										// add one to the variable
										$count2++;										
									}

								?>
						</table>
					</div>					
					<div id="records"> <!-- ======================== number of records found ========================= -->		
					Records <?php echo $record_count2; ?>
					</div>
					<form name="listingMenu" action="listRecords.php" method="get">
						<div = id="sendform1"> <!-- ===== sending form ============-->					
							<input type="Submit" Value="LISTING MENU"></input>
						</div>
					</form>
					<form name="pdfform" action="exportRota.php" method="get">
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