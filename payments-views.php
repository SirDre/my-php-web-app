<?php
/* 
	VIEW.PHP
	Displays all data from 'payments' table 
*/


    // header 
	 include('header.php');
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data

	 
	function clean_payments($str)
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
	elseif ($_GET['sort'] == 'checkNumber')
	{
		$sorter = "ORDER BY p.checkNumber";
	}
	elseif ($_GET['sort'] == 'paymentDate')
	{
		$sorter = "ORDER BY p.paymentDate";
	}
	elseif($_GET['sort'] == 'amount')
	{
		$sorter = "ORDER BY p.amount";
	}

 


	// number of results to show per page
	$per_page = 20;
	
	// figure out the total pages in the database
 
	
	$result = mysql_query("SELECT p.customerNumber, p.checkNumber, p.paymentDate, p.amount, u.customerNumber, u.customerName FROM payments p, customers u WHERE p.customerNumber = u.customerNumber $sorter");
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




<div id="payments" class="fixed-wrapper"><h1 class="affix">Payments</h1></div>
	<div class="container">

		<div class="content">
		  <div class="row">
 
    <ul class="nav nav-pills">
	   <li class="badge pull-right"><a href="payments-export.php">Export Records <i class="icon-cloud-download"></i></a></li>
	</ul>
    <!-- payments Section -->
 <div class="content">          
 	<div class="row-fluid">
	  <div class="col-md-12 col-sm-12 col-xs-12">
 
	
	
 
<?php   
	// pagination	
	echo " <ul class='pagination'> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
	   echo "<li><a href='payments-views.php?page=$i'>$i</a></li>";
	}
	echo "</ul> ";
?>



<table class='table table-condensed' > 
	 <thead> 			
	    <tr>
		  <th colspan="2">customer Name <a href="payments-views.php?sort=customerDesc" ><i class="icon-sort-down"></i></a> <a href="payments-views.php?sort=customerAsc" ><i class="icon-sort-up"></i></a></th> 
		  <th><a href="payments-views.php?sort=checkNumber" >checkNumber<i class="icon-sort"></i></a></th> 
		  <th><a href="payments-views.php?sort=paymentDate" >paymentDate<i class="icon-sort"></i></a></th> 
		  <th><a href="payments-views.php?sort=amount" >amount<i class="icon-sort"></i></a></th> 
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
		echo '<td colspan="2"><b> ' . clean_payments(mysql_result($result, $i, 'customerName')) . ' </b></td>';
		echo '<td>' . clean_payments(mysql_result($result, $i, 'checkNumber')) . '</td>';
		echo '<td>' . clean_payments(mysql_result($result, $i, 'paymentDate')) . '</td>'; 
		echo '<td>$' . clean_payments(mysql_result($result, $i, 'amount')) . '</td>';
		echo "</tr>"; 
	}
	
	echo "</tbody>"; 
	// close table>
	echo "</table>"; 
	
	// pagination	
	echo " <ul class='pagination'> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
	   echo "<li><a href='payments-views.php?page=$i'>$i</a></li>";
	}
	echo "</ul> ";
	
?>


 
				 </div> 
			 </div> 
		 </div> 
	
	
	 <ul class="nav nav-pills">
	 
	   <li class="badge pull-right"><a href="payments-export.php">Export Records <i class="icon-cloud-download"></i></a></li>
	</ul>
			 
		 
		 
 		 </div> 
	 </div> 
 </div> 
  
 
 