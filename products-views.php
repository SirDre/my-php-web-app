<?php
/* 
	VIEW.PHP
	Displays all data from 'products' table 
*/


    // header 
	 include('header.php');
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data

	 
	function clean_productsinfo($str)
	{
		 $str = @iconv('UTF-8', 'UTF-8//IGNORE', $str);
	 
		return $str;
	}
	// number of results to show per page
	$per_page = 10;
	
	// figure out the total pages in the database
	$result = mysql_query("SELECT * FROM products");
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


<div id="products" class="fixed-wrapper"><h1 class="affix">Products</h1></div>
	<div class="container">

		<div class="content">
		  <div class="row">
 
	 <ul class="nav nav-pills">
	  <li class="active"><a href="products-new.php">Add a new record</a></li>
	   <li class="badge pull-right"><a href="products-export.php">Export Records <i class="icon-cloud-download"></i></a></li>
	</ul>
    <!-- products Section -->
 <div class="content">          
 	<div class="row-fluid">
	  <div class="col-md-12 col-sm-12 col-xs-12">
 
	
	
 
<?php   
	// pagination	
	echo " <ul class='pagination'> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
	   echo "<li><a href='products-views.php?page=$i'>$i</a></li>";
	}
	echo "</ul> ";
?>

<table class='table table-striped' > 
	 <thead> 
	    <tr>
		  <th>&nbsp;</th>
		  <th>productLine</th> 
		  <th>productScale</th> 
		  <th>productVendor</th>
		  <th>productDescription</th> 
		  <th>quantityInStock</th> 
		  <th>buyPrice</th> 
		  <th>MSRP</th>  
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
		echo '<td colspan="11"><b> ' . clean_productsinfo(mysql_result($result, $i, 'productName')) . '</b></td><td colspan="1">' . ' <a href="products-del.php?productCode=' . mysql_result($result, $i, 'productCode') . '"><i class="icon-trash"></i></a></td>';
		echo '<tr>';
		echo '<td><a href="products-edit.php?productCode=' . mysql_result($result, $i, 'productCode') . '"><i class="icon-pencil"></i></a> </td>';
		echo '<td>' . clean_productsinfo(mysql_result($result, $i, 'productLine')) . ' </td>';
		echo '<td>' . clean_productsinfo(mysql_result($result, $i, 'productScale')) . '</td>';
		echo '<td>' . clean_productsinfo(mysql_result($result, $i, 'productVendor')) . '</td>';
		echo '<td>' . clean_productsinfo(mysql_result($result, $i, 'productDescription')) . '</td>';
		echo '<td>' . clean_productsinfo(mysql_result($result, $i, 'quantityInStock')) . '</td>';
		echo '<td>$' . clean_productsinfo(mysql_result($result, $i, 'buyPrice')) . '</td>';
		echo '<td>' . clean_productsinfo(mysql_result($result, $i, 'MSRP')) . '</td></tr>';

		echo "</tr>"; 
	}
	
	echo "</tbody>"; 
	// close table>
	echo "</table>"; 
	
	// pagination	
	echo " <ul class='pagination'> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
	   echo "<li><a href='products-views.php?page=$i'>$i</a></li>";
	}
	echo "</ul> ";
	
?>


 
				 </div> 
			 </div> 
		 </div> 
	
	
	 <ul class="nav nav-pills">
	  <li class="active"><a href="products-new.php">Add a new record</a></li>
	   <li class="badge pull-right"><a href="products-export.php">Export Records <i class="icon-cloud-download"></i></a></li>
	</ul> 
		 
		 
 		 </div> 
	 </div> 
 </div> 
 