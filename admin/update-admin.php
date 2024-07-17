<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>update admin</h1>
        <br>

        <?php 
        //get id of selected admin
        $id = $_GET['id'];

        //create sql query to get details
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whether it is executed or not
        if($res == TRUE){
            //check whether the data is available or not
            $count = mysqli_num_rows($res);
            //check whether we have admin data or not
            if($count == 1){
                //we will get details
                echo "Admin available";
                $row=mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            }
            else{
                //redirect to manage admin
                header('location:'.SITEURL.'admin/manage-admin.php');
            }


        }
        else{

        }
        ?>

        <form action="" method="POST">

        <table class="table-30">
            <tr>
                <td>Full Name:</td>
                <td>
                    <input type="text" name="full_name" value="<?php echo $full_name;?>">
                </td>
            </tr>

            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" value="<?php echo $username;?>">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update Admin" class="button button-secondary">

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
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //create sql query
    $sql = "UPDATE tbl_admin SET
    full_name = '$full_name',
    username = '$username'
    WHERE id='$id'
    ";

    //execute the query
    $res = mysqli_query($conn,$sql);

    //check sucess
    if($res == TRUE){
        //updated successfully
        $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        //failed to update
        $_SESSION['update'] = "<div class='error'>Failed to update admin</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}
?>


<?php  include('partials/footer.php'); ?>
