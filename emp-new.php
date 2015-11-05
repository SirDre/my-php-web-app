<?php
/* 
	NEW.PHP
	Add data to 'customers' table 
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
      <div class="fixed-wrapper"><h1>Add New Employee</h1></div>
      <div class="container">
        
        <div class="content">
		
			
		   <form action="" method="post">
		    <div class="form-group">
			  <input type="text" class="form-control" id="InputName" name="employeeNumber" value="<?php echo $employeeNumber; ?>" placeholder="Employee No." required/>         
              <label for="exampleInputName"><i class="icon-tag"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
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
				 //$result = mysql_query("SELECT employeeNumber FROM 'classicmodels'.'employees' WHERE 'employeeNumber' !=0 ORDER BY employeeNumber DESC");  
				$result = mysql_query("SELECT officeCode, city, country FROM offices") 
					or die(mysql_error()); 
				
				  echo '<option class="form-control" value="0">Which Office?</option>';			
				  while ($row = mysql_fetch_array($result)) {
				   
				   echo '<option value="'. $row['officeCode'] .'">' . $row['city'] . ', ' . $row['country'] . '</option>';
				  }
				?>
				</select>
               <label for="exampleInputEmail1"><i class="icon-inbox"></i></label>
              <div class="clearfix"><?php echo $error; ?></div>
            </div>
 			<div class="form-group">
				<select class="form-control" id="InputName" name="reportsTo" onchange="return unNullify('<?php $reportsTo ?>', '0')" tabindex="7" >
				<?php 
				 //$result = mysql_query("SELECT employeeNumber FROM 'classicmodels'.'employees' WHERE 'employeeNumber' !=0 ORDER BY employeeNumber DESC");  
				$result2 = mysql_query("SELECT employeeNumber, lastName, firstName FROM employees") 
					or die(mysql_error()); 
				
				  echo '<option class="form-control" value="NULL">Employee Reports To?</option>';			
				  while ($row2 = mysql_fetch_array($result2)) {
				   
				   echo '<option value="'. $row2['employeeNumber'] .'">' . $row2['lastName'] . ' ' . $row2['firstName'] . '</option>';
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
 // get form data, making sure it is valid
 
    $employeeNumber = mysql_real_escape_string(htmlspecialchars($_POST['employeeNumber']));
	$lastName = mysql_real_escape_string(htmlspecialchars($_POST['lastName']));
	$firstName = mysql_real_escape_string(htmlspecialchars($_POST['firstName']));
	$extension = mysql_real_escape_string(htmlspecialchars($_POST['extension']));
	$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
	$officeCode = mysql_real_escape_string(htmlspecialchars($_POST['officeCode']));
	$reportsTo = mysql_real_escape_string(htmlspecialchars($_POST['reportsTo']));
	$jobTitle = mysql_real_escape_string(htmlspecialchars($_POST['jobTitle']));

 
	 // check to make sure both fields are entered
	 if ($employeeNumber == '' || $lastName == '' || $firstName == ''  )
	 {
	 // generate error message
	 $error = 'ERROR: Please fill in all required fields!';

	 // if either field is blank, display the form again
	empForm($employeeNumber, $lastName, $firstName, $extension, $email, $officeCode, $reportsTo, $jobTitle, $error);

	}else {
	 // save the data to the database

	 	 mysql_query("INSERT INTO employees (`employeeNumber`, `lastName`, `firstName`, `extension`, `email`, `officeCode`, `reportsTo`, `jobTitle`) VALUES ('$employeeNumber', '$lastName', '$firstName', '$extension', '$email', '$officeCode', '$reportsTo', '$jobTitle')")
	 or die(mysql_error()); 
	  

?>	
 <div id="employees" class="section">
      <div class="fixed-wrapper"><h1>Employee Add</h1></div>
    	  <div class="jumbotron">
			  <h1>Successfully added!</h1>
			  <p> <?php echo '<div class="alert alert-success"> Employee '.$lastName.' '.$firstName.' was added to the database </div>';?>  </p>
			</div>
		</div>			
 </div>		

<?php
			
	 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
	empForm('', '', '', '', '', '', '', '', '');
	 
  $error = 'ERROR: Something when wrong!';
 }
 
 
   // footer 
 include('footer.php');
?>