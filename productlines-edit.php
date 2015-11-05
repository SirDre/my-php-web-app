<?php
/* 
	NEW.PHP
	Add data to 'employees' table 
*/

  // header 
 include('header.php');
	// connect to the database
 
 									 
function productlinesForm($productLine, $textDescription, $htmlDescription, $image, $error)
 {
  // if there are any errors, display them
 if ($error != '')
 {
 echo '<div class="alert alert-danger"> '.$error.'</div>';
 }
 
 	$result = mysql_query("SELECT image FROM productlines WHERE productLine='$productLine'") 
		or die(mysql_error()); 
 ?> 

    <div id="productlines" class="section form-md-1">
      <div class="fixed-wrapper"><h1>Edit Product Lines</h1></div>
      
	    <div class="bs-callout bs-callout-warning">
          <h3><b><?php echo ''.$productLine.' Product Lines '; ?></b></h3>
		  <p><?php

			while($row = mysql_fetch_array( $result )) {
				
			if(!empty($row['image'])){			 
				 echo '  <img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" alt="product" class="img-thumbnail"> ';
				}
				
			}
		  ?></p>
       </div>  
	  <div class="container">
 
		<div class="content">
 	
		   <form action="" method="post" enctype="multipart/form-data">
		   <input type="hidden" name="productLine" value="<?php echo $productLine; ?>"/>        


			<div class="form-group textarea">
              <textarea rows="6" class="form-control" id="textDescription" name="textDescription" placeholder="textDescription" required><?php echo $textDescription; ?></textarea>
              <label for="textDescription"><i class="icon-pencil"></i></label>
              <div class="clearfix"></div>
            </div>
			<div class="form-group">
              <input type="text" class="form-control" id="InputName" name="htmlDescription" value="<?php echo $htmlDescription; ?>" placeholder="Tags" />        
              <label for="orderDate"><i class="icon-inbox"></i></label>
			  <div class="clearfix"><?php echo $error; ?></div>
			</div>
			<div class="form-group">			  
			  <input type="file" id="image" name="image" placeholder="File Input"  >
			  <label for="image"><i class="icon-cloud-upload"></i></label>
			  <p class="help-block"> </p>
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
	if ($_POST['productLine'])
	{
 
      
	 // get form data, making sure it is valid 
  
		$productLine = mysql_real_escape_string(htmlspecialchars($_POST['productLine']));
		$textDescription = mysql_real_escape_string(htmlspecialchars($_POST['textDescription']));
		$htmlDescription = mysql_real_escape_string(htmlspecialchars($_POST['htmlDescription']));
	 
		 // check to make sure both fields are entered
	 if ($productLine == '')
	 {
		 // generate error message
		 $error = 'ERROR: Please fill in all required fields!';

			// if either field is blank, display the form again
		 productlinesForm($productLine, $textDescription, $htmlDescription, $image, $error);
	 }else {
	    
	
	    $image = htmlspecialchars($_FILES['image']['tmp_name']);
        
	    if(!empty($image))
		  $image1 = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	 
		   // save the data to the database
			 mysql_query("UPDATE productlines SET textDescription='$textDescription', htmlDescription='$htmlDescription', image='$image1' WHERE productLine='$productLine'")
			  or die(mysql_error()); 
	 
 
	
	
?>	
			 <div class="jumbotron">
			  <h1>Successfully Updated!</h1>
			  <p> <?php echo '<div class="alert alert-success">'.$productlines.' was updated to the database </div>';?>  </p>
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
			  <p> <?php echo '<div class="alert alert-danger">Unable to find Product Line within the database </div>';?>  </p>
			</div>

<?php
  
 }
	
} else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['productLine']) && $_GET['productLine'] != '')
 {
	 // query db
	 $productLine = $_GET['productLine'];
	 $result = mysql_query("SELECT * FROM productlines WHERE productLine='$productLine'")
	 or die(mysql_error()); 
	 $row = mysql_fetch_array($result);
	 
	 // check that the 'id' matches up with a row in the database
	 if($row)
	 {
		 
		 // get data from db
		 $productLine = $row['productLine']; 
		 $textDescription = $row['textDescription']; 
		 $htmlDescription = $row['htmlDescription'];
		 $image = $row['image'];  
  
		 // show form	
		productlinesForm($productLine, $textDescription, $htmlDescription, $image, $error);
	 }
	 else
	 // if no match, display result
	 {
?>
	 
			<div class="jumbotron">
			  <h1>No Information!</h1>
			  <p> <?php echo '<div class="alert alert-danger">Unable to data within the database </div>';?>  </p>
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
			  <p> <?php echo '<div class="alert alert-danger">Unable to data within the database </div>';?>  </p>
			</div>

<?php

 } 
 
}
 
 
   // footer 
 include('footer.php');
?>