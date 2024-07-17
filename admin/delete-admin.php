<?php
//include constansts.php
include('../config/constants.php');

//get the id of admin to be deleted
$id = $_GET['id'];

//create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

 //exectue the query
 $res = mysqli_query($conn,$sql);

 //check whether it is success or not
 if($res == TRUE){
    //success
    //echo "admin deleted";

    //create session variable to display message
    $_SESSION['delete'] = "<div class='success'>Admin delete successful</div>";
    //redirect to manage-admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
 }
 else{
    //echo "admin not deleted";
    //failed

    //create session variable to display message
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";
    //redirect to manage-admin page
    header('location:'.SITEURL.'admin/manage-admin.php');

 }



?>