<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($first, $last, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>New Record</title>
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 
 <form action="" method="post">
 <div>
 <strong>First Name: *</strong> <input type="text" name="firstname" value="<?php echo $first; ?>" /><br/>
 <strong>Last Name: *</strong> <input type="text" name="lastname" value="<?php echo $last; ?>" /><br/>
 <p>* required</p>
 <input type="submit" name="submit" value="Submit">
 </div>
 </form> 
 </body>
 </html>
 <?php 
 }
 
 
 

 // connect to the database
 include('connect-db.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 $firstname = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));
 $lastname = mysql_real_escape_string(htmlspecialchars($_POST['lastname']));
 
 // check to make sure both fields are entered
 if ($firstname == '' || $lastname == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($firstname, $lastname, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT players SET firstname='$firstname', lastname='$lastname'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','');
 }
?>