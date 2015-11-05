<?php
/* 
	EXPORT.PHP
	Export all data from 'employees' table 
*/

 
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data
     require 'php-excel.class.php';
 
	// get results from database
	$result = mysql_query("SELECT employeeNumber, lastName, firstName, extension, email, officeCode, reportsTo, jobTitle FROM employees") 
		or die(mysql_error()); 
 
 
	$data[] = array('employeeNumber', 'lastName','firstName','extension','email','officeCode','reportsTo','jobTitle');
	 
	while($row = mysql_fetch_array($result)){
	$data[] = array($row['employeeNumber'],$row['lastName'],$row['firstName'],$row['extension'],$row['email'],$row['officeCode'],$row['reportsTo'],$row['jobTitle']);
	}

	// generate file (constructor parameters are optional)
	$xls = new Excel_XML('UTF-8', false, 'Employees');
	$xls->addArray($data);
	$xls->generateXML('Exports_EmployeesReport');
?>
 
