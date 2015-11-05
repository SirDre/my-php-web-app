<?php
    
/* 
	INDEX.PHP
	Displays HTML 
*/


    // header 
	 include('header.php');
	// connect to the database
 
?>
  

<!-- Home Section -->
    <div id="home" class="section">
      <div class="container">
	     <div id="carousel-example-generic" class="carousel " >
	 
			<div class="jumbotron">
			  <h1>My PHP App!</h1>
			  <p>A web app that works with your mysql database.</p> 
		
			</div>
			
		<div class="bs-callout bs-callout-info">
		  <h3><b>Create a web app to perform the following functions:</b></h3>	
          <ul>
			<li>Add this to your MySQL server</li> 
			<li>Create a webpage entitled “My PHP App”</li>
		   </ul>		  
		  <ul>
			<li>Retrieve and display the contents of the database relative to each other (eg, if the &lsquo;Customer&rsquo; display is selected, I should be able to view the orders that each customer made)</li>
			<li>Add records to the database (eg. Add an order for a pre-existing customer or add a new customer)</li>
			<li>Sort the database by whichever criteria is selected (First Name, Last Name, Total amount of money spent)</li>
			<li>Export records to a spreadsheet. (this is optional, but recommended).</li>
		  </ul>
		  <ul>
			<li>Format the web page and the app to be aesthetically pleasing using CSS.</li> 
			<li>Time is a factor, so submit as soon as you are done.</li>
		   </ul>
   
		</div>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p><a class="btn btn-primary btn-lg" href="http://www.876synergy.com" role="button">Learn more</a></p>
       </div> 
      </div>
    </div><!-- /.container -->


  <!-- Customers Section -->
    <div id="customers" class="section">

             <?php
			   
			  include('cust-views.php');
			 ?>
 
 
 
    </div><!-- /.container -->

	<!-- Employees Section -->
    <div id="employees" class="section">
 
             <?php
			   
			  include('emp-views.php');
			 ?>
  
    </div><!-- /.container -->
	
	<!-- Offices Section -->
    <div id="offices" class="section">
 
             <?php
			   
			  include('office-views.php');
			 ?>
  
    </div><!-- /.container -->
	
	<!-- Orderdetails Section -->
    <div id="orderdetails" class="section">
 
             <?php
			   
			  include('order-info-views.php');
			 ?>
  
    </div><!-- /.container -->
	
	<!-- Orders Section -->
    <div id="orders" class="section">
 
             <?php
			   
			  include('orders-views.php');
			 ?>
  
    </div><!-- /.container -->
	
	<!-- Payments Section -->
    <div id="payments" class="section">
 
             <?php
			   
			  include('payments-views.php');
			 ?>
  
    </div><!-- /.container -->
	
	<!-- productlines Section -->
    <div id="productlines" class="section">
 
             <?php
			   
			  include('productlines-views.php');
			 ?>
  
    </div><!-- /.container -->

	<!-- products Section -->
    <div id="products" class="section">
 
             <?php
			   
			  include('products-views.php');
			 ?>
  
    </div><!-- /.container -->
	
 

<?php
 
    // header 
	 include('footer.php');
?>