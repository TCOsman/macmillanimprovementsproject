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

// to store the training information 
$ckListID = $_GET['ckListID'];

// set the SQL query
$query = "SELECT 
			  r.ckListID, r.volID, v.volName, v.volSurname, r.ckListDateOfEntry, r.ckListAppFormSentDate, 
			  r.ckListAppFormRecDate, r.ckListAppFormOnFile, r.ckListInterviwer, r.ckListInterviewDate, 
			  r.ckListStatus, r.ckListRef1, r.ckListRef2, r.ckListRightToWork, r.ckListHealthClearance, 
			  r.ckListNOfKinForm, r.ckListConfAgreement 
			  FROM recruitmentCkList r, volunteer v
			  WHERE r.ckListID = '".$ckListID."'
			  AND r.volID = v.volID";

// execute the query
$results = $connect->query($query);

// Check number of rows returned
if ( $results->num_rows != 1 )
  die("Database did not return one result");
else
  {
  $row = $results->fetch_assoc();
  }
?>

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
		<script type="text/javascript" src="JS_Web/datepicker1.js"></script>
		<script type="text/javascript" src="JS_Web/datepicker2.js"></script>
		<script type="text/javascript" src="JS_Web/datepicker3.js"></script>
		<script type="text/javascript" src="JS_Web/datepicker4.js"></script>
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>	
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Edit Recruitment CkList Details</div>
				<!-- form with two fields and a submit button -->
				<form name="updateRecrCklist" action="updateRecrCklist.php" method="get">
					<div id="newRecord"> <!-- ======================== update record information ========================= -->
							<div id="cklist1"> <!-- ======================== it divides the form in two divs ========================= -->
								<label for="cklistID">Cklist ID:</label>
								<input id="notEditable" type="text" name="cklistID" size="3"
									value="<?php echo $row['ckListID']; ?>" readonly="true"></input>
								<br />
								<label for="volunteer">Volunteer:</label>
								<input id="notEditable" type="text" name="volunteer"  
									value="<?php echo $row['volName']." ".$row['volSurname']; ?>" readonly="true"></input>
								<br /><br />
								<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
								<label for="ckListDateOfEntry">*Entry Date:</label>  
									<input type="text" id="datepicker1" name="ckListDateOfEntry"  
										value="<?php echo $row['ckListDateOfEntry']; ?>" required></input>	
								<br /><br />	
								<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
								<label for="ckListAppFormSentDate">Application Sent:</label>   
									<input type="text" id="datepicker2" name="ckListAppFormSentDate"  
										value="<?php echo $row['ckListAppFormSentDate']; ?>" required></input>	
								<br /><br />
								<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
								<label for="ckListAppFormRecDate">Appl. Received:</label>    
									<input type="text" id="datepicker3" name="ckListAppFormRecDate" 
										value="<?php echo $row['ckListAppFormRecDate']; ?>" required></input>	
								<br /><br />
								<label for="ckListAppFormOnFile">Appl. form on file:</label>  	    
									<input type="radio" name="ckListAppFormOnFile"
										<?=$row['ckListAppFormOnFile']=="N" ? "checked" : ""?> value="N">No
									<input type="radio" name="ckListAppFormOnFile"
										<?=$row['ckListAppFormOnFile']=="Y" ? "checked" : ""?> value="Y">Yes
								<br /><br />
								<label for="ckListInterviwer">*Interviewer:</label>  
									<input type="text" name="ckListInterviwer" maxlength="20" size="20" 
									value="<?php echo $row['ckListInterviwer']; ?>" required></input>
								<br />
								<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
								<label for="ckListInterviewDate">Interview Date:</label>  
									<input type="text" id="datepicker4" name="ckListInterviewDate"  								value="<?php echo $row['ckListInterviewDate']; ?>" required></input>
							</div>			
							<div id="cklist2"> <!-- ======================== it divides the form in two divs ========================= -->						
								<label for="ckListStatus">Status:</label>   
									<input type="radio" name="ckListStatus"
										<?=$row['ckListStatus']=="Active" ? "checked" : ""?> value="Active">Active
									<input type="radio" name="ckListStatus"
										<?=$row['ckListStatus']=="OnHold" ? "checked" : ""?> value="OnHold">On Hold
									<input type="radio" name="ckListStatus"
										<?=$row['ckListStatus']=="Resigned" ? "checked" : ""?> value="Resigned">Resigned										
								<br /> <br />							 	    									
								<label for="ckListRef1">Reference 1:</label>   
									<input type="radio" name="ckListRef1"
										<?=$row['ckListRef1']=="N" ? "checked" : ""?> value="N">No
									<input type="radio" name="ckListRef1"
										<?=$row['ckListRef1']=="Y" ? "checked" : ""?> value="Y">Yes
								<br />
								<label for="ckListRef2">Reference 2:</label>   
									<input type="radio" name="ckListRef2"
										<?=$row['ckListRef2']=="N" ? "checked" : ""?> value="N">No
									<input type="radio" name="ckListRef2"
										<?=$row['ckListRef2']=="Y" ? "checked" : ""?> value="Y">Yes
								<br />						
								<label for="ckListRightToWork">Right to Work:</label> 	 
									<input type="radio" name="ckListRightToWork"
										<?=$row['ckListRightToWork']=="N" ? "checked" : ""?> value="N">No
									<input type="radio" name="ckListRightToWork"
										<?=$row['ckListRightToWork']=="Y" ? "checked" : ""?> value="Y">Yes
								<br />					
								<label for="ckListHealthClearance">Health Clearance:</label> 	 	 
									<input type="radio" name="ckListHealthClearance"
										<?=$row['ckListHealthClearance']=="N" ? "checked" : ""?> value="N">No
									<input type="radio" name="ckListHealthClearance"
										<?=$row['ckListHealthClearance']=="Y" ? "checked" : ""?> value="Y">Yes
								<br />			
								<label for="ckListNOfKinForm">Next Of Kin Form:</label>  	     	 	 
									<input type="radio" name="ckListNOfKinForm"
										<?=$row['ckListNOfKinForm']=="N" ? "checked" : ""?> value="N">No
									<input type="radio" name="ckListNOfKinForm"
										<?=$row['ckListNOfKinForm']=="Y" ? "checked" : ""?> value="Y">Yes			
								<br /><br />
								<label for="ckListConfAgreement">Volunteer Agreement:</label>  	     	 
									<input type="radio" name="ckListConfAgreement"
										<?=$row['ckListConfAgreement']=="N" ? "checked" : ""?> value="N">No
									<input type="radio" name="ckListConfAgreement"
										<?=$row['ckListConfAgreement']=="Y" ? "checked" : ""?> value="Y">Yes					
								<br />
								<br />
							</div>	
					</div>	
					<div = id="sendform"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="UPDATE"></input>
					</div>
				</form>
				<form name="mainMenu" action="mainMenu.php" method="get">
					<div = id="sendform2"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="MAIN MENU"></input>
					</div>
				</form>
				<form name="resetform" action="jobRoleListing_desc.php" method="get">
					<div = id="sendform3"> <!-- ===== reset form ============-->					
						<input type="Submit" Value="GO BACK"></input>
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


