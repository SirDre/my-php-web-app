<?php
/* 
	VIEW.PHP
	Displays all data from 'orders info' table 
*/


    // header 
	 include('header.php');
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data

	 
	function clean_ordersinfo($str)
	{
		 $str = @iconv('UTF-8', 'UTF-8//IGNORE', $str);
	 
		return $str;
	}
	// number of results to show per page
	$per_page = 100;
	
	// figure out the total pages in the database
	$result = mysql_query("SELECT o.orderNumber, o.productCode, o.quantityOrdered, o.priceEach, o.orderLineNumber, p.productCode, p.productName FROM orderdetails o, products p WHERE o.productCode = p.productCode");
	$total_results = mysql_num_rows($result);
	$total_pages = ceil($total_results / $per_page);

	// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
	if (isset($_GET['page']) && is_numeric($_GET['page']))
	{
		$show_page = $_GET['page'];
		
		// make sure the $show_page value is valid
		if ($show_page > 0 && $show_page <= $total_pages)
		{
			$start = ($show_page -1) * $per_page;
			$end = $start + $per_page; 
		}
		else
		{
			// error - show first set of results
			$start = 0;
			$end = $per_page; 
		}		
	}
	else
	{
		// if page isn't set, show first set of results
		$start = 0;
		$end = $per_page; 
	}
?>


<div id="orderdetails" class="fixed-wrapper"><h1 class="affix">Order Details</h1></div>
	<div class="container">

		<div class="content">
		  <div class="row">
		  
	<ul class="nav nav-pills"> 
	  <li class="badge pull-right"><a href="order-info-export.php">Export Records <i class="icon-cloud-download"></i></a></li>
	</ul>
    <!-- offices Section -->
 <div class="content">          
 	<div class="row-fluid">
	  <div class="col-md-12 col-sm-12 col-xs-12">
 
	
	
 
<?php   
	// pagination	
	echo " <ul class='pagination'> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
	   echo "<li><a href='order-info-views.php?page=$i'>$i</a></li>";
	}
	echo "</ul> ";
	
	
?>

<table class='table table-condensed' > 
	 <thead> 			
	    <tr>
		  <th>orderNumber</th>
		  <th>productCode</th> 
		  <th>quantityOrdered</th> 
		  <th>priceEach</th> 
		  <th>orderLineNumber</th> 
		</tr>
	</thead> 
    <tbody>

<?php	
 			

 
     // display data in table
	// loop through results of database query, displaying them in the table	
	for ($i = $start; $i < $end; $i++)
	{
		// make sure that PHP doesn't try to show results that don't exist
		if ($i == $total_results) { break; } 			
		// echo out the contents of each row into a table
		echo "<tr>"; 
		echo '<td>' . clean_ordersinfo(mysql_result($result, $i, 'orderNumber')) . '</td>';
		echo '<td>' . clean_ordersinfo(mysql_result($result, $i, 'productName')) . '</td>';
		echo '<td>' . clean_ordersinfo(mysql_result($result, $i, 'quantityOrdered')) . '</td>'; 
		echo '<td>$' . clean_ordersinfo(mysql_result($result, $i, 'priceEach')) . '</td>';
		echo '<td>' . clean_ordersinfo(mysql_result($result, $i, 'orderLineNumber')) . '</td>';

		echo "</tr>"; 
	}
	
	echo "</tbody>"; 
	// close table>
	echo "</table>"; 
	
	// pagination	
	echo " <ul class='pagination'> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
	   echo "<li><a href='order-info-views.php?page=$i'>$i</a></li>";
	}
	echo "</ul> ";
	
?>


 
				 </div> 
			 </div> 
		 </div> 
	

			 
	<ul class="nav nav-pills"> 
	  <li class="badge pull-right"><a href="order-info-export.php">Export Records <i class="icon-cloud-download"></i></a></li>
	</ul> 
		 
 		 </div> 
	 </div> 
 </div> 

 
 