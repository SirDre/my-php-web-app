<?php
/* 
	NEW.PHP
	Add data to 'employees' table 
*/

  // header 
 include('header.php');
	// connect to the database
 
 
function empForm($employeeNumber, $lastName, $firstName, $extension, $email, $officeCode, $reportsTo, $jobTitle, $error)
 {
  // if there are any errors, display them
 if ($error != '')
 {
 echo '<div class="alert alert-danger"> '.$error.'</div>';
 }
 ?> 

    <div id="employees" class="section form-md-1">
      <div class="fixed-wrapper"><h1>Edit Employee </h1></div>
      
	    <div class="bs-callout bs-callout-warning">
          <h3><b><?php echo ''.$lastName.' '.$firstName.''; ?></b></h3>
       </div>  
	  <div class="container">
    
  
		
		<div class="content">
		
			
		   <form action="" method="post">
		   <input type="hidden" name="employeeNumber" value="<?php echo $employeeNumber; ?>"/>        
		
            <div class="form-group">
              <input type="text" class="form-control" id="InputName" name="lastName" value="<?php echo $lastName; ?>" placeholder="Last Name" required/>        
				<label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
              <input type="text" class="form-control" id="InputName" name="firstName" value="<?php echo $firstName; ?>" placeholder="First Name" required/>        
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
		    <div class="form-group">
              <input type="text" class="form-control" id="InputName" name="extension" value="<?php echo $extension; ?>" placeholder="Extension x" required/>        
              <label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
			<div class="form-group">
              <input type="text" class="form-control" id="InputName" name="email" value="<?php echo $email; ?>" placeholder="Email" required/>        
              <label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
 			<div class="form-group">
				<select class="form-control" id="InputName" name="officeCode" onchange="return unNullify('<?php $officeCode ?>', '0')" tabindex="6" >
				<?php 
						  	    
				$result1 = mysql_query("SELECT officeCode, city, country FROM offices") 
					or die(mysql_error()); 
			
				  while ($row1 = mysql_fetch_array($result1)) {
				   
				   echo '<option value="'. $row1['officeCode'] .'" >' . $row1['city'] . ', ' . $row1['country'] . '</option>';
				  }
				  
				$result = mysql_query("SELECT officeCode, city, country FROM offices WHERE officeCode='$officeCode'") 
					or die(mysql_error()); 
			
				  while ($row = mysql_fetch_array($result)) {
				   
				   echo '<option value="'. $row['officeCode'] .'" select>' . $row['city'] . ', ' . $row['country'] . '</option>';
				  }
				  
			
				?>
				</select>
               <label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
 			<div class="form-group">
				<select class="form-control" id="InputName" name="reportsTo" onchange="return unNullify('<?php $reportsTo ?>', '0')" tabindex="7" >
				<?php 
			 
				$result2 = mysql_query("SELECT employeeNumber, lastName, firstName FROM employees WHERE reportsTo='$reportsTo'") 
					or die(mysql_error()); 
				
				  while ($row2 = mysql_fetch_array($result2)) {
				   
				   echo '<option value="'. $row2['employeeNumber'] .'" select>' . $row2['lastName'] . ' ' . $row2['firstName'] . '</option>';
				  }
				  
				  $result3 = mysql_query("SELECT employeeNumber, lastName, firstName FROM employees") 
					or die(mysql_error()); 
						
				  while ($row3 = mysql_fetch_array($result3)) {
				   
				   echo '<option value="'. $row3['employeeNumber'] .'">' . $row3['lastName'] . ' ' . $row3['firstName'] . '</option>';
				  }
				?>
				</select>
               <label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
			<div class="form-group">
              <input type="text" class="form-control" id="InputName" name="jobTitle" value="<?php echo $jobTitle; ?>" placeholder="Job Title" required/>        
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
 	 // confirm that the 'id' value is a valid integer before getting the form data
	if (is_numeric($_POST['employeeNumber']))
	{

        // get form data, making sure it is valid
		 $employeeNumber = $_POST['employeeNumber'];	
	 // get form data, making sure it is valid 
  
		$lastName = mysql_real_escape_string(htmlspecialchars($_POST['lastName']));
		$firstName = mysql_real_escape_string(htmlspecialchars($_POST['firstName']));
		$extension = mysql_real_escape_string(htmlspecialchars($_POST['extension']));
		$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
		$officeCode = mysql_real_escape_string(htmlspecialchars($_POST['officeCode']));
		$reportsTo = mysql_real_escape_string(htmlspecialchars($_POST['reportsTo']));
		$jobTitle = mysql_real_escape_string(htmlspecialchars($_POST['jobTitle']));
 
	
		 // check to make sure both fields are entered
	 if ($lastName == '' || $lastName == ''  )
	 {
		 // generate error message
		 $error = 'ERROR: Please fill in all required fields!';

			// if either field is blank, display the form again
			empForm($employeeNumber, $lastName, $firstName, $extension, $email, $officeCode, $reportsTo, $jobTitle, $error);
	 }else {
	 // save the data to the database
	  mysql_query("UPDATE employees SET lastName='$lastName', firstName='$firstName', extension='$extension', email='$email', officeCode='$officeCode', reportsTo='$reportsTo', jobTitle='$jobTitle' WHERE employeeNumber='$employeeNumber'")
	  or die(mysql_error()); 
	
	
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
			  <h1>Unable to find Employee!</h1>
			  <p> <?php echo '<div class="alert alert-danger">Unable to find employee within the database </div>';?>  </p>
			</div>

<?php
  
 }
	
} else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['employeeNumber']) && is_numeric($_GET['employeeNumber']) && $_GET['employeeNumber'] > 0)
 {
	 // query db
	 $employeeNumber = $_GET['employeeNumber'];
	 $result = mysql_query("SELECT * FROM employees WHERE employeeNumber='$employeeNumber'")
	 or die(mysql_error()); 
	 $row = mysql_fetch_array($result);
	 
	 // check that the 'id' matches up with a row in the database
	 if($row)
	 {
		 
		 // get data from db
		 $employeeNumber = $row['employeeNumber']; 
		 $lastName = $row['lastName']; 
		 $firstName = $row['firstName'];
		 $extension = $row['extension']; 
		 $email = $row['email'];
		 $officeCode = $row['officeCode'];
		 $reportsTo = $row['reportsTo'];
		 $jobTitle = $row['jobTitle'];
	 
		 // show form	
		empForm($employeeNumber, $lastName, $firstName, $extension, $email, $officeCode, $reportsTo, $jobTitle, $error);
	 }
	 else
	 // if no match, display result
	 {
?>
	 
	        <div class="jumbotron">
			  <h1>Unable to find Employee!</h1>
			  <p> <?php echo '<div class="alert alert-danger">Unable to find employee within the database </div>';?>  </p>
			</div>

<?php
	}
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
?>
	        <div class="jumbotron">
			  <h1>Unable to find Employee!</h1>
			  <p> <?php echo '<div class="alert alert-danger">Unable to find employee within the database </div>';?>  </p>
			</div>

<?php

 } 
 
}
 
 
   // footer 
 include('footer.php');
?>