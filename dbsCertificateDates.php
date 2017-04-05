<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
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
		<link rel="stylesheet" type="text/css" href="css/listing.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">DBS Certificate Expiration Date</div>
			<div id="listing"> <!-- ======================== Lists new record information ========================= -->
				<!-- form with two fields and a submit buttons -->
				<form name="driverDates" action="dbsCertificateListing.php" method="get">
						<div id="dateRight"> <!-- ======================== Stard Date information ========================= -->
							<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
							<label for="startDate">*Start Date:</label>        
								<input type="text" id="datepicker1" name="startDate" required></input>
						</div>
						<div id="dateLeft"> <!-- ======================== End Date information ========================= -->
							<!-- Date Picker Icon-Trigger	from http://jqueryui.com/datepicker/#icon-trigger --> 
							<label for="endDate">*End Date:</label>        
								<input type="text" id="datepicker2" name="endDate" required></input>
						</div>
			</div>	
					<br />			
					<div id="sendform1"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="SUBMIT"></input>
					</div>
				</form>	
			<form name="listingMenu" action="listRecords.php" method="get">
				<div id="sendform2"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="LISTING MENU"></input>
				</div>
			</form>		
			<form name="mainMenu" action="mainMenu.php" method="get">
				<div = id="sendform2"> <!-- ===== sending form ============-->					
						<input type="Submit" Value="MAIN MENU"></input>
				</div>
			</form>	
			<form name="resetform" action="dbsCertificateDates.php" method="get">
				<div id="sendform3"> <!-- ===== reset form ============-->					
						<input type="Submit" Value="RESET"></input>
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
// Exits the script
exit();
?>