<?php
// ************************** SECURITY CHECKS **************************
//User Level 1 
require "session1.php";
?>

/<?php

//Connect to Database
$db = mysql_connect("localhost","root","") 
or die("Could not connect.");
if(!$db) 
	die("no db");
if(!mysql_select_db("mcl",$db))
   die("No database selected.");
?>

<!DOCTYPE html>   
<html lang="en" xml:lang="en">  
	<head>  
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
	<title>
	Jorge Souza - Macmillan Caring Locally Database System
	</title>
	<link rel="stylesheet" type="text/css" href="css/addForms.css"/>
	</head>
	<body>
		<div id="main"> <!-- ======================== Main Page ========================= -->
			<div id="title">Upload Page</div>
			<div id="container">
				<div id="form">
					<?php
						//Upload File
						if (isset($_POST['submit'])) 
							{
								if (is_uploaded_file($_FILES['filename']['tmp_name'])) 
									{
										echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";
										echo "<br />";
										echo "<h2>Displaying file contents:</h2>";
										readfile($_FILES['filename']['tmp_name']);
									}

								//Import uploaded file to Database
								$handle = fopen($_FILES['filename']['tmp_name'], "r");

								while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
									{
										$import="INSERT into vol_rota(rotaID, rotaDate, wkLocID, rotaTime, workedHs, JobID, volID) 
											values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";

										mysql_query($import) or die(mysql_error());
									}
								echo "<br /><br />";
								fclose($handle);
								echo "<br /><br />";
								echo "Import done!";

								//view upload form
							}
						else 
							{
								// Display information to user
								echo "Browse file to be uploaded<br /><br />\n";
								echo "<form enctype='multipart/form-data' action='upload.php' method='post'>";
								echo "File name to import:<br />\n";
								echo "<input size='50' type='file' name='filename'><br />\n";
								echo "<input type='submit' name='submit' value='Upload'></form>";

							}
					?>
				</div>
			</div>
			<form name="mainMenu" action="upload.php" method="get">
				<div = id="sendform2"> <!-- ===== sending form ============-->					
					<input type="Submit" Value="UPLOAD NEW FILE"></input>
				</div>
			</form>
			<form name="mainMenu" action="adminHome.php" method="get">
				<div = id="sendform3"> <!-- ===== sending form ============-->					
					<input type="Submit" Value="SYSTEM ADMIN"></input>
				</div>
			</form>
		</div>
		<div id="footer"> <!-- ======================== Main page footer ========================= -->
		Jorge Souza - Bournemouth University  
		| For more information, please contact us by email i7250872@bournemouth.ac.uk
		</div>
	</body>
</html>
