<?php
/* 
	VIEW.PHP
	Displays all data from 'employees' table 
*/


    // header 
	 include('header.php');
	// connect to the database
	 include('linkupdb.php'); 
	//display clean utf8 data

	 
	function clean_emp($str)
	{
		 $str = @iconv('UTF-8', 'UTF-8//IGNORE', $str);
	 
		return $str;
	}
	
	// Sort by query results by each table header
	$sorter = "";

	if ($_GET['sort'] == 'employeesDesc')
	{
		$sorter = "ORDER BY lastName DESC";
	}
	elseif ($_GET['sort'] == 'employeesAsc')
	{
		$sorter = "ORDER BY lastName ASC";
	}
	elseif ($_GET['sort'] == 'extension')
	{
		$sorter = "ORDER BY extension";
	}
	elseif ($_GET['sort'] == 'email')
	{
		$sorter = "ORDER BY phone";
	}
	elseif ($_GET['sort'] == 'officeCode')
	{
		$sorter = "ORDER BY e.officeCode";
	}
	elseif ($_GET['sort'] == 'reportsTo')
	{
		$sorter = "ORDER BY reportsTo";
	}
	elseif ($_GET['sort'] == 'jobTitle')
	{
		$sorter = "ORDER BY jobTitle";
	}
	// number of results to show per page
	$per_page = 10;
	
	// figure out the total pages in the database
	$result = mysql_query("SELECT e.employeeNumber, e.lastName, e.firstName, e.extension, e.email, e.officeCode, e.reportsTo, e.jobTitle, o.officeCode, o.city, o.country FROM employees e, offices o WHERE o.officeCode = e.officeCode $sorter");
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


<div class="fixed-wrapper"><h1 class="affix">Employees</h1></div>
	<div class="container">

		<div class="content">
		  <div class="row">
		  
		  
	<ul class="nav nav-pills">
	  <li class="active"><a href="emp-new.php">Add a new record</a></li>
	 <li class="badge pull-right"><a href="emp-export.php">Export Records <i class="icon-cloud-download"></i></a></li>
	</ul>  

    <!-- Employees Section -->
 <div class="content">          
 	<div class="row-fluid">
	  <div class="col-md-12 col-sm-12 col-xs-12">
 
	
	
 
<?php   
	// pagination	
	echo " <ul class='pagination'> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
	   echo "<li><a href='emp-views.php?page=$i'>$i</a></li>";
	}
	echo "</ul> ";
?>

<table class='table table-striped' > 
	 <thead> 			
	    <tr>
		  <th colspan="2"><a href="emp-views.php?sort=employeesDesc" >&nbsp;<i class="icon-sort-down"></i></a> <a href="emp-views.php?sort=employeesAsc" >&nbsp;<i class="icon-sort-up"></i></a></th>
		  <th><a href="emp-views.php?sort=extension" >extension<i class="icon-sort"></i></a></th> 
		  <th><a href="emp-views.php?sort=email" >email<i class="icon-sort"></i></a></th> 
		  <th><a href="emp-views.php?sort=officeCode" >officeCode<i class="icon-sort"></i></a></th>
		  <th><a href="emp-views.php?sort=reportsTo" >reportsTo<i class="icon-sort"></i></a></th> 
		  <th><a href="emp-views.php?sort=jobTitle" >jobTitle<i class="icon-sort"></i></a></th> 
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
		echo '<td colspan="11"><b> ' . clean_emp(mysql_result($result, $i, 'lastName')) . '  ' . clean_emp(mysql_result($result, $i, 'firstName')) . '</b></td><td colspan="1">' . ' <a href="emp-del.php?employeeNumber=' . mysql_result($result, $i, 'employeeNumber') . '"><i class="icon-trash"></i></a></td>';
		echo '<tr>';
		echo '<td colspan="2"><a href="emp-edit.php?employeeNumber=' . mysql_result($result, $i, 'employeeNumber') . '"><i class="icon-pencil"></i></a> </td>';
		echo '<td>' . clean_emp(mysql_result($result, $i, 'extension')) . '</td>';
		echo '<td>' . clean_emp(mysql_result($result, $i, 'email')) . '</td>';
		echo '<td><a href="office-edit.php?officeCode='.mysql_result($result, $i, 'officeCode').'"><i class="icon-building"></i>' . clean_emp(mysql_result($result, $i, 'officeCode')) . '</a></td>';
		echo '<td><a href="emp-preview.php?employeeNumber='.mysql_result($result, $i, 'reportsTo').'"><i class="icon-user"></i>' . clean_emp(mysql_result($result, $i, 'reportsTo')) . '</a></td>';
		echo '<td>' . clean_emp(mysql_result($result, $i, 'jobTitle')) . '</td></tr>';

		echo "</tr>"; 
	}
	
	echo "</tbody>"; 
	// close table>
	echo "</table>"; 
	
	// pagination	
	echo " <ul class='pagination'> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
	   echo "<li><a href='emp-views.php?page=$i'>$i</a></li>";
	}
	echo "</ul> ";
	
?>


 
				 </div> 
			 </div> 
		 </div> 
	
	
	<ul class="nav nav-pills">
	  <li class="active"><a href="emp-new.php">Add a new record</a></li>
	   <li class="badge pull-right"><a href="emp-export.php">Export Records <i class="icon-cloud-download"></i></a></li>
	</ul>
			 
		 
		 
 		 </div> 
	 </div> 
 </div> 
 </div> 