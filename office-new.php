<?php
/* 
	NEW.PHP
	Add data to 'customers' table 
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

    <div id="employees" class="section form-md-1">
      <div class="fixed-wrapper"><h1>Add New Office Info.</h1></div>
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
 
		$city = mysql_real_escape_string(htmlspecialchars($_POST['city']));
		$phone = mysql_real_escape_string(htmlspecialchars($_POST['phone']));
		$addressLine1 = mysql_real_escape_string(htmlspecialchars($_POST['addressLine1']));
		$addressLine2 = mysql_real_escape_string(htmlspecialchars($_POST['addressLine2']));
		$state = mysql_real_escape_string(htmlspecialchars($_POST['state']));
		$country = mysql_real_escape_string(htmlspecialchars($_POST['country']));
		$postalCode = mysql_real_escape_string(htmlspecialchars($_POST['postalCode']));
        $territory = mysql_real_escape_string(htmlspecialchars($_POST['territory']));

 
	 // check to make sure both fields are entered
	 if ($city == '' || $country == '' )
	 {
	 // generate error message
	 $error = 'ERROR: Please fill in all required fields!';

	 // if either field is blank, display the form again
	officeForm($officeCode, $city, $phone, $addressLine1, $addressLine2, $state, $country, $postalCode, $territory, $error);

	}else {
	 // save the data to the database

	 	 mysql_query("INSERT INTO offices (`officeCode`, `city`, `phone`, `addressLine1`, `addressLine2`, `state`, `country`, `postalCode`, `territory`) VALUES ('$officeCode', '$city', '$phone', '$addressLine1', '$addressLine2', '$state', '$country', '$postalCode', '$territory')")
	 or die(mysql_error()); 
	  

?>	
 <div id="employees" class="section">
      <div class="fixed-wrapper"><h1>Office Details Added</h1></div>
    	  <div class="jumbotron">
			  <h1>Successfully added!</h1>
			  <p> <?php echo '<div class="alert alert-success"> Office Details for '.$city.', '.$country.' was added to the database </div>';?>  </p>
			</div>
 </div>			
	

<?php
			
	 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
	officeForm('', '', '', '', '', '', '', '', '', '');
	 
  $error = 'ERROR: Something when wrong!';
 }
 
 
   // footer 
 include('footer.php');
?>