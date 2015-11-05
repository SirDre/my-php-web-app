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
  
   <div class="content">  	
           
 	<div class="row-fluid">
 
        <div class="row masonry-grid">

<?php	

 
$newFileName = "emp_names.csv"; 

$fpWrite = fopen("C:\\$newFileName", "w"); 

$nameStr = ""; 

while($record = mysql_fetch_object($result)) 
{ 
    $name = $record->empname; 
     
    $nameArray = explode(",",$name); 
     
    if(count($nameArray) > 1) 
    { 
            $nameTemp = ""; 
            for($i=0;$i < count($nameArray); $i++) 
            { 
                $nameTemp = $nameTemp . $nameArray[$i]; 
                 
                if($i != (count($nameArray) - 1)) 
                    $nameTemp = $nameTemp . "&sbquo;"; 
            } 
            $name = $nameTemp; 
    } 
     
    $nameStr = $nameStr.$name.","; 
} 


fwrite($fpWrite,$nameStr); 

echo "File operation has been completed successfully!<br><br>"; 
 
 
 
?>
		</div>
 
 

 </div>	
 
</div>
</div>