<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>ADD CATEGORY</h1>
        <br />

        <?php 
         if(isset($_SESSION['add'])){ //checking whether the session is set or not
            echo $_SESSION['add'];  //display the session message if set
            unset($_SESSION['add']); // remove session message
         }

         if(isset($_SESSION['upload'])){ //checking whether the session is set or not
            echo $_SESSION['upload'];  //display the session message if set
            unset($_SESSION['upload']); // remove session message
         }
        ?>

        <!-- add category starts-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="category title"></td>
                </tr>

                <tr>
                    <td>Select image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Feature:</td>
                    <td>
                        <input type="radio" name="feature" value="Yes">Yes
                        <input type="radio" name="feature" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="button-secondary">
                    </td>
                </tr>
            </table>


        </form>
        <!--add category ends-->


    </div>

</div> 

<?php include('partials/footer.php'); ?>

<?php 
   //process the value from form and save it in data base
   // check whether the submit button is clicked or not 

   if(isset($_POST['submit'])){
    // Button clicked
    //echo "Button Clicked";

    // get data from the form
    $title = $_POST['title'];

    //for radio input we need tp check whether the button is clicked or not
    if(isset($_POST['feature'])){
        //get value from form
        $feature = $_POST['feature'];
    }
    else{
        //set default form
        $feature = "No";
    }

    if(isset($_POST['active'])){
        //get value from form
        $active = $_POST['active'];
    }
    else{
        //set default form
        $active = "No";
    }

    //check whether the image is selected or not and set the value for image accordingly
    //print_r($_FILES['image']);

    //die(); //break code here
    if(isset($_FILES['image']['name'])){
        //upload the image
        //to upload image we need to set destination path
        $image_name=$_FILES['image']['name'];

        //upload the image only if image is selected
        if($image_name != ""){
    
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
            header("location:".SITEURL.'admin/add-category.php');
            //stop the process
            die();
        }    
        }

    }
    else{
        //dont upload image and set image value as blank
        $image_name = "";
    }
    

    //SQL query to save data into data base
    $sql="INSERT INTO tbl_category SET 
    title='$title',
    image_name='$image_name',
    feature='$feature',
    active='$active'
    ";

    // exectue query and svaing data into data base

     $res = mysqli_query($conn, $sql);

     // check whether the (Query is ececuted) data is inserted or not and display appropriate message
     if($res == TRUE){
        // data inserted
        //echo"data inserted";

        //create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
        //redirect page to manage admin
        header("location:".SITEURL.'admin/manage-category.php');

     }
     else{
        // failed to insert data
        //echo"failed to insert data";

        //create a session variable to display message
        $_SESSION['add'] = "<div class='error'>Failed to add category</div>";
        //redirect page to add category
        header("location:".SITEURL.'admin/add-category.php');
     }


   }

   
?>