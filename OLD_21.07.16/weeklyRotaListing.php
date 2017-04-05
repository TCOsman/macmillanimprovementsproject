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
				<table border="1" class="tableStyle" >
				
				 </br> 
				 <h1><?php echo $location ?></h1>
							    <!-- ======================== empty line ========================= -->
								<th class='headings'>Time</th> 
								<?php
								
									
									$count1 = 0; // sets initial the initial value of a variable
									 
									while ($count1 < 7) // for each row of data, put the values into an array called $row1
									   {
											// pull one record of data out of the $results1 array and copy it to $row1
											$row1 = $results1->fetch_assoc();
											
											// extract the values from the $row1 array, and copy them into variables that
											// have the same names as the field names in the table
											if ($row1 !== NULL) // finds the end of the file
													extract ($row1);
											
											// to change the date display format 
											$date = strtotime($rotaDate);
											$limit = date('N', $date);
											
											// to calculate the day in seconds
											$mondate = $date - (($limit-1) * 24 * 60 * 60);
											
											if ( $count1 == 0) // first test is made to see if it is the first day to be displayed
												$firstday = $date;
											
											$displaydate = $mondate + ($count1 * 24 * 60 * 60); // adds one day to the date do be displayed
											
											// displays the day of the week and the date 
											echo "<th class='rota'>";
											echo date("l", $displaydate); // A full textual representation of a day
											echo "<br />";
											echo date("d-m-y", $displaydate); // to change the date format 
											echo "</th>";
											
											$count1++; // add 1 to variable
										}
									
									// pull one record of data out of the $results array and copy it to $row
									$row2 = $results2->fetch_assoc();
									
									// extract the values from the $row array, and copy them into variables that
									// have the same names as the field names in the table
									extract ($row2);
									
									// sets initial the initia value of a variable
									$count2 = 0;
									 while ($count2 < $numrow2)
									   {
											// variable created in order to test if the rota has a new time and date 
											$newDate = date("d-m-y", strtotime($rotaDate));
											$newTime = $rotaTime;
																	
											echo "<tr>";
											echo "<td class='center'>";
											echo substr($rotaTime,1);        
											echo"</td>";
											
											$countday = 0;
											while ($countday < 7) // to align the columns
											 {
											   // to test if the date matches the date of the column
											   $dateattopofcol = $firstday + ($countday * 60 * 60 * 24); 
											   
												// assign value to the variable
												$datefromrecord = strtotime($rotaDate); 
			
												if ( $datefromrecord == $dateattopofcol) // if date from record is equal to the date of the headings
												{
													echo "<td class='center'>";
													echo "<a class='link' href='deleteRotaEntry.php?rotaID=".$rotaID."'
														 onclick=\"return confirm('Do you wish to delete the record?')\">".
														 $volName." ".$volSurname."</a>";
													echo "</br>"; echo"</br>";
													echo $workedHs." hs";
													echo "</br>"; echo"</br>";
													// to change the date display format 
													$date = strtotime($rotaDate);
													echo $jobDescription;
													echo "</td>";
													
													// pull one record of data out of the $results array and copy it to $row2
													$row2 = $results2->fetch_assoc();
													
													// extract the values from the $row array, and copy them into variables that
													// have the same names as the field names in the table
													if ($row2 !== NULL) // finds the end of the file
														extract ($row2);
													
													$count2++; // add one to the variable
													
													// variable created in order to test if the rota has a new time and date 
													$newDate = date("d-m-y", strtotime($rotaDate));
													$newTime = $rotaTime;
												}
												else
												{
													// displays an empty column 
													echo "<td class='toBeCovered'></td>";	
												}
														
												// to update the variables in order to test it again
												$newDate = $rotaDate;
												$oldTime = $rotaTime;
												
												$countday++;
										     }
											echo "</tr>";
											// add one to the variable
											$count2++;		
										}
								?>
						</table>
						</br> 
							<form name="listingMenu" action="listRecords.php" method="get">
						<div = id="sendform1"> <!-- ===== sending form ============-->					
							<input type="Submit" Value="LISTING MENU"></input>
						</div>
					</form>
					<form name="pdfform" action="exportRota.php" method="get">
						<div = id="sendform2"> <!-- ===== Generates PDF Report ============-->					
							<input type="Submit" Value="EXPORT"></input>
						</div>
					</form>				
		</div>
	</body>
</html>

<?php
// Closing Connection	
mysqli_close($connect);  
// Exits the script
exit();
?>