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
      <div class="fixed-wrapper"><h1>Employee Preview</h1></div>
   
	  <div class="container"> 
		<div class="content">
		 
		  <div class="col-md-8 col-sm-8 col-xs-12">
              <div class="team-portrait block">              
                <div class="title">
                  <h2><?php echo $firstName; ?> <?php echo $lastName; ?></h2>
                  <h3 class="italic"><?php echo $jobTitle; ?></h3>
                </div>
                <div class="portrait">
              
                    <i class="icon-user"></i>                                                   
                  
        		 </div>
		         <div class="bs-callout bs-callout-info"> 
        
			    <?php 
	 
				$result = mysql_query("SELECT officeCode, city, country FROM offices WHERE officeCode='$officeCode'") 
					or die(mysql_error()); 
			
				  while ($row = mysql_fetch_array($result)) {
				   
				   echo '<p><h4>Office Location:</h4> <i class="icon-building"></i> ' . $row['city'] . ', ' . $row['country'] . '</p>';
				  }
			 
			 
				$result2 = mysql_query("SELECT employeeNumber, lastName, firstName FROM employees WHERE reportsTo='$reportsTo' LIMIT 1") 
					or die(mysql_error()); 
				
				  while ($row2 = mysql_fetch_array($result2)) {
				   
				   echo '<p><h4>Reports To: </h4><i class="icon-user"></i> ' . $row2['lastName'] . ' ' . $row2['firstName'] . '</p>';
				  }
		 
				?>
				</div>
                 <div class="social-media">
                  <a href="#" data-toggle="tooltip" title="extension"><i class="icon-phone"></i><?php echo $extension; ?></a>
                  <a href="mailto:<?php echo $email; ?>" data-toggle="tooltip" title="email"><i class="icon-envelope"></i><?php echo $email; ?></a>
               	  <span class="stretch"></span>
        			 </div>
              </div>
            </div>
			
		    
 
        </div>
        <br />
        
      </div>
    </div><!-- /.container -->   
 <?php 
 }
 
  include('linkupdb.php');
 
 
 
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
 
 
   // footer 
 include('footer.php');
?>