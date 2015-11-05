<?php
/* 
	EXPORT.PHP
	Export all data from 'productlines' table 
*/

 
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data
     require 'php-excel.class.php';
 
	// get results from database
	$result = mysql_query("SELECT productLine, textDescription, htmlDescription, image FROM productlines") 
		or die(mysql_error());  
		
	$data[] = array('productLine', 'textDescription','htmlDescription','image');
	 
	while($row = mysql_fetch_array($result)){
	$data[] = array($row['productLine'],$row['textDescription'],$row['htmlDescription'],$row['image']);
	}

	// generate file (constructor parameters are optional)
	$xls = new Excel_XML('UTF-8', false, 'Productlines');
	$xls->addArray($data);
	$xls->generateXML('Exports_ProductlinesReport');
?>
 
