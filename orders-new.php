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
      <div class="fixed-wrapper"><h1>Add an Order</h1></div>
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
					   
				$result2 = mysql_query("SELECT employeeNumber, lastName, firstName FROM employees") 
					or die(mysql_error()); 
				   echo '<option class="form-control" value="0">Who is Customer?</option>';	
				  while ($row2 = mysql_fetch_array($result2)) {
				   
				   echo '<option value="'. $row2['employeeNumber'] .'">' . $row2['lastName'] . ' ' . $row2['firstName'] . '</option>';
				  }
				?>
				
				</select>
               <label for="customerNumber"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
			<input type="submit" name="submit" class="btn btn-small" value="Submit" >
           
          </form>
 
        </div>
        <br />
        
      </div>
    </div><!-- /.container -->   
 <?php 
 }
 
  include('linkupdb.php');
 
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 
		$orderDate = mysql_real_escape_string(htmlspecialchars($_POST['orderDate']));
		$requiredDate = mysql_real_escape_string(htmlspecialchars($_POST['requiredDate']));
		$shippedDate = mysql_real_escape_string(htmlspecialchars($_POST['shippedDate']));
		$status = mysql_real_escape_string(htmlspecialchars($_POST['status']));
		$comments = mysql_real_escape_string(htmlspecialchars($_POST['comments']));
		$customerNumber = mysql_real_escape_string(htmlspecialchars($_POST['customerNumber']));

 
	 // check to make sure both fields are entered
	 if ($orderDate == '' || $customerNumber == '' )
	 {
	 // generate error message
	 $error = 'ERROR: Please fill in all required fields!';

	 // if either field is blank, display the form again
	 ordersForm($orderNumber, $orderDate, $requiredDate, $shippedDate, $status, $comments, $customerNumber, $error);

	}else {
	 // save the data to the database

	 	 mysql_query("INSERT INTO orders (`orderNumber`, `orderDate`, `requiredDate`, `shippedDate`, `status`, `comments`, `customerNumber`) VALUES ('$orderNumber', '$orderDate', '$requiredDate', '$shippedDate', '$status', '$comments', '$customerNumber')")
	 or die(mysql_error()); 
	  

?>	
 <div id="employees" class="section">
      <div class="fixed-wrapper"><h1>Orders Added</h1></div>
    	  <div class="jumbotron">
			  <h1>Successfully added!</h1>
			  <p> <?php echo '<div class="alert alert-success"> Order on '.$orderDate.' is schedule to available on '.$requiredDate.' was added to the database </div>';?>  </p>
			</div>
 </div>			
	

<?php
			
	 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
	ordersForm('', '', '', '', '', '', '', '');
	 
  $error = 'ERROR: Something when wrong!';
 }
 
 
   // footer 
 include('footer.php');
?>