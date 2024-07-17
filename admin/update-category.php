<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>update category</h1>
        <br>

        <?php 
        if(isset($_GET['id'])){
                //get id of selected admin
        $id = $_GET['id'];

        //create sql query to get details
        $sql = "SELECT * FROM tbl_category WHERE id=$id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whether it is executed or not
        if($res == TRUE){
            //check whether the data is available or not
            $count = mysqli_num_rows($res);
            //check whether we have admin data or not
            if($count == 1){
                //we will get details
                //echo "Category available";
                $row=mysqli_fetch_assoc($res);
                $id = $row['id'];
                $title = $row['title'];
                $current_image = $row['image_name'];
                $feature = $row['feature'];
                $active = $row['active'];
            }
            else{
                //redirect to manage category with message
                $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        }
        }
        else{
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="table-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title;?>">
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                    <?php 
                    if($current_image != ""){
                      //display image
                      ?>
                      <img src="<?php echo SITEURL?>images/category/<?php echo $current_image?>" width="150px">
                      <?php

                    }
                    else{
                        //display message
                        echo "<div class='error'>Image is not added</div>";
                    }
                    ?>
                </td>
            </tr>

            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Feature:</td>
                <td>
                    <input <?php if($feature == "Yes"){echo "checked";}?> type="radio" name="feature" id="feature_yes" value="Yes">
                    <label for="feature_yes">Yes</label>

                    <input <?php if($feature == "No"){echo "checked";}?> type="radio" name="feature" id="feature_no" value="No">
                    <label for="feature_no">No</label>
                    
                    
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active == "Yes"){echo "checked";}?> type="radio" name="active" id="active_yes" value="Yes">
                    <label for="active_yes">Yes</label>

                    <input <?php if($active == "No"){echo "checked";}?> type="radio" name="active" id="active_no" value="No">
                    <label for="active_no">No</label>

                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update Category" class="button button-secondary">

                </td>
            </tr>

        </table>

        </form>
    </div>
</div>

<?php 
//check whether submit button is clicked or not
if(isset($_POST['submit'])){
    //echo "submit clicked";
    //get all values from form to update
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $feature = $_POST['feature'];
    $active = $_POST['active'];

    //updating new image selected
    //check whether image is selected or not
    if(isset($_FILES['image']['name'])){
        //get image details
        $image_name = $_FILES['image']['name'];

        //check whether the image is available or not
        if($image_name != ""){
            //image available
            //upload the new image
            
            //rename the image
            //get the extenson of our image
            $ext = end(explode('.',$image_name));

             //rename the image
             $image_name = "food_category_".rand(000,999).'.'.$ext;

            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/category/".$image_name;

            //finally uplaod the image
            $upload = move_uploaded_file($source_path,$destination_path);

            //check whether the image is uploaded or not
            //if image is not uploaded we will stop the process and redirect with error message
            if($upload == FALSE){
                //set message
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                //redirect page to add category
                header("location:".SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }  

            //remove the current image
            if($current_image!=""){
                //image is available so remove it
                $remove_path="../images/category/".$current_image;
                //remove the image
                $remove = unlink($remove_path);
            
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
                
        }
        else{
            //image not available
            $image_name = $current_image;
        }
    }
    else{
        //image is not selected
        $image_name = $current_image;
    }


    //update the database
    $sql2 = "UPDATE tbl_category SET
    title='$title',
    image_name='$image_name',
    feature='$feature',
    active='$active'
    WHERE id='$id'
    ";

    //execute the query
    $res2 = mysqli_query($conn,$sql2);

    //check sucess
    if($res2 == TRUE){
        //updated successfully
        $_SESSION['update'] = "<div class='success'>Category updated successfully</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else{
        //failed to update
        $_SESSION['update'] = "<div class='error'>Failed to update category</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
}
?>


<?php  include('partials/footer.php'); ?>
