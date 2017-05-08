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

?>


<html lang="en" xml:lang="en">  
	<head>  
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
		<title>
			Jorge Souza - Macmillan Caring Locally Database
		</title>
		<script src="JS_Web/fontsize.js"></script>
		<link type="text/css" href="Jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="Jquery/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="Jquery/js/jquery-ui-1.10.4.custom.min.js"></script>	
		<script type="text/javascript" src="JS_Web/datepicker1.js"></script>
		<script type="text/javascript" src="JS_Web/datepicker2.js"></script>
		<script type="text/javascript" src="JS_Web/datepicker3.js"></script>
		<script type="text/javascript" src="JS_Web/empty.js"></script>
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Add Volunteers Details</div>
			
						<div class="dropdown">
<button onclick="myFunction()" class="dropbtn">Add Menu</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="addRecrCklist.php">Checklist</a>
    <a href="addDbsCertificate.php">DBS Cert</a>
    <a href="addNOfKin.php">Next of Kin</a>
	<a href="addVol_Availability.php">Availability</a>
    <a href="addDriver.php">Driver</a>
	<a href="addVehicle.php">Vehicle</a>
    <a href="addInsurance.php">Insurance</a>

  </div>
</div>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
			<!-- form with eight fields and a submit button -->
			<form name="inputVolunteer" action="addVolunteerToDB.php" method="get">
				<div id="newRecord1"> <!-- ======================== Add new record information - divided in two divs ========================= -->
					<br />
					<label for="voltTitle">Title:</label>
						<select name="volTitle">
								<optgroup label=""><option></option></optgroup> <!-- =====blanked first option ======-->
								<optgroup label="Title">
									<option>Ms</option>
									<option>Miss</option>
									<option>Mrs</option>
									<option>Mr</option>
									<option>Dr</option>
									<option>Rev</option>
									<option>Fr</option>
									<option>Prof</option>	
								</optgroup>
						</select> <br />
					<label for="volName">*Name:</label>  				
						<input type="text" name="volName" maxlength="20" size="20" required></input>  <br />
					<label for="volSurname">*Surname:</label>  			
						<input type="text" name="volSurname" maxlength="20" size="20" required></input> <br />
					<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
					<label for="volDOB">*DOB:</label>    				
						<input type="text" id="datepicker1" name="volDOB" required></input> <br /><br />
					<label for="volAddress1">Address1:</label>  		
						<input type="text" name="volAddress1" maxlength="20" size="20"></input> <br />
					<label for="volAddress2">Address2:</label>  		
						<input type="text" name="volAddress2" maxlength="40" size="40"></input> <br />
					<label for="volAddress3">Address3:</label>  		
						<input type="text" name="volAddress3" maxlength="20" size="20"></input> <br />
					<label for="volTown">*Town:</label>  				
						<input type="text" name="volTown" maxlength="20" size="20" required></input> <br />				
					<label for="volPostcode">*PostCode:</label>  		
						<input type="text" name="volPostcode" maxlength="10" size="10" required></input> <br />
				</div>
				<div id="newRecord2"> <!-- ======================== Add new record information - divided in two divs ========================= -->	
					<br />
					<label for="volMobile">Mobile:</label>  			
						<input type="text" name="volMobile" maxlength="15" size="15"></input> <br />
					<label for="volLandline">Landline:</label> 			
						<input type="text" name="volLandline" maxlength="15" size="15"></input> <br />
					<label for="volEmail">Email:</label>  				
						<input type="text" name="volEmail" maxlength="40" size="40"></input> <br /><br />
					<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
					<label for="volStarDate">Start Date:</label>         
						<input type="text" id="datepicker2" name="volStarDate"></input> <br />
					<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
					<label for="volEndDate">Termination Date:</label>    
						<input type="text" id="datepicker3" name="volEndDate"></input> <br /><br />					
					<label for="termination">Termination Reason:</label>
						<select name="volTermReason">
								<optgroup label=""><option></option></optgroup> <!-- =====blanked first option ======-->
								<optgroup label="Termination Reason">
									<option>Application Not Returned</option>
									<option>Change Of Circumstances</option>
									<option>Did Not Attend Induction</option>
									<option>Did Not Complete Induction</option>
									<option>Not Responding</option>
									<option>Not Suitable</option>
									<option>Resigned Due To Problem</option>
									<option>Retired</option>
									<option>Withdrew</option>	
								</optgroup>
						</select>
													<label for="jobID">*Job:</label>  
							
						<select name="jobID" required>
								
								<optgroup label=""><option><?php echo " "  ?></option></optgroup>  <!-- =====blanked first option ====== -->
								<optgroup label="Available Departments">

								<?php
								// set up the SQL query
$query2 = "SELECT jobID, jobDescription
		  FROM jobrole
		  ORDER BY jobDescription";

// execute the query
$results2 = $connect->query($query2);

// count the number of rows that will be selected from the table 
$numrow = $results2->num_rows;
									// Volunteer displays loop for each row of data, put the values into an array called $row
									$count = 0;
									while ($count < $numrow) 
										{
										   // pull one record of data out of the $results array and copy it to $row
											$row2 = $results2->fetch_assoc();
												
											// extract the values from the $row array, and copy them into variables that
											// have the same names as the field names in the table
											extract ($row2);
										
											echo "<option>"; 
											echo $jobID." >> ".$jobDescription." ";
											//echo 'jobid';
											echo "</option>";
											echo  "<br />";	
													
											// Volunteer displays loop for each row of data, put the values into an array called $row
											$count = $count + 1;
										}								
								?> 
								</optgroup>
							</select>
					
				</div>	
				<br />
				<div = id="sendform"> <!-- ===== sending form ============-->					
					<input type="Submit" Value="SUBMIT"></input>
				</div>
			</form>
			<form name="mainMenu" action="mainMenu.php" method="get">
				<div = id="sendform2"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="MAIN MENU"></input>
				</div>
			</form>
			<form name="resetform" action="addVolunteer.php" method="get">
				<div = id="sendform3"> <!-- ===== reset form ============-->					
						<input type="Submit" Value="RESET"></input>
				</div>
			</form>
			<br />
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