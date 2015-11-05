<?php
/* 
	EXPORT.PHP
	Export all data from 'orderdetails' table 
*/

 
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data
     require 'php-excel.class.php';
 
	// get results from database
	$result = mysql_query("SELECT orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber FROM orderdetails") 
		or die(mysql_error());  
		
	$data[] = array('orderNumber', 'productCode','quantityOrdered','priceEach','orderLineNumber');
	 
	while($row = mysql_fetch_array($result)){
	$data[] = array($row['orderNumber'],$row['productCode'],$row['quantityOrdered'],$row['priceEach'],$row['orderLineNumber']);
	}

	// generate file (constructor parameters are optional)
	$xls = new Excel_XML('UTF-8', false, 'OrderDetails');
	$xls->addArray($data);
	$xls->generateXML('Exports_OrderDetailsReport');
?>
 
