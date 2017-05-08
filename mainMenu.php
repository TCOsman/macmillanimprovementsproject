<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<!DOCTYPE html>   
<html lang="en" xml:lang="en">  
	<head>  
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
		<title>
			Jorge Souza - Macmillan Caring Locally Database System
		</title>
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>
						<style>
		.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
	 font-family: 'Roboto', sans-serif;
}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
	
}
.closebtn:hover {
    color: black;
}
</style>
	</head>
	<body>
	<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>EXPIRATION WARNINGS</strong> <br> <?php	require "dbconn.php";

$connect = new mysqli($host, $user, $password, $database);
 
if ($connect->connect_errno)
    {
	echo "Failed to connect to MYSQL: " . $connect->connect_error;
    }

// set up the SQL query
// to set a variable which holds the query results - Ordered by policy expiration date (only active ones)
/*
$insquery = ("SELECT i.insID, i.insPolicy, i.insExpDate, i.MOT, i.insNote, i.vehID, i.volID, 
							v.volName, v.volSurname, h.vehID, h.vehReg  
							FROM insurance i, vehicle h, volunteer v 
							WHERE i.insExpDate >= '1900-01-01'
							AND   i.insExpDate <= '2030-01-01'
							AND i.volID = v.volID 
                            AND i.vehID = h.vehID
                            GROUP BY i.insID, i.insPolicy, i.insExpDate 
							ORDER BY i.insExpDate");	
*/


$insquery = ("SELECT i.insID, i.insExpDate, i.MOT, i.volID, 
							v.volName, v.volSurname, d.drExpDate 
							FROM insurance i, volunteer v, driver d  
							WHERE i.volID = v.volID 
							and d.volID = v.volID");

							
$results = $connect->query($insquery);
		  
		  
// count the number of rows that will be selected from query 
$numrow = $results->num_rows;

// to store todays date to check expired documents
$today = date("Y-m-d");
//select the driving license expiry dates for every volunteer

/*
$licencequery2 = ("SELECT d.drExpDate, d.volID, v.volName, v.volSurname FROM driver d, volunteer v 
			WHERE d.drExpDate >= '1900-01-01' 
			AND d.drExpDate <= '2030-01-01' AND d.volID = v.volID");	
							
$results2 = $connect->query($licencequery2);
		  
		  
// count the number of rows that will be selected from query2* 
$numrow2 = $results2->num_rows;


*/ 
  
$count = 0;
						while ($count < $numrow)
							{
								// pull each record of query out of the $results array and copy it to $row
								$row = $results->fetch_assoc(); 
									
								// extract the values from the $row array, and copy them into variables that
								// have the same names as the field names in the table
								extract ($row);
	
		IF ( ((strtotime($MOT) - strtotime($today))/86400 ) <= 60)  {

	
echo ($volName ." " . $volSurname ." " . 'has an MOT expiring on ' .$MOT .'<br>');

//	echo 'hello';
	

		}
	


		
			IF ( ((strtotime($insExpDate) - strtotime($today))/86400 ) <= 60)  {

 echo ($volName . " " .$volSurname. " " . 'has an insurance policy expiring on ' .$insExpDate.'<br>');
//echo 'hellogoodbye';
    
			}
			
	IF ( ((strtotime($drExpDate) - strtotime($today))/86400 ) <= 60)  {
	
echo ($volName . " " . $volSurname.  " " . 'has a licence expiring on ' . $drExpDate.'<br>');
		
		
		
							}			
		$count = $count + 1;
		
		
		
							}
  
  
  
  
  ?>
		
	
</div>	
	
	
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="menus">
				
			
			<img src="Macmillan_logo_web.jpg" alt="Macmillan" style="width:200px;height:118px"> 
		
	<div id="menutext">
				Database System 
				Main Menu
			</div>
			</div>
			</div>
			<br />
			
			
			<div id="menuOptions"> <!-- ======================== Specifies what type o action is needed ========================= -->
				<div id="menuButtons1"> 
					<a class="menubutton1" href="addRecords.php">ADD RECORDS</a>
					<br> <Br> <BR> <br> <br>
					<a class="menubutton1" href="emailDepartment.php">EMAIL DEPARTMENTS</a>
						<br> <BR> <BR><BR>
					<a class="menubutton1" href="emailAddressCopyForm.php">EMAIL ADDRESSES</a>
				</div>	
				<div id="menuButtons2"> 
					<a class="menubutton1" href="listRecords.php">LIST RECORDS</a>
					<br> <br> <br> <br> <Br>
						<a class="menubutton1" href="emailVolunteer.php">EMAIL A VOLUNTEER</a>
				</div>	
			
		</div>
			<form name="exitform" action="logOut.php" method="get">
				<div = id="sendform"> <!-- ===== EXIT THE DATABASE form ============-->					
					<input type="Submit" Value="LOGOUT"></input>
				</div>
			</form>
			<form name="exitform" action="adminHome.php" method="get">
				<div = id="sendform3"> <!-- ===== Redirects user to adm page ============-->					
					<input type="Submit" Value="SYSTEM ADMIN"></input>
				</div>
			
			</form>
			<form name="Update Password" action="userUpdatePassword.php" method="get">
				<div = id="sendform3"> <!-- ===== Goes back to the main Menuform ============-->					
					<input type="Submit" Value="CHANGE PASSWORD"></input>
				</div>
			</form>
		</div>
		<div id="footer"> <!-- ======================== Main page footer ========================= -->
			Jorge Souza - Bournemouth University  
			| For more information, please contact us by email i7250872@bournemouth.ac.uk
		</div>
	</body>
</html>