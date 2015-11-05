<?php
/* 
	VIEW.PHP
	Displays all data from 'orders' table 
*/


    // header 
	 include('header.php');
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data

	 
	function clean_orders($str)
	{
		 $str = @iconv('UTF-8', 'UTF-8//IGNORE', $str);
	 
		return $str;
	}
	
    // Sort by query results by each table header
	$sorter = "";

	if ($_GET['sort'] == 'customerDesc')
	{
		$sorter = "ORDER BY u.customerName DESC";
	}
	elseif ($_GET['sort'] == 'customerAsc')
	{
		$sorter = "ORDER BY u.customerName ASC";
	}
	elseif ($_GET['sort'] == 'status')
	{
		$sorter = "ORDER BY o.status";
	}
	elseif ($_GET['sort'] == 'order_Date')
	{
		$sorter = "ORDER BY o.orderDate";
	}
	elseif($_GET['sort'] == 'requiredDate')
	{
		$sorter = "ORDER BY o.requiredDate";
	}
	elseif($_GET['sort'] == 'shippedDate')
	{
		$sorter = "ORDER BY o.shippedDate";
	}
	elseif($_GET['sort'] == 'comments')
	{
		$sorter = "ORDER BY o.comments";
	}
 
	// number of results to show per page
	$per_page = 20;
	
	// figure out the total pages in the database
	$result = mysql_query("SELECT o.orderNumber, o.orderDate, o.requiredDate, o.shippedDate, o.status, o.comments, o.customerNumber, u.customerNumber, u.customerName FROM orders o, customers u WHERE o.customerNumber = u.customerNumber $sorter");
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


<div id="orders" class="fixed-wrapper"><h1 class="affix">Orders</h1></div>
	<div class="container">
 
		  
  
	<ul class="nav nav-pills">
	  <li class="active"><a href="orders-new.php">Add a new record</a></li>
	  <li class="badge pull-right"><a href="orders-export.php">Export Records <i class="icon-cloud-download"></i></a></li>
	</ul>
	
    <!-- orders Section -->
 <div class="content">          
 	<div class="row-fluid">
	  <div class="col-md-12 col-sm-12 col-xs-12">
 
	
	
 
<?php   
	// pagination	
	echo " <ul class='pagination'> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
	   echo "<li><a href='orders-views.php?page=$i&sort=customerDesc'>$i</a></li>";
	}
	echo "</ul> ";
?>

<table class='table table-striped' > 
	 <thead> 			
	    <tr>
		  <th colspan="2" ><a href="orders-views.php?sort=customerDesc" ><i class="icon-sort-down"></i></a> <a href="orders-views.php?sort=customerAsc" ><i class="icon-sort-up"></i></a> </th>
		  <th><a href="orders-views.php?sort=status" >status<i class="icon-sort"></i></a></th> 
		  <th><a href="orders-views.php?sort=order_Date" >order_Date<i class="icon-sort"></i></a></th> 
		  <th><a href="orders-views.php?sort=requiredDate" >requiredDate<i class="icon-sort"></i></a></th> 
		  <th><a href="orders-views.php?sort=shippedDate" >shippedDate<i class="icon-sort"></i></a></th>
		  <th><a href="orders-views.php?sort=comments" >comments<i class="icon-sort"></i></a></th>
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
		echo '<td colspan="11"><b> ' . clean_orders(mysql_result($result, $i, 'customerName')) . ' </b></td><td colspan="1">' . ' <a href="orders-del.php?orderNumber=' . mysql_result($result, $i, 'orderNumber') . '"><i class="icon-trash"></i></a></td>';
		echo '<tr>';
		echo '<td colspan="2"><a href="orders-edit.php?orderNumber=' . mysql_result($result, $i, 'orderNumber') . '"><i class="icon-pencil"></i></a> </td>';
		echo '<td >' . clean_orders(mysql_result($result, $i, 'status')) . '</td>';
		echo '<td > ' . clean_orders(mysql_result($result, $i, 'orderDate')) . '</td>'; 
		echo '<td>' . clean_orders(mysql_result($result, $i, 'requiredDate')) . '</td>'; 
		echo '<td>' . clean_orders(mysql_result($result, $i, 'shippedDate')) . '</td>';
		echo '<td>' . clean_orders(mysql_result($result, $i, 'comments')) . '</td>';	

		echo "</tr>"; 
	}
	
	echo "</tbody>"; 
	// close table>
	echo "</table>"; 
	
	// pagination	
	echo " <ul class='pagination'> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
	   echo "<li><a href='orders-views.php?page=$i'>$i</a></li>";
	}
	echo "</ul> ";
	
?>


 
				 </div> 
			 </div> 
		 </div> 
	
	
	<ul class="nav nav-pills">
	  <li class="active"><a href="orders-new.php">Add a new record</a></li>
	  <li class="badge pull-right"><a href="orders-export.php">Export Records <i class="icon-cloud-download"></i></a></li>
	</ul>
			 
		 
		 
 	 
 </div> 
  
 
 