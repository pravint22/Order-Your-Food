<!-- <?php 
 //start session
 session_start();
 
 //create constants to store non repeating values
 define('SITEURL','http://localhost/restuarent/');
 define('LOCALHOST','localhost');
 define('DB_USERNAME','root');
 define('DB_PASSWORD','');
 define('DB_NAME','restuarent');

  $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); // database connection
  $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); // selecting data base
?> -->

<?php 
 // Start session
 session_start();
 
 // Create constants to store non-repeating values
 define('SITEURL','http://localhost/restuarent/');
 define('LOCALHOST','localhost');
 define('DB_USERNAME','root');
 define('DB_PASSWORD','');
 define('DB_NAME','restuarent');

 // Database connection
 $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }

 // Selecting database
 $db_select = mysqli_select_db($conn, DB_NAME);

 if (!$db_select) {
     die("Database selection failed: " . mysqli_error($conn));
 }
?>
