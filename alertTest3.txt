


<!DOCTYPE html>   
<html lang="en" xml:lang="en">  
	<head>  
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
		<title>
			Jorge Souza - Macmillan Caring Locally Database System
		</title>
		<script src="JS_Web/fontsize.js"></script>
		<link type="text/css" href="Jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="Jquery/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="Jquery/js/jquery-ui-1.10.4.custom.min.js"></script>	
		<script type="text/javascript" src="JS_Web/datepicker.js"></script>
		<script src="sweetalert-master/dist/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>
		
	</head>
	<body>
	
<?php
// connect to the database
require "dbconn.php";
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
    {
	echo "Failed to connect to MYSQL: " . $connect->connect_error;
    }

// set up the SQL query
// to set a variable which holds the query results - Ordered by policy expiration date (only active ones)
$insquery = ("SELECT i.insID, i.insPolicy, i.insExpDate, i.MOT, i.insNote, i.vehID, i.volID, 
							v.volName, v.volSurname, h.vehID, h.vehReg  
							FROM insurance i, vehicle h, volunteer v 
							WHERE i.insExpDate >= '1900-01-01'
							AND   i.insExpDate <= '2030-01-01'
							AND i.volID = v.volID 
                            AND i.vehID = h.vehID
                            GROUP BY i.insID, i.insPolicy, i.insExpDate 
							ORDER BY i.insExpDate");	
							
$results = $connect->query($insquery);
		  
		  
// count the number of rows that will be selected from query 
$numrow = $results->num_rows;

// to store todays date to check expired documents
$today = date("Y-m-d");
//select the driving license expiry dates for every volunteer
$licencequery2 = ("SELECT d.drExpDate, d.volID, v.volName, v.volSurname FROM driver d, volunteer v 
			WHERE d.drExpDate >= '1900-01-01' 
			AND d.drExpDate <= '2030-01-01' AND d.volID = v.volID");	
							
$results2 = $connect->query($licencequery2);
		  
		  
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
	
		IF ( ((strtotime($MOT) - strtotime($today))/86400 ) <= 60)  {

	 echo '<script>';
echo 'sweetAlert("Warning", "'.$volName.'" + " " + "'.$volSurname.'" + " " + "has an MOT expiring on " + "'.$MOT.'", "warning");';
echo '</script>';

/*
echo '<script language="javascript">';
  echo 'alert("'.$volName.'" + " " + "'.$volSurname.'" + " " + "has an MOT expiring on " + "'.$MOT.'")';
  echo '</script>';
  
  */
		}
		
			IF ( ((strtotime($insExpDate) - strtotime($today))/86400 ) <= 60)  {

 echo '<script>';
echo 'sweetAlert("Warning", "'.$volName.'" + " " + "'.$volSurname.'" + " " + "has an insurance policy expiring on " + "'.$insExpDate.'", "warning");';
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
	
 echo '<script>';
echo 'sweetAlert("Warning", "'.$volName.'" + " " + "'.$volSurname.'" + " " + " has a licence expiring on " + "'.$drExpDate.'", "warning");';
echo '</script>';
		
		
		
		
							}
							$count2 = $count2 + 1;
	
						}
						
/*				
echo '<script>';
echo 'sweetAlert("Warning", "Something went wrong!", "warning");';
echo '</script>';

*/





?>
  
	</body>
	
	
	</html>