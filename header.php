<?php
    
/* 
	HEADER.PHP
	Displays HTML header tags
*/


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="my php app">
    <meta name="author" content="sirdre">

    <title>MY PHP APP</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" >
    
    <!-- Montserrat: http://www.google.com/fonts/#QuickUsePlace:quickUse/Family:Montserrat -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Montserrat:700,100' rel='stylesheet' type='text/css'> -->
        
    <!-- Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>
    <div id="navbar" class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><i class="icon-book"></i>MY PHP APP</a>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li style="display: none;"><a href="#home"></a></li>
          <li><a class="scroll" href="./index.php#customers" data-target="#customers" ><i class="icon-user"></i>Customers<span class="arrow-left"></span></a></li>
          <li><a class="scroll" href="./index.php#employees" data-target="#employees"><i class="icon-user"></i>Employees<span class="arrow-left"></span></a></li>
          <li><a class="scroll" href="./index.php#offices" data-target="#offices"><i class="icon-building"></i>Offices<span class="arrow-left"></span></a></li>
          <li><a class="scroll" href="./index.php#orderdetails" data-target="#orderdetails"><i class="icon-list-ul"></i>Orderdetails<span class="arrow-left"></span></a></li>
		  <li><a class="scroll" href="./index.php#orders" data-target="#orders"><i class="icon-shopping-cart"></i>Orders<span class="arrow-left"></span></a></li>
		  <li><a class="scroll" href="./index.php#payments" data-target="#payments"><i class="icon-dollar"></i>Payments<span class="arrow-left"></span></a></li>
		  <li><a class="scroll" href="./index.php#productlines" data-target="#productlines"><i class="icon-ambulance"></i>Productlines<span class="arrow-left"></span></a></li>
		  <li><a class="scroll" href="./index.php#products" data-target="#products"><i class="icon-briefcase"></i>Products<span class="arrow-left"></span></a></li>
		  <li>&nbsp;</li>
		  <li>&nbsp;</li>
		  <li>&nbsp;</li>
         
        </ul>
      </div><!--/.nav-collapse -->
    </div>
 