<?php
/* 
	EXPORT.PHP
	Export all data from 'customers' table 
*/

 
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data
     require 'php-excel.class.php';
 
	// get results from database
	$result = mysql_query("SELECT customerNumber, customerName, contactLastName, contactFirstName, phone, addressLine1,addressLine2,city,state,postalCode,country, salesRepEmployeeNumber, creditLimit FROM customers") 
		or die(mysql_error()); 
 
 
	$data[] = array('customerNumber', 'customerName','contactLastName','contactFirstName','phone','addressLine1','addressLine2','city','state','postalCode','country','salesRepEmployeeNumber','creditLimit');
	 
	while($row = mysql_fetch_array($result)){
	$data[] = array($row['customerNumber'],$row['customerName'],$row['contactLastName'],$row['contactFirstName'],$row['phone'],$row['addressLine1'],$row['addressLine2'],$row['city'],$row['postalCode'],$row['country'],$row['salesRepEmployeeNumber'],$row['creditLimit']);
	}

	// generate file (constructor parameters are optional)
	$xls = new Excel_XML('UTF-8', false, 'Customers');
	$xls->addArray($data);
	$xls->generateXML('Exports_CustomersReport');
?>
 
