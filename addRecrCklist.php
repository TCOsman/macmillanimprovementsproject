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

// set up the SQL query to retrive volunteer ID
$query1 = "SELECT volID, volName, volSurname
		  FROM volunteer
		  ORDER BY volName";

// execute query1
$results1 = $connect->query($query1);

// count the number of rows that will be selected from the table 
$numrow1 = $results1->num_rows;
?>

<html lang="en" xml:lang="en">  
	<head>  
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
		<title>
			Jorge Souza - Macmillan Caring Locally 
		</title>
		<script src="JS_Web/fontsize.js"></script>
		<link type="text/css" href="Jquery/css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="Jquery/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="Jquery/js/jquery-ui-1.10.4.custom.min.js"></script>	
		<script type="text/javascript" src="JS_Web/datepicker1.js"></script>
		<script type="text/javascript" src="JS_Web/datepicker2.js"></script>
		<script type="text/javascript" src="JS_Web/datepicker3.js"></script>
		<script type="text/javascript" src="JS_Web/datepicker4.js"></script>
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Recruitment Checklist Details</div>
			<br />
			<!-- form with eighteen fields and a submit buttons -->
			<form name="inputDriver" action="addRecrCklistToDB.php" method="get">
				<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
					<div id="identification"> <!-- ======================== identification information ========================= -->
						*Volunteer:	
						<select name="volID" required>
							<optgroup label=""><option></option></optgroup>  <!-- =====blanked first option ====== -->
							<optgroup label="Volunteer">
							<?php
								// Volunteer display loop for each row of data, put the values into an array called $row1
								$count1 = 0;
								while ($count1 < $numrow1) 
									{
									   // pull one record of data out of the $results1 array and copy it to $row1
										$row1 = $results1->fetch_assoc();
											
										// extract the values from the $row1 array, and copy them into variables that
										// have the same names as the field names in the table
										extract ($row1);
									
										echo "<option>"; 
										echo $volID." >> ".$volName." ".$volSurname;
										echo "</option>";
										echo  "<br />";	
												
										// Volunteer display loop for each row of data, put the values into an array called $row1
										$count1 = $count1 + 1;
									}								
							?> 
							</optgroup>
						</select>
					</div>
					<div id="cklist1"> <!-- ======================== it divides the form in two divs ========================= -->
						<br />
						<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
						<label for="ckListDateOfEntry">*Entry Date:</label>  
							<input type="text" id="datepicker1" name="ckListDateOfEntry" required></input>
						<br />
						<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
						<label for="ckListAppFormSentDate">Application Sent:</label>   
							<input type="text" id="datepicker2" name="ckListAppFormSentDate"></input>
						<br />
						<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
						<label for="ckListAppFormRecDate">Appl. Received:</label>    
							<input type="text" id="datepicker3" name="ckListAppFormRecDate"></input>
						<br />
						<label for="ckListAppFormOnFile">Appl. form on file:</label>  	    
									<input type="radio" name="ckListAppFormOnFile" value="N" checked="checked" />NO 
									<input type="radio" name="ckListAppFormOnFile" value="Y">YES 
						<br />
						<br />
						<label for="ckListInterviwer">*Interviewer:</label>  
							<input type="text" name="ckListInterviwer" maxlength="20" size="20" required></input>
						<br />
						<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
						<label for="ckListInterviewDate">Interview Date:</label>  
							<input type="text" id="datepicker4" name="ckListInterviewDate" required></input>
						<br />
						<label for="ckListStatus">Status:</label>	    
									<input type="radio" name="ckListStatus" value="Active" checked="checked" />Active
									<input type="radio" name="ckListStatus" value="OnHold">On Hold
									<input type="radio" name="ckListStatus" value="Resigned">Resigned								
					</div>
					<div id="cklist2"> <!-- ======================== it divides the form in two divs ========================= -->
						<br />
						<label for="ckListRef1">Reference 1:</label>	 	    
									<input type="radio" name="ckListRef1" value="N" checked="checked" />NO 
									<input type="radio" name="ckListRef1" value="Y">YES 
						<br />
						<label for="ckListRef2">Reference 2:</label> 	    
									<input type="radio" name="ckListRef2" value="N" checked="checked" />NO  
									<input type="radio" name="ckListRef2" value="Y">YES 
						<br />
						<label for="ckListRightToWork">Right to Work:</label> 	 	    
									<input type="radio" name="ckListRightToWork" value="N" checked="checked" />NO  
									<input type="radio" name="ckListRightToWork" value="Y">YES 
						<br />
						<label for="ckListHealthClearance">Health Clearance:</label> 	    
									<input type="radio" name="ckListHealthClearance" value="N" checked="checked" />NO 
									<input type="radio" name="ckListHealthClearance" value="Y">YES 
						<br />
						<label for="ckListNOfKinForm">Next Of Kin Form:</label>  	    
									<input type="radio" name="ckListNOfKinForm" value="N" checked="checked" />NO  
									<input type="radio" name="ckListNOfKinForm" value="Y">YES 
						<br /><br />
						<label for="ckListConfAgreement">Volunteer Agreement:</label>  	    
									<input type="radio" name="ckListConfAgreement" value="N" checked="checked" />NO  
									<input type="radio" name="ckListConfAgreement" value="Y">YES 
						<br />
						<br />
					</div>	
				</div>	
				<div = id="sendform"> <!-- ===== sending form ============-->					
					<input type="Submit" Value="SUBMIT"></input>
				</div>
			</form>
			<form name="mainMenu" action="mainMenu.php" method="get">
				<div = id="sendform2"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="MAIN MENU"></input>
				</div>
			</form>
			<form name="resetform" action="addRecrCklist.php" method="get">
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