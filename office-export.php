<?php
/* 
	EXPORT.PHP
	Export all data from 'offices' table 
*/

 
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data
     require 'php-excel.class.php';
 
	// get results from database
	$result = mysql_query("SELECT officeCode, city, phone, addressLine1, addressLine2, state, country, postalCode, territory FROM offices") 
		or die(mysql_error()); 

	$data[] = array('officeCode', 'city','phone','addressLine1','addressLine2','state','country','postalCode','territory');
	 
	while($row = mysql_fetch_array($result)){
	$data[] = array($row['officeCode'],$row['city'],$row['phone'],$row['addressLine1'],$row['addressLine2'],$row['state'],$row['country'],$row['postalCode'],$row['territory']);
	}

	// generate file (constructor parameters are optional)
	$xls = new Excel_XML('UTF-8', false, 'Offices');
	$xls->addArray($data);
	$xls->generateXML('Exports_OfficesReport');
?>
 
