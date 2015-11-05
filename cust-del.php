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
 if (isset($_GET['customerNumber']) && is_numeric($_GET['customerNumber']) && $_GET['customerNumber'] > 0)
 {
 // get id value
 $customerNumber = $_GET['customerNumber'];
 
  
 // delete the entry
 $result = mysql_query("DELETE FROM customers WHERE customerNumber='$customerNumber'")
 or die(mysql_error()); 
?>

			<div class="jumbotron">
			  <h1>Deleted!</h1>
			  <p> <?php echo '<div class="alert alert-danger">Delete customer within the database </div>';?>  </p>
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