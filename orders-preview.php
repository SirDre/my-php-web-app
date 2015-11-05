<?php
/* 
	NEW.PHP
	Add data to 'orders' table 
*/

  // header 
 include('header.php');
	// connect to the database
 
 									 
function ordersForm($orderNumber, $orderDate, $requiredDate, $shippedDate, $status, $comments, $customerNumber, $error)
 {
  // if there are any errors, display them
 if ($error != '')
 {
 echo '<div class="alert alert-danger"> '.$error.'</div>';
 }
 ?> 

    <div id="orders" class="section form-md-1">
      <div class="fixed-wrapper"><h1>Orders Preview</h1></div>
      
  
	  <div class="container">
 
		<div class="content">
 	
	   <div class="pricing">
		<div class="row">

		  <div class="col-md-12 col-sm-12 col-xs-12">
	
			<div class="wrapper block">		 
			   
			  <table class="table">
				<thead>
				  <tr><th colspan="3"><span class="price"><b>Order No.:</b><?php echo $orderNumber; ?></span></th></tr>
				</thead>
				<tbody>
			    <tr><td colspan="3">
				<div class="bs-callout bs-callout-info">
				  <h3><b><?php echo 'The order on '.$orderDate.' is schedule to arrive on '.$shippedDate.''; ?></b></h3>
			  
				<h3>Contact:
						   <?php 
				 
				 //$result = mysql_query("SELECT employeeNumber FROM 'classicmodels'.'employees' WHERE 'employeeNumber' !=0 ORDER BY employeeNumber DESC");  
				$result = mysql_query("SELECT o.customerNumber, e.employeeNumber, e.lastName, e.firstName FROM orders o, employees e WHERE customerNumber='$customerNumber' LIMIT 1") 
					or die(mysql_error()); 
						
				  while ($row = mysql_fetch_array($result)) {
				   
				   echo ' <a href="emp-preview.php?employeeNumber=' . $row['employeeNumber'] . '" >' . $row['lastName'] . ' ' . $row['firstName'] . ' - ' . $row['customerNumber'] . '</a> ';
				  }
				   
		 
				?></h3> </div></td></tr> 
				  <tr><td><h3>OrderDate:</h3><?php echo $orderDate; ?></td><td><h3>RequiredDate:</h3><?php echo $requiredDate; ?></td><td><h3>ShippedDate:</h3><?php echo $shippedDate; ?></td></tr> 
				  <tr><td colspan="3"><?php echo $comments; ?></td></tr>  				
				</tbody>
			  </table>
	
			    <span class="price"><?php echo $status; ?></span> 
			</div>
		  </div>
			  		
		</div>
	   </div>
	   
      </div>
            
      </div>
    </div><!-- /.container -->   
 <?php 
 }
 
  include('linkupdb.php');
 
 
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['orderNumber']) && is_numeric($_GET['orderNumber']) && $_GET['orderNumber'] > 0 || isset($_GET['customerNumber']) || $_GET['customerNumber'] > 0)
 {
	 // query db
	 $orderNumber = $_GET['orderNumber'];
	 $result = mysql_query("SELECT * FROM orders WHERE orderNumber='$orderNumber' OR customerNumber='$orderNumber'")
	 or die(mysql_error()); 
	 $row = mysql_fetch_array($result);
	 
	 // check that the 'id' matches up with a row in the database
	 if($row)
	 {
		 
		 // get data from db
		 $orderNumber = $row['orderNumber']; 
		 $orderDate = $row['orderDate']; 
		 $requiredDate = $row['requiredDate'];
		 $shippedDate = $row['shippedDate']; 
		 $status = $row['status'];
		 $comments = $row['comments'];
		 $customerNumber = $row['customerNumber'];
  
		 // show form	
		ordersForm($orderNumber, $orderDate, $requiredDate, $shippedDate, $status, $comments, $customerNumber, $error);
	 }
	 else
	 // if no match, display result
	 {
?>
	 
			<div class="jumbotron">
			  <h1>No Information!</h1>
			  <p> <?php echo '<div class="alert alert-danger">Unable to find your order within the database </div>';?>  </p>
			</div>

<?php
	}
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
?>
	        <div class="jumbotron">
			  <h1>No Information!</h1>
			  <p> <?php echo '<div class="alert alert-danger">Unable to find your order within the database </div>';?>  </p>
			</div>
<?php

 } 
 
 
 
   // footer 
 include('footer.php');
?>