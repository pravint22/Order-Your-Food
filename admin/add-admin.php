<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br />
         
        <?php 
         if(isset($_SESSION['add'])){ //checking whether the session is set or not
            echo $_SESSION['add'];  //display the session message if set
            unset($_SESSION['add']); // remove session message
         }
        ?>

    
        <form action="" method="POST">
            <table class="table-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="enter your name"></td>
                </tr>

                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="username" placeholder="enter your user name"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="enter your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="button-secondary">
                    </td>
                </tr>
            </table>


        </form>
    </div>

</div>
<?php  include('partials/footer.php') ?>

<?php 
   //process the value from form and save it in data base
   // check whether the submit button is clicked or not 

   if(isset($_POST['submit'])){
    // Button clicked
    //echo "Button Clicked";

    // get data from the form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //password encryption with md5

    //SQL query to save data into data base
    $sql="INSERT INTO tbl_admin SET 
    full_name='$full_name',
    username='$username',
    password='$password'
    ";

    // exectue query and svaing data into data base

     $res = mysqli_query($conn, $sql) or die(mysqli_error());

     // check whether the (Query is ececuted) data is inserted or not and display appropriate message
     if($res == TRUE){
        // data inserted
        //echo"data inserted";

        //create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        //redirect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');

     }
     else{
        // failed to insert data
        //echo"failed to insert data";

        //create a session variable to display message
        $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
        //redirect page to add admin
        header("location:".SITEURL.'admin/add-admin.php');
     }
   }
?>