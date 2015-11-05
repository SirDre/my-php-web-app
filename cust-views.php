<?php
/* 
	VIEW.PHP
	Displays all data from 'customers' table 
*/


    // header 
	 include('header.php');
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data

	 
	function clean_cust($str)
	{
		 $str = @iconv('UTF-8', 'UTF-8//IGNORE', $str);
	 
		return $str;
	}

	// Sort by query results by each table header
	$sorter = "";

	if ($_GET['sort'] == 'customerDesc')
	{
		$sorter = "ORDER BY customerName DESC";
	}
	elseif ($_GET['sort'] == 'customerAsc')
	{
		$sorter = "ORDER BY customerName ASC";
	}
	elseif ($_GET['sort'] == 'contact')
	{
		$sorter = "ORDER BY contactLastName";
	}
	elseif ($_GET['sort'] == 'phone')
	{
		$sorter = "ORDER BY phone";
	}
	elseif($_GET['sort'] == 'addressLine1')
	{
		$sorter = "ORDER BY addressLine1";
	}
	elseif($_GET['sort'] == 'addressLine2')
	{
		$sorter = "ORDER BY addressLine2";
	}		
	elseif($_GET['sort'] == 'city')
	{
		$sorter = "ORDER BY city";
	}
	elseif($_GET['sort'] == 'state')
	{
		$sorter = "ORDER BY state";
	}
	elseif($_GET['sort'] == 'postalCode')
	{
		$sorter = "ORDER BY postalCode";
	}	
	elseif($_GET['sort'] == 'country')
	{
		$sorter = "ORDER BY country";
	}
	elseif($_GET['sort'] == 'salesRepEmpNo')
	{
		$sorter = "ORDER BY salesRepEmployeeNumber";
	}
	elseif($_GET['sort'] == 'creditLimit')
	{
		$sorter = "ORDER BY creditLimit";
	}
 
		  
		  
	// number of results to show per page
	$per_page = 10;
	
	// figure out the total pages in the database
	$result = mysql_query("SELECT * FROM customers $sorter");
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


<div id="customers" class="fixed-wrapper"><h1 class="affix">Customers</h1></div>
	<div class="container">

		<div class="content">
		  <div class="row">
		  
		  
	<ul class="nav nav-pills">
	  <li class="active"><a href="cust-new.php">Add a new record</a></li>
	  <li class="badge pull-right"><a href="cust-export.php">Export Records <i class="icon-cloud-download"></i></a></a></li>
	</ul>  

    <!-- customers Section -->
 <div class="content">          
 	<div class="row-fluid">
	  <div class="col-md-12 col-sm-12 col-xs-12">
 
	
	
 
<?php   
	// pagination	
	echo " <ul class='pagination'> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
	   echo "<li><a href='cust-views.php?page=$i'>$i</a></li>";
	}
	echo "</ul> ";
?>

<table class='table table-striped' > 
	 <thead> 
	    <tr>
		  <th colspan="2"><a href="cust-views.php?sort=customerDesc" >&nbsp;<i class="icon-sort-down"></i></a> <a href="cust-views.php?sort=customerAsc" >&nbsp;<i class="icon-sort-up"></i></a></th>
		  <th><a href="cust-views.php?sort=contact" >contact<i class="icon-sort"></i></a></th> 
		  <th><a href="cust-views.php?sort=phone" >phone<i class="icon-sort"></i></a></th> 
		  <th><a href="cust-views.php?sort=addressLine1" >addressLine1<i class="icon-sort"></i></a></th>
		  <th><a href="cust-views.php?sort=addressLine2" >addressLine2<i class="icon-sort"></i></a></th> 
		  <th><a href="cust-views.php?sort=city" >city<i class="icon-sort"></i></a></th> 
		  <th><a href="cust-views.php?sort=state" >state<i class="icon-sort"></i></a></th> 
		  <th><a href="cust-views.php?sort=postalCode" >postalCode<i class="icon-sort"></i></a></th> 
		  <th><a href="cust-views.php?sort=country" >country<i class="icon-sort"></i></a></th>
		  <th><a href="cust-views.php?sort=salesRepEmpNo" >salesRepEmpNo<i class="icon-sort"></i></a></th>
		  <th><a href="cust-views.php?sort=creditLimit" >creditLimit<i class="icon-sort"></i></a></th>
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
		echo '<tr>'; 
		echo '<td colspan="11"><a href="orders-preview.php?orderNumber=' . mysql_result($result, $i, 'customerNumber') . '"><i class="icon-user"></i><b> ' . clean_cust(mysql_result($result, $i, 'customerName')) . '</b></a></td><td colspan="1">' . ' <a href="cust-del.php?customerNumber=' . mysql_result($result, $i, 'customerNumber') . '"><i class="icon-trash"></i></a></td>';
		echo '<tr>';
		echo '<td>&nbsp;</td>';
		echo '<td><a href="cust-edit.php?customerNumber=' . mysql_result($result, $i, 'customerNumber') . '"><i class="icon-pencil"></i></a> </td>';
		echo '<td>' . clean_cust(mysql_result($result, $i, 'contactLastName')) . ' ' . clean_cust(mysql_result($result, $i, 'contactFirstName')) . '</td>';
		echo '<td>' . clean_cust(mysql_result($result, $i, 'phone')) . '</td>';
		echo '<td>' . clean_cust(mysql_result($result, $i, 'addressLine1')) . '</td>';
		echo '<td>' . clean_cust(mysql_result($result, $i, 'addressLine2')) . '</td>';
		echo '<td>' . clean_cust(mysql_result($result, $i, 'city')) . '</td>';
		echo '<td>' . clean_cust(mysql_result($result, $i, 'state')) . '</td>';
		echo '<td>' . clean_cust(mysql_result($result, $i, 'postalCode')) . '</td>';
		echo '<td>' . clean_cust(mysql_result($result, $i, 'country')) . '</td>';
		echo '<td>' . clean_cust(mysql_result($result, $i, 'salesRepEmployeeNumber')) . '</td>';
		echo '<td>' . clean_cust(mysql_result($result, $i, 'creditLimit')) . '</td></tr>';

		echo "</tr>"; 
	}
	
	echo "</tbody>"; 
	// close table>
	echo "</table>"; 
	
	// pagination	
	echo " <ul class='pagination'> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
	   echo "<li><a href='cust-views.php?page=$i'>$i</a></li>";
	}
	echo "</ul> ";
	
?>


 
				 </div> 
			 </div> 
		 </div> 
	
	
	<ul class="nav nav-pills">
	  <li class="active"><a href="cust-new.php">Add a new record</a></li>
	   <li class="badge pull-right"><a href="cust-export.php">Export Records <i class="icon-cloud-download"></i></a></a></li>
	</ul>
			 
		 
		 
 		 </div> 
	 </div> 
 </div> 
 </div> 