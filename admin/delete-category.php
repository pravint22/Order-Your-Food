<?php
//include constansts.php
include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //get the id and image name of category to be deleted
$id = $_GET['id'];
$image_name = $_GET['image_name'];

if($image_name!=""){
    //image is available so remove it
    $path="../images/category/".$image_name;
    //remove the image
    $remove = unlink($path);

    //if failed to remove image then add a error message and stop the process
    if($remove == FALSE){
        //set session message
        $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";
        
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');

        //stop the process
        die();

    }
}

//create sql query to delete category
$sql = "DELETE FROM tbl_category WHERE id=$id";

 //exectue the query
 $res = mysqli_query($conn,$sql);

 //check whether it is success or not
 if($res == TRUE){
    //success
    //echo "category deleted";

    //create session variable to display message
    $_SESSION['delete'] = "<div class='success'>Category delete successful</div>";
    //redirect to manage-category page
    header('location:'.SITEURL.'admin/manage-category.php');
 }
 else{
    //echo "category not deleted";
    //failed

    //create session variable to display message
    $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";
    //redirect to manage-category page
    header('location:'.SITEURL.'admin/manage-category.php');

 }

}
else{
    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage-category.php');

}


?>