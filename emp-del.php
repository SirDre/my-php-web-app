<?php
/* 
 DELETE.PHP
 Deletes a specific entry from the 'players' table
*/
  // header 
 include('header.php');
	// connect to the database
 include('linkupdb.php');
 
 
 
 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['employeeNumber']) && is_numeric($_GET['employeeNumber']) && $_GET['employeeNumber'] > 0)
 {
 // get id value
 $employeeNumber = $_GET['employeeNumber'];
 
  
 // delete the entry
 $result = mysql_query("DELETE FROM employees WHERE employeeNumber='$employeeNumber'")
 or die(mysql_error()); 
?>
 <div id="employees" class="section">
      <div class="fixed-wrapper"><h1>Employee Deleted</h1></div>
			<div class="jumbotron">
			  <h1>Deleted!</h1>
			  <p> <?php echo '<div class="alert alert-danger">Delete customer within the database </div>';?>  </p>
	       </div>
	</div>			
 </div>
<?php
 
 }
 else
 {
?> 
    
 			<div class="jumbotron">
			  <h1>No Information!</h1>
			  <p> <?php echo '<div class="alert alert-danger">Unable to find customer within the database </div>';?>  </p>
			</div>

<?php

 }
    // footer 
 include('footer.php');
?>