<?php
/* 
	EXPORT.PHP
	Export all data from 'orders' table 
*/

 
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data
     require 'php-excel.class.php';
 
	// get results from database
	$result = mysql_query("SELECT orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber FROM orders") 
		or die(mysql_error());  
 
	$data[] = array('orderNumber', 'orderDate','requiredDate','shippedDate','status','comments', 'customerNumber');
	 
	while($row = mysql_fetch_array($result)){
	$data[] = array($row['orderNumber'],$row['orderDate'],$row['requiredDate'],$row['shippedDate'],$row['status'],$row['comments'],$row['customerNumber']);
	}

	// generate file (constructor parameters are optional)
	$xls = new Excel_XML('UTF-8', false, 'Orders');
	$xls->addArray($data);
	$xls->generateXML('Exports_OrdersReport');
?>
 
