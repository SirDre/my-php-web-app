<?php
/* 
	VIEW.PHP
	Displays all data from 'offices' table 
*/


	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data

	 
	function clean_products($str)
	{
		 $str = @iconv('UTF-8', 'UTF-8//IGNORE', $str);
	 
		return $str;
	}
	
	// get results from database
	$result = mysql_query("SELECT * FROM productlines") 
		or die(mysql_error()); 
		
		// display data 
?>
		
	
<div id="productlines" class="fixed-wrapper"><h1 class="affix">Product Lines</h1></div>
  <div class="container">  
  
  	 <ul class="nav nav-pills"> 
	   <li class="badge pull-right"><a href="productlines-export.php">Export Records <i class="icon-cloud-download"></i></a></li>
	</ul>
	
   <div class="content">  	
           
 	<div class="row-fluid">
 
        <div class="row masonry-grid">

<?php	
	// loop through results of database query, displaying them in the table
	while($row = mysql_fetch_array( $result )) {
		
		// echo out the contents of each row into a table
        echo '<div class="col-md-4 col-sm-4 col-xs-12 item">';
        echo '<div class="item-wrapper block">';
		if(empty($row['image'])){
		 echo '  <img src="./assets/img/2011_mercedes-benz_icon.jpg" alt="product" class="img-thumbnail"> ';
		}else{
         echo '  <img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" alt="product" class="img-thumbnail"> ';
		}
        echo '      <div class="description block">';
        echo '         <h2>' . clean_products($row['productLine']) . '</h2>';
        echo '        <p>' . clean_products($row['textDescription']) . '</p>';
		echo '		<p><i>' . clean_products($row['htmlDescription']) . '</i></p>';
		echo '<a href="productlines-edit.php?productLine=' . trim($row['productLine']) . '"><i class="icon-pencil"></i></a> ';
        echo '     </div> 	'; 
        echo ' </div>';
  		echo ' </div>';
	} 
 
?>
		</div>
 
    </div>	
 
</div>

  	 <ul class="nav nav-pills"> 
	   <li class="badge pull-right"><a href="productlines-export.php">Export Records <i class="icon-cloud-download"></i></a></li>
	</ul>
</div>