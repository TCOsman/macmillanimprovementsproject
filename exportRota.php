<?php
// ************************** SECURITY CHECKS **************************
//User Levels 1 and 2
require "session1-2.php";
?>

<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "weeklyRotaListing.xls"
header("Content-Disposition: attachment; filename=weeklyRotaListing.xls");
 
// Add data table
include 'weeklyRotaListing.php';
?>