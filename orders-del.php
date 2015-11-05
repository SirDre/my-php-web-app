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
 if (isset($_GET['orderNumber']) && is_numeric($_GET['orderNumber']) && $_GET['orderNumber'] > 0)
 {
 // get id value
 $orderNumber = $_GET['orderNumber'];
 
  
 // delete the entry
 $result = mysql_query("DELETE FROM orders WHERE orderNumber='$orderNumber'")
 or die(mysql_error()); 
?>
 <div id="orders" class="section">
      <div class="fixed-wrapper"><h1>Orders Details</h1></div>
			<div class="jumbotron">
			  <h1>Orders Details Deleted</h1>
			  <p> <?php echo '<div class="alert alert-danger">Orders deleted from the database </div>';?>  </p>
	       </div>
	</div>			
 
<?php
 
 }
 else
 {
?> 
    
 			<div class="jumbotron">
			  <h1>No Information!</h1>
			  <p> <?php echo '<div class="alert alert-danger">Unable to find office details within the database </div>';?>  </p>
			</div>

<?php

 }
    // footer 
 include('footer.php');
?>