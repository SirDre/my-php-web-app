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
      <div class="fixed-wrapper"><h1>Edit Orders </h1></div>
      
	    <div class="bs-callout bs-callout-warning">
          <h3><b><?php echo 'The order on '.$orderDate.' is schedule arrive on '.$shippedDate.''; ?></b></h3>
       </div>  
	  <div class="container">
 
		<div class="content">
 	
		   <form action="" method="post">
		   <input type="hidden" name="orderNumber" value="<?php echo $orderNumber; ?>"/>        

		    <div class="form-group">
              <input type="text" class="form-control" id="InputName" name="orderDate" value="<?php echo $orderDate; ?>" placeholder="Order Date" required/>        
              <label for="orderDate"><i class="icon-inbox"></i></label>
			  <div class="clearfix"><?php echo $error; ?></div>
			</div>
			<div class="form-group">
              <input type="text" class="form-control" id="InputName" name="requiredDate" value="<?php echo $requiredDate; ?>" placeholder="Required Date" required/>        
              <label for="requiredDate"><i class="icon-inbox"></i></label>
			  <div class="clearfix"><?php echo $error; ?></div>
			</div>
			<div class="form-group">
			  <input type="text" class="form-control" id="InputName" name="shippedDate" value="<?php echo $shippedDate; ?>" placeholder="Shipped Date" required/>        
              <label for="shippedDate"><i class="icon-inbox"></i></label>
			  <div class="clearfix"><?php echo $error; ?></div>
            </div>
			<div class="form-group">
              <input type="text" class="form-control" id="InputName" name="status" value="<?php echo $status; ?>" placeholder="Status" required/>        
              <label for="status"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
			<div class="form-group">
              <input type="text" class="form-control" id="InputName" name="comments" value="<?php echo $comments; ?>" placeholder="Comments" required/>        
              <label for="comments"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>  
 
            <div class="form-group">
				<select class="form-control" id="InputName" name="customerNumber" onchange="return unNullify('<?php $customerNumber ?>', '0')" tabindex="8" >
				<?php 
				 
				 //$result = mysql_query("SELECT employeeNumber FROM 'classicmodels'.'employees' WHERE 'employeeNumber' !=0 ORDER BY employeeNumber DESC");  
				$result = mysql_query("SELECT customerNumber FROM orders WHERE customerNumber='$customerNumber' LIMIT 1") 
					or die(mysql_error()); 
						
				  while ($row = mysql_fetch_array($result)) {
				   
				   echo '<option value="'. $row['customerNumber'] .'" select>' . $row['customerNumber'] . '</option>';
				  }
				   
				$result2 = mysql_query("SELECT employeeNumber, lastName, firstName FROM employees") 
					or die(mysql_error()); 
					
				  while ($row2 = mysql_fetch_array($result2)) {
				   
				   echo '<option value="'. $row2['employeeNumber'] .'">' . $row2['lastName'] . ' ' . $row2['firstName'] . ' - ' . $row2['employeeNumber'] . '</option>';
				  }
				?>
				
				</select>
               <label for="customerNumber"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
			<input type="submit" name="submit" class="btn btn-small" value="Submit" >
           
          </form>
 
        </div>
            
      </div>
    </div><!-- /.container -->   
 <?php 
 }
 
  include('linkupdb.php');
 
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 	 // confirm that the 'id' value is a valid integer before getting the form data
	if (is_numeric($_POST['orderNumber']) || is_numeric($_POST['customerNumber']))
	{
 
        // get form data, making sure it is valid
		 $orderNumber = $_POST['orderNumber'];	
	 // get form data, making sure it is valid 
  
		$orderDate = mysql_real_escape_string(htmlspecialchars($_POST['orderDate']));
		$requiredDate = mysql_real_escape_string(htmlspecialchars($_POST['requiredDate']));
		$shippedDate = mysql_real_escape_string(htmlspecialchars($_POST['shippedDate']));
		$status = mysql_real_escape_string(htmlspecialchars($_POST['status']));
		$comments = mysql_real_escape_string(htmlspecialchars($_POST['comments']));
		$customerNumber = mysql_real_escape_string(htmlspecialchars($_POST['customerNumber']));
 
	
		 // check to make sure both fields are entered
	 if ($customerNumber == '' || $status == ''  )
	 {
		 // generate error message
		 $error = 'ERROR: Please fill in all required fields!';

			// if either field is blank, display the form again
		 ordersForm($orderNumber, $orderDate, $requiredDate, $shippedDate, $status, $comments, $customerNumber, $error);
	 }else {
	 // save the data to the database
	  mysql_query("UPDATE orders SET orderDate='$orderDate', requiredDate='$requiredDate', shippedDate='$shippedDate', status='$status', comments='$comments', customerNumber='$customerNumber' WHERE orderNumber='$orderNumber'")
	  or die(mysql_error()); 
	
	
?>	
			 <div class="jumbotron">
			  <h1>Successfully Updated!</h1>
			  <p> <?php echo '<div class="alert alert-success"> Orders on '.$orderDate.' is estimated to arrive at '.$shippedDate.' was updated to the database </div>';?>  </p>
			</div>
<?php
			
	 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
?>

			<div class="jumbotron">
			  <h1>Unable to find Customer!</h1>
			  <p> <?php echo '<div class="alert alert-danger">Unable to find customer within the database </div>';?>  </p>
			</div>

<?php
  
 }
	
} else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
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
			  <p> <?php echo '<div class="alert alert-danger">Unable to find customer within the database </div>';?>  </p>
			</div>

<?php
	}
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
?>
			<div class="jumbotron">
			  <h1>Error!</h1>
			  <p> <?php echo '<div class="alert alert-danger">Unable to find customer within the database </div>';?>  </p>
			</div>

<?php

 } 
 
}
 
 
   // footer 
 include('footer.php');
?>