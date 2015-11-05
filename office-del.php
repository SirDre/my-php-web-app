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
 if (isset($_GET['officeCode']) && is_numeric($_GET['officeCode']) && $_GET['officeCode'] > 0)
 {
 // get id value
 $officeCode = $_GET['officeCode'];
 
  
 // delete the entry
 $result = mysql_query("DELETE FROM offices WHERE officeCode='$officeCode'")
 or die(mysql_error()); 
?>
 <div id="offices" class="section">
      <div class="fixed-wrapper"><h1>Office Details</h1></div>
			<div class="jumbotron">
			  <h1>>Office Details Deleted</h1>
			  <p> <?php echo '<div class="alert alert-danger">Office details deleted from the database </div>';?>  </p>
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