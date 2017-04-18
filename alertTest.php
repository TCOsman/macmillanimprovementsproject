<?php
// connect to the database
require "dbconn.php";
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
    {
	echo "Failed to connect to MYSQL: " . $connect->connect_error;
    }

// set up the SQL query
// to set a variable which holds the query results - Ordered by polyce expiration date (only active ones)
$query = ("SELECT i.insID, i.insPolicy, i.insExpDate, i.MOT, i.insNote, i.vehID, i.volID, 
							v.volName, v.volSurname, h.vehID, h.vehReg  
							FROM insurance i, vehicle h, volunteer v 
							WHERE i.insExpDate >= '1900-01-01'
							AND   i.insExpDate <= '2030-01-01'
							AND i.volID = v.volID 
                            AND i.vehID = h.vehID
                            GROUP BY i.insID, i.insPolicy, i.insExpDate 
							ORDER BY i.insExpDate");	
							
$results = $connect->query($query);
		  
		  
// count the number of rows that will be selected from query 
$numrow = $results->num_rows;

// to store todays date to check expired documents
$today = date("Y-m-d");

$query2 = ("SELECT d.drExpDate, d.volID, v.volName, v.volSurname FROM driver d, volunteer v 
			WHERE d.drExpDate >= '1900-01-01' 
			AND d.drExpDate <= '2030-01-01' AND d.volID = v.volID");	
							
$results2 = $connect->query($query2);
		  
		  
// count the number of rows that will be selected from query2* 
$numrow2 = $results2->num_rows;



$count = 0;
						while ($count < $numrow)
							{
								// pull each record of query out of the $results array and copy it to $row
								$row = $results->fetch_assoc(); 
									
								// extract the values from the $row array, and copy them into variables that
								// have the same names as the field names in the table
								extract ($row);
	/*
	echo '<script language="javascript">';
  echo 'alert('.$insID.','.$insPolicy.','.$insExpDate.','.$MOT.','.$insNote.',.)';  
  echo '</script>';
*/
//echo $volName;
		IF ( ((strtotime($MOT) - strtotime($today))/86400 ) <= 60)  {
		echo '<script language="javascript">';
  echo 'alert("ALERT! " + "'.$volName.'"+ " " + "'.$volSurname.'" + " " + "has an expiring MOT!")';
  echo '</script>';
	

		}
		
			IF ( ((strtotime($insExpDate) - strtotime($today))/86400 ) <= 60)  {
		echo '<script language="javascript">';
  echo 'alert("ALERT! " + "'.$volName.'"+ " " + "'.$volSurname.'" + " " + "has an expiring Insurance Policy!")';
  echo '</script>';
  
  
			}
		$count = $count + 1;
		
		
		
							}

$count2 = 0;
						 while ($count2 < $numrow2)
							{
								// pull each record of query out of the $results array and copy it to $row
								$row2 = $results2->fetch_assoc(); 
									
								// extract the values from the $row array, and copy them into variables that
								// have the same names as the field names in the table
								extract ($row2);
								
/*	echo '<script language="javascript">';
  echo 'alert("'.$numrow2.'")';
  echo '</script>';
*/  

		IF ( ((strtotime($drExpDate) - strtotime($today))/86400 ) <= 60)  {
		echo '<script language="javascript">';
  echo 'alert("ALERT! " + "'.$volName.'"+ " " + "'.$volSurname.'" + " " + "has an expiring Licence!")';
  echo '</script>';
	

		
		
		
		
							}
							$count2 = $count2 + 1;
	
						}











?>