<?php
/* 
	EXPORT.PHP
	Export all data from 'payments' table 
*/

 
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data
     require 'php-excel.class.php';
 
	// get results from database
	$result = mysql_query("SELECT customerNumber, checkNumber, paymentDate, amount FROM payments") 
		or die(mysql_error());  
		
	$data[] = array('customerNumber', 'checkNumber','paymentDate','amount');
	 
	while($row = mysql_fetch_array($result)){
	$data[] = array($row['customerNumber'],$row['checkNumber'],$row['paymentDate'],$row['amount']);
	}

	// generate file (constructor parameters are optional)
	$xls = new Excel_XML('UTF-8', false, 'Payments');
	$xls->addArray($data);
	$xls->generateXML('Exports_PaymentsReport');
?>
 
