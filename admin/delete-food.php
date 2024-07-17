<?php
//include constansts.php
include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //get the id and image name of food to be deleted
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name!=""){
        //image is available so remove it
        $path="../images/food/".$image_name;
        //remove the image
        $remove = unlink($path);

        //if failed to remove image then add a error message and stop the process
        if($remove == FALSE){
            //set session message
            $_SESSION['remove'] = "<div class='error'>Failed to remove food image</div>";
        
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-food.php');

            //stop the process
            die();

       }
   }

    //create sql query to delete category
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    //exectue the query
    $res = mysqli_query($conn,$sql);

    //check whether it is success or not
    if($res == TRUE){
       //success
       //echo "food deleted";

       //create session variable to display message
       $_SESSION['delete'] = "<div class='success'>Food delete successful</div>";
       //redirect to manage-food page
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else{
       //echo "food not deleted";
       //failed

        //create session variable to display message
        $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
        //redirect to manage-food page
        header('location:'.SITEURL.'admin/manage-food.php');

    }

}
else{
    //redirect to manage food page
    header('location:'.SITEURL.'admin/manage-food.php');

}

//redirect to manage-food page with message

?>