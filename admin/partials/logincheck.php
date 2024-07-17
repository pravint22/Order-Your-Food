<?php 

 //check whether the user is logged in or not cause without the user login nothing should open 
 if(!isset($_SESSION['user'])){ //if user is not logged in

    //redirect to login page with message
    $_SESSION['no_login_message'] = "<div class='error'>Please login to acess</div>";
    //redirect to login page
    header('location:'.SITEURL.'admin/login.php');
 }

 ?>