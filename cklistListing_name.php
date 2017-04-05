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

// to set a variable which gets how many records are in this query
$query = "SELECT ckListID
		  FROM recruitmentCkList";

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
$get = $connect->query("SELECT ckListID
		  FROM recruitmentCkList
		  LIMIT $start, $per_page");


// to set a variable which holds the query results
$get = $connect->query("SELECT 
						  r.ckListID, v.volName, v.volSurname, r.ckListDateOfEntry, r.ckListAppFormSentDate, 
						  r.ckListAppFormRecDate, r.ckListAppFormOnFile, r.ckListInterviwer, r.ckListInterviewDate, 
						  r.ckListStatus, r.ckListRef1, r.ckListRef2, r.ckListRightToWork, r.ckListHealthClearance, 
						  r.ckListNOfKinForm, r.ckListConfAgreement 
    					  FROM recruitmentCkList r, volunteer v
						  WHERE r.volID = v.volID
						  AND r.ckListStatus != 'Resign'
						  GROUP BY r.ckListID, r.volID, v.volName, v.volSurname 
						  ORDER BY v.volName
						  LIMIT $start, $per_page");		  
		  
		  
// count the number of rows that will be selected from query 
$numrow = $get->num_rows;

// to check if a task was completed
$completed = "N";
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
			<div id="title">Recruitment Checklist Listing</div>
				<br />
				<div id="listing"> <!-- ======================== List of volunteer with smaller fontSize ========================= -->
					<table border="1" class="tableStyle" >
					<th class="twenty"><a class="link" href="cklistListing_name.php">Name<span class="symbol">&#x1F589</span></th>
					<th class="ten">Date of Entry</th>
					<th class="ten">Application Sent</th>
					<th class="ten">Appl. Returned</th>
					<th class="one">Appl.On file</th>
					<th class="one">Ref1</th> 
					<th class="one">Ref2</th>
					<th class="one">Right to Work</th>
					<th class="one">Health Clearance</th>
					<th class="one">Next Of Kin Form</th>
					<th class="one">Volunteer Agreement</th>
					<th class="ten">Interviewer</th>
					<th class="ten">Interview Date</th>
					<th class="ten"><a class="link" href="cklistListing_status.php">Status</th>
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
								echo "<td class='headings'>";
								echo "<a class='link' href='updateRecrCkListForm.php?ckListID=".$ckListID."'>".$volName." ".$volSurname."</a>";	
									
								echo "</td>";
								
								echo "<td class='center'>";
								echo $ckListDateOfEntry; 
								echo "</td>";
								
								echo "<td class='center'>";
								echo $ckListAppFormSentDate; 
								echo "</td>";
								
								echo "<td class='center'>";
								echo $ckListAppFormRecDate; 
								echo "</td>";
															
								IF ( $ckListAppFormOnFile != $completed )  // to check if a task has been completed
									{
										echo "<td class='center'>";
										echo $ckListAppFormOnFile; 
										echo "</td>";
									}
								ELSE
									{
										echo "<td class='center flag'>";
										echo $ckListAppFormOnFile; 
										echo "</td>";
									}
								
								IF ( $ckListRef1 != $completed )  // to check if a task has been completed
									{
										echo "<td class='center'>";
										echo $ckListRef1; 
										echo "</td>";
									}
								ELSE
									{
										echo "<td class='center flag'>";
										echo $ckListRef1; 
										echo "</td>";
									}
								
								
								IF ( $ckListRef2 != $completed )  // to check if a task has been completed
									{
										echo "<td class='center'>";
										echo $ckListRef2; 
										echo "</td>";
									}
								ELSE
									{
										echo "<td class='center flag'>";
										echo $ckListRef2; 
										echo "</td>";
									}
								
								IF ( $ckListRightToWork != $completed )  // to check if a task has been completed
									{
										echo "<td class='center'>";
										echo $ckListRightToWork; 
										echo "</td>";
									}
								ELSE
									{
										echo "<td class='center flag'>";
										echo $ckListRightToWork; 
										echo "</td>";
									}
								
								IF ( $ckListHealthClearance != $completed )  // to check if a task has been completed
									{
										echo "<td class='center'>";
										echo $ckListHealthClearance; 
										echo "</td>";
									}
								ELSE
									{
										echo "<td class='center flag'>";
										echo $ckListHealthClearance; 
										echo "</td>";
									}
								
								IF ( $ckListNOfKinForm != $completed )  // to check if a task has been completed
									{
										echo "<td class='center'>";
										echo $ckListNOfKinForm; 
										echo "</td>";
									}
								ELSE
									{
										echo "<td class='center flag'>";
										echo $ckListNOfKinForm; 
										echo "</td>";
									}
								
								IF ( $ckListConfAgreement != $completed )  // to check if a task has been completed
									{
										echo "<td class='center'>";
										echo $ckListConfAgreement; 
										echo "</td>";
									}
								ELSE
									{
										echo "<td class='center flag'>";
										echo $ckListConfAgreement; 
										echo "</td>";
									} 

								echo "<td>";
								echo $ckListInterviwer; 
								echo "</td>";
								
								echo "<td class='center'>";
								echo $ckListInterviewDate; 
								echo "</td>";
								
								echo "<td class='center'>";
								echo $ckListStatus; 
								echo "</td>";
								
								// delete button with a warning box
								echo "<td class='center'>";
								echo "<a class='delete' href='deleteChecklist.php?ckListID=".$ckListID."' 
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
								echo "<a href='cklistListing_name.php?start=$prev'>&#9668</a>";
								
								//set variable for first page number
								$i=1;

							//show page numbers
							for ($x = 0; $x < $record_count; $x = $x + $per_page)
									{
										if ($start != $x)
											echo "<a href='cklistListing_name.php?start=$x'>$i</a>";
										else
											echo "<a href='cklistListing_name.php?start=$x'><b>$i</b></a>";
										$i++;
									}

							//show next button
							if (!($start >= $record_count - $per_page))
								   echo "<a href='cklistListing_name.php?start=$next'>&#9658</a>";
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