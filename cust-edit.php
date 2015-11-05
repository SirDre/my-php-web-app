<?php
/* 
	NEW.PHP
	Add data to 'customers' table 
*/

  // header 
 include('header.php');
	// connect to the database
 
 
function renderForm($customerNumber, $customerName, $contactLastName, $contactFirstName, $phone, $addressLine1, $addressLine2, $city, $state, $postalCode, $country, $salesRepEmployeeNumber, $creditLimit, $error)
 {
  // if there are any errors, display them
 if ($error != '')
 {
 echo '<div class="alert alert-danger"> '.$error.'</div>';
 }
 ?> 

    <div id="customers" class="section form-md-1">
      <div class="fixed-wrapper"><h1>Edit Customer</h1></div>
       <div class="bs-callout bs-callout-warning">
          <h3><b><?php echo $customerName; ?></b></h3>
       </div> 
	   <div class="container">
 
        <div class="content">
		
			
		   <form action="" method="post"> 
			<input type="hidden" name="customerNumber" value="<?php echo $customerNumber; ?>"/>        
            
            <div class="form-group">
			  <input type="text" class="form-control" id="InputName" name="customerName" value="<?php echo $customerName; ?>" placeholder="Customer Name" required/>         
              <label for="exampleInputName"><i class="icon-pencil"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="InputName" name="contactLastName" value="<?php echo $contactLastName; ?>" placeholder="contact Last Name" required/>        
				<label for="exampleInputEmail1"><i class="icon-pencil"></i></label>
              <input type="text" class="form-control" id="InputName" name="contactFirstName" value="<?php echo $contactFirstName; ?>" placeholder="contact First Name" required/>        
             
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
		    <div class="form-group">
              <input type="text" class="form-control" id="InputName" name="phone" value="<?php echo $phone; ?>" placeholder="Phone" required/>        
              <label for="exampleInputEmail1"><i class="icon-pencil"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
		    <div class="form-group">
              <input type="text" class="form-control" id="InputName" name="addressLine1" value="<?php echo $addressLine1; ?>" placeholder="Address 1" required/>        
              <label for="exampleInputEmail1"><i class="icon-pencil"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
              <input type="text" class="form-control" id="InputName" name="addressLine2" value="<?php echo $addressLine2; ?>" placeholder="Address 2" required/>        
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
			 <div class="form-group">
              <input type="text" class="form-control" id="InputName" name="city" value="<?php echo $city; ?>" placeholder="City" required/>        
              <label for="exampleInputEmail1"><i class="icon-pencil"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
			 <div class="form-group">
              <input type="text" class="form-control" id="InputName" name="state" value="<?php echo $state; ?>" placeholder="State" required/>        
              <label for="exampleInputEmail1"><i class="icon-pencil"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
			<div class="form-group">
              <input type="text" class="form-control" id="InputName" name="postalCode" value="<?php echo $postalCode; ?>" placeholder="Postal Code" required/>        
              <label for="exampleInputEmail1"><i class="icon-pencil"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
			<div class="form-group">
              <input type="text" class="form-control" id="InputName" name="country" value="<?php echo $country; ?>" placeholder="Country" required/>        
              <label for="exampleInputEmail1"><i class="icon-pencil"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
 			<div class="form-group">
				<select class="form-control" id="InputName" name="salesRepEmployeeNumber" onchange="return unNullify('<?php $salesRepEmployeeNumber ?>', '0')" tabindex="5" >
				<?php 
				$customerNumber = $_GET['customerNumber'];
				 //$result = mysql_query("SELECT employeeNumber FROM 'classicmodels'.'employees' WHERE 'employeeNumber' !=0 ORDER BY employeeNumber DESC");  
				$result = mysql_query("SELECT salesRepEmployeeNumber FROM customers WHERE customerNumber='$customerNumber' LIMIT 1") 
					or die(mysql_error()); 
						
				  while ($row = mysql_fetch_array($result)) {
				   
				   echo '<option value="'. $row['salesRepEmployeeNumber'] .'" select>' . $row['salesRepEmployeeNumber'] . '</option>';
				  }
				   
				$result2 = mysql_query("SELECT employeeNumber, lastName, firstName FROM employees") 
					or die(mysql_error()); 
					
				  while ($row2 = mysql_fetch_array($result2)) {
				   
				   echo '<option value="'. $row2['employeeNumber'] .'">' . $row2['lastName'] . ' ' . $row2['firstName'] . '</option>';
				  }
				?>
				
				</select>
               <label for="exampleInputEmail1"><i class="icon-pencil"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
			<div class="form-group">
              <input type="text" class="form-control" id="InputName" name="creditLimit" value="<?php echo $creditLimit; ?>" placeholder="Credit Limit" required/>        
              <label for="exampleInputEmail1"><i class="icon-pencil"></i></label>
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
 	 // confirm that the 'id' value is a valid integer before getting the form data
	if (is_numeric($_POST['customerNumber']))
	{

        // get form data, making sure it is valid
		 $customerNumber = $_POST['customerNumber'];	
	 // get form data, making sure it is valid 
		$customerName = mysql_real_escape_string(htmlspecialchars($_POST['customerName']));
		$contactLastName = mysql_real_escape_string(htmlspecialchars($_POST['contactLastName']));
		$contactFirstName = mysql_real_escape_string(htmlspecialchars($_POST['contactFirstName']));
		$phone = mysql_real_escape_string(htmlspecialchars($_POST['phone']));
		$addressLine1 = mysql_real_escape_string(htmlspecialchars($_POST['addressLine1']));
		$addressLine2 = mysql_real_escape_string(htmlspecialchars($_POST['addressLine2']));
		$city = mysql_real_escape_string(htmlspecialchars($_POST['city']));
		$state = mysql_real_escape_string(htmlspecialchars($_POST['state']));
		$postalCode = mysql_real_escape_string(htmlspecialchars($_POST['postalCode']));
		$country = mysql_real_escape_string(htmlspecialchars($_POST['country']));	 
		$salesRepEmployeeNumber = mysql_real_escape_string(htmlspecialchars($_POST['salesRepEmployeeNumber']));	
		$creditLimit = mysql_real_escape_string(htmlspecialchars($_POST['creditLimit']));
 
	
		 // check to make sure both fields are entered
	 if ($customerName == '' || $customerName == ''  )
	 {
	 // generate error message
	 $error = 'ERROR: Please fill in all required fields!';

	 // if either field is blank, display the form again
		renderForm($customerNumber, $customerName, $contactLastName, $contactFirstName, $phone, $addressLine1, $addressLine2, $city, $state, $postalCode, $country, $salesRepEmployeeNumber, $creditLimit, $error);
	 }else {
	 // save the data to the database
	  mysql_query("UPDATE customers SET customerName='$customerName', contactLastName='$contactLastName', contactFirstName='$contactFirstName', phone='$phone', addressLine1='$addressLine1', addressLine2='$addressLine2', city='$city', state='$state', postalCode='$postalCode', country='$country', salesRepEmployeeNumber='$salesRepEmployeeNumber', creditLimit='$creditLimit' WHERE customerNumber='$customerNumber'")
	  or die(mysql_error()); 
	 
	 //	 mysql_query("INSERT INTO customers (`customerNumber`, `customerName`, `contactLastName`, `contactFirstName`, `phone`, `addressLine1`, `addressLine2`, `city`, `state`, `postalCode`, `country`, `salesRepEmployeeNumber`, `creditLimit`) VALUES ('$customerNumber', '$customerName', '$contactLastName', '$contactFirstName', '$phone', '$addressLine1', '$addressLine2', '$city', '$state', '$postalCode', '$country', '$salesRepEmployeeNumber', '$creditLimit')")
	 //or die(mysql_error()); 
 
	 // once saved, redirect back to the view page
	
	
?>	
			 <div class="jumbotron">
			  <h1>Successfully Updated!</h1>
			  <p> <?php echo '<div class="alert alert-success"> Customer '.$customerName.' was updated to the database </div>';?>  </p>
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
 if (isset($_GET['customerNumber']) && is_numeric($_GET['customerNumber']) && $_GET['customerNumber'] > 0)
 {
	 // query db
	 $customerNumber = $_GET['customerNumber'];
	 $result = mysql_query("SELECT * FROM customers WHERE customerNumber='$customerNumber'")
	 or die(mysql_error()); 
	 $row = mysql_fetch_array($result);
	 
	 // check that the 'id' matches up with a row in the database
	 if($row)
	 {
		 
		 // get data from db
		 $customerNumber = $row['customerNumber']; 
		 $customerName = $row['customerName']; 
		 $contactLastName = $row['contactLastName'];
		 $contactFirstName = $row['contactFirstName']; 
		 $phone = $row['phone'];
		 $addressLine1 = $row['addressLine1'];
		 $addressLine2 = $row['addressLine2'];
		 $city = $row['city'];
		 $state = $row['state'];
		 $postalCode = $row['$postalCode'];
		 $country = $row['country'];
		 $salesRepEmployeeNumber = $row['salesRepEmployeeNumber'];
		 $creditLimit = $row['creditLimit'];
	 
		 // show form	
		 renderForm($customerNumber, $customerName, $contactLastName, $contactFirstName, $phone, $addressLine1, $addressLine2, $city, $state, $postalCode, $country, $salesRepEmployeeNumber, $creditLimit, $error);

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