<?php
/* 
	NEW.PHP
	Add data to 'employees' table 
*/

  // header 
 include('header.php');
	// connect to the database
 
 				 
function officeForm($officeCode, $city, $phone, $addressLine1, $addressLine2, $state, $country, $postalCode, $territory, $error)
 {
  // if there are any errors, display them
 if ($error != '')
 {
 echo '<div class="alert alert-danger"> '.$error.'</div>';
 }
 ?> 

    <div id="offices" class="section form-md-1">
      <div class="fixed-wrapper"><h1>Edit Office Details </h1></div>
      
	    <div class="bs-callout bs-callout-warning">
          <h3><b><?php echo ''.$city.', '.$country.''; ?></b></h3>
       </div>  
	  <div class="container">
 
		<div class="content">
 	
		   <form action="" method="post">
		   <input type="hidden" name="officeCode" value="<?php echo $officeCode; ?>"/>        

		    <div class="form-group">
              <input type="text" class="form-control" id="InputName" name="city" value="<?php echo $city; ?>" placeholder="City" required/>        
              <label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>	
		    <div class="form-group">
              <input type="text" class="form-control" id="InputName" name="phone" value="<?php echo $phone; ?>" placeholder="Phone No." required/>        
              <label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>				
            <div class="form-group">
              <input type="text" class="form-control" id="InputName" name="addressLine1" value="<?php echo $addressLine1; ?>" placeholder="Address Line1" required/>        
				<label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
              <input type="text" class="form-control" id="InputName" name="addressLine2" value="<?php echo $addressLine2; ?>" placeholder="Address Line2" required/>        
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
		    <div class="form-group">
              <input type="text" class="form-control" id="InputName" name="state" value="<?php echo $state; ?>" placeholder="State" required/>        
              <label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
			<div class="form-group">
              <input type="text" class="form-control" id="InputName" name="country" value="<?php echo $country; ?>" placeholder="Country" required/>        
              <label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
			<div class="form-group">
              <input type="text" class="form-control" id="InputName" name="postalCode" value="<?php echo $postalCode; ?>" placeholder="Postal Code" required/>        
              <label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>  
			<div class="form-group">
              <input type="text" class="form-control" id="InputName" name="territory" value="<?php echo $territory; ?>" placeholder="Territory" required/>        
              <label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
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
	if (is_numeric($_POST['officeCode']))
	{

        // get form data, making sure it is valid
		 $officeCode = $_POST['officeCode'];	
	 // get form data, making sure it is valid 
  
		$city = mysql_real_escape_string(htmlspecialchars($_POST['city']));
		$phone = mysql_real_escape_string(htmlspecialchars($_POST['phone']));
		$addressLine1 = mysql_real_escape_string(htmlspecialchars($_POST['addressLine1']));
		$addressLine2 = mysql_real_escape_string(htmlspecialchars($_POST['addressLine2']));
		$state = mysql_real_escape_string(htmlspecialchars($_POST['state']));
		$country = mysql_real_escape_string(htmlspecialchars($_POST['country']));
		$postalCode = mysql_real_escape_string(htmlspecialchars($_POST['postalCode']));
        $territory = mysql_real_escape_string(htmlspecialchars($_POST['territory']));
	
		 // check to make sure both fields are entered
	 if ($city == '' || $country == ''  )
	 {
		 // generate error message
		 $error = 'ERROR: Please fill in all required fields!';

			// if either field is blank, display the form again
			officeForm($officeCode, $city, $phone, $addressLine1, $addressLine2, $state, $country, $postalCode, $territory, $error);
	 }else {
	 // save the data to the database
	  mysql_query("UPDATE offices SET city='$city', phone='$phone', addressLine1='$addressLine1', addressLine2='$addressLine2', state='$state', country='$country', postalCode='$postalCode', territory='$territory' WHERE officeCode='$officeCode'")
	  or die(mysql_error()); 
	
	
?>	
			 <div class="jumbotron">
			  <h1>Successfully Updated!</h1>
			  <p> <?php echo '<div class="alert alert-success"> Office '.$city.', '.$country.' was updated to the database </div>';?>  </p>
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
 if (isset($_GET['officeCode']) && is_numeric($_GET['officeCode']) && $_GET['officeCode'] > 0)
 {
	 // query db
	 $officeCode = $_GET['officeCode'];
	 $result = mysql_query("SELECT * FROM offices WHERE officeCode='$officeCode'")
	 or die(mysql_error()); 
	 $row = mysql_fetch_array($result);
	 
	 // check that the 'id' matches up with a row in the database
	 if($row)
	 {
		 
		 // get data from db
		 $officeCode = $row['officeCode']; 
		 $city = $row['city']; 
		 $phone = $row['phone'];
		 $addressLine1 = $row['addressLine1']; 
		 $addressLine2 = $row['addressLine2'];
		 $state = $row['state'];
		 $country = $row['country'];
		 $postalCode = $row['postalCode'];
		 $territory = $row['territory'];
	 
		 // show form	
		officeForm($officeCode, $city, $phone, $addressLine1, $addressLine2, $state, $country, $postalCode, $territory, $error);
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