<?php
/* 
	EXPORT.PHP
	Export all data from 'products' table 
*/

 
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data
     require 'php-excel.class.php';
 
	// get results from database
	$result = mysql_query("SELECT productCode, productName, productLine, productScale, productVendor, productDescription, quantityInStock, buyPrice, MSRP FROM products") 
		or die(mysql_error());  
	
	$data[] = array('productCode', 'productName','productLine','productScale','productVendor', 'productDescription', 'quantityInStock', 'buyPrice', 'MSRP');
	 
	while($row = mysql_fetch_array($result)){
	$data[] = array($row['productCode'],$row['productName'],$row['productLine'],$row['productScale'],$row['productVendor'],$row['productDescription'],$row['quantityInStock'],$row['buyPrice'],$row['MSRP']);
	}

	// generate file (constructor parameters are optional)
	$xls = new Excel_XML('UTF-8', false, 'Products');
	$xls->addArray($data);
	$xls->generateXML('Exports_ProductsReport');
?>
 
