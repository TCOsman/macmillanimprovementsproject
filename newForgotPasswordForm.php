<?php
// ************************** SECURITY CHECKS **************************
?>

<?php
?>

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
		<link rel="stylesheet" type="text/css" href="css/addForms.css"/>		
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Forgotten My Password </div>
			<br />
		
		
			<form name="userchangePassword" action="userForgotPasswordChange.php" method="get">
				<div id="newRecord"> <!-- ======================== Add new record information ========================= -->
						
					<br />
					
					<label for="Subject">Email Address:</label>     
						<input type="text" name="Email" size="30" required></input><br />
				
					<br>
					<br>
					<label for="Subject">Username:</label>     
						<input type="text" name="Username" size="30" required></input><br />
						
						
					
					<br>
					
				
				<br />
				
				<div = id="sendform"> <!-- ===== sending form ============-->					
					<input type="Submit" Value="SUBMIT"></input>
				</div>
			</form>
			
			
			
			<br />
		</div>
		</div>
		<div id="footer"> <!-- ======================== Main page footer ========================= -->
			Jorge Souza - Bournemouth University  
			| For more information, please contact us by email i7250872@bournemouth.ac.uk
		</div>
	</body>
</html>

