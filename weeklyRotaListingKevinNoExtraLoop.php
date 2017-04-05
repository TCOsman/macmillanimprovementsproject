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
	
	
echo $startDate	;
echo $endDate;	
echo $location;	
// to set a variable which gets how many records are in this query
$query = "SELECT rotaDate
                FROM  weeklyRotaView
				WHERE wkLocDescription = '".$location."'
				AND   rotaDate >= '".$startDate."'
				AND   rotaDate <= '".$endDate."'
				GROUP BY rotaDate				
				ORDER BY rotaDate";

			
				
// execute the query
$results = $connect->query($query);

// set up the SQL query which defines how many unique dates there are.
$query1 = "SELECT  rotaDate
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
$query2 = "SELECT  DISTINCT (rotaTime), rotaDate, wkLocDescription, workedHs, 
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

// first test - loop 2
$oldTime = " "; 
$startDate = date("d-m-y", strtotime($startDate));

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
							    <!-- ======================== empty line ========================= -->
								<th class='headings'>Time</th> 
								<?php
								
									// sets initial the initia value of a variable
									$count1 = 0;				
									// for each row of data, put the values into an array called $row2 
											while ($count1 < 7)
											   {
													// pull one record of data out of the $results array and copy it to $row2
													$row1 = $results1->fetch_assoc();
													
													// extract the values from the $row2 array, and copy them into variables that
													// have the same names as the field names in the table
													extract ($row1);
												
													
													// to change the date display format 
													$date = strtotime($rotaDate);
													$limit = date('N', $date);
													
													// to calculate the day in seconds
													$mondate = $date - (($limit-1) * 24 * 60 * 60);
													
													if ( $count1 == 0) 
														$firstday = $date;
													
													$displaydate = $mondate + ($count1 * 24 * 60 * 60);
													
													// displays the day of the week and the data 
													echo "<th class='rota'>";
													echo date("l", $displaydate); // A full textual representation of a day
													echo "<br />";
													echo date("d-m-y", $displaydate); // to change the date format 
													echo "</th>";
													
													// add 1 to variable
													$count1++;
												}
									
									// sets initial the initia value of a variable
									$count2 = 0;
									 while ($count2 < $numrow2)
									   {
											// pull one record of data out of the $results array and copy it to $row
											$row2 = $results2->fetch_assoc();
											
											// extract the values from the $row array, and copy them into variables that
											// have the same names as the field names in the table
											extract ($row2);
											
											// variable created in order to test if the rota has a new time and date 
											$newDate = date("d-m-y", strtotime($rotaDate));
											$newTime = $rotaTime;
											
											
											// display AM / LUNCH / PM and EVE 
											// echo "<tr>";
											// echo "<td class='center'>";
											// echo substr($rotaTime,1);		
											// echo"</td>";
											
											
											
												
                                           // display AM / LUNCH / PM and EVE - Just once
									if ($oldTime !== $rotaTime)
										{
											echo "<tr>";
											echo "<td class='center'>";
											echo substr($rotaTime,1);        
											echo"</td>";
											$dateattopofcol = $firstday;
										}
											

											// test to check if the time and data for the first row
											if ( $newDate == $startDate && $newTime == $oldTime )  

													{

														echo "<td class='center'>";
														
													}
													
											else			
													
													{  

/*  / ########################################################################## kevin's code to display an empty column, if there is one
														$date = strtotime($rotaDate);
														$limit = date('N', $date);
														$countday = 1;
														
													   while ($countday <= $limit-1 )
														{
															echo "<td class='toBeCovered'></td>";
															$countday++;
														}
													
// ####################################################################################################################################			
*/											
														
														$dateattopofcol = $firstday + ($count2 * 60 * 60 * 24);
														$datefromrecord = strtotime($rotaDate);
														echo "dateattopofcol  ".$dateattopofcol.   "  ";
														echo "datefromrecord  ".$datefromrecord;
														echo "<br />";
														if ( $datefromrecord == $dateattopofcol)
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
																echo "</br>"; 	echo"</br>";
															    echo $newTime;	echo"</br>"; 
																echo $oldTime;
																echo "</br>"; 	echo"</br>"; 
																echo "newDate ".$newDate;	echo"</br>"; 
																echo "startDate ".$startDate;
																echo "</td>";
														}
														else
														{
															echo "<td class='toBeCovered'></td>";	
														}
													}
													
											// to update the variables in order to test it again
											$newDate = $rotaDate;
											$oldTime = $rotaTime;
	
											// add one to the variable
											$count2++;		
										}
								?>
						</table>
				</div>					
		</div>
	</body>
</html>