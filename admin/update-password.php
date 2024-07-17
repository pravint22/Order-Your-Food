<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>update password</h1>
        <br>

        <?php 
        //get id of selected admin
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        ?>
        
        <form action="" method="POST">

        <table class="table-30">
            <tr>
                <td>Old Password:</td>
                <td>
                    <input type="password" name="old_password" placeholder="old password">
                </td>
            </tr>

            <tr>
                <td>New password:</td>
                <td>
                    <input type="password" name="new_password" placeholder="new password">
                </td>
            </tr>

            <tr>
                <td>Confirm password:</td>
                <td>
                    <input type="password" name="confirm_password" placeholder="confirm password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Change Password" class="button button-primary">

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
    //get data from form to update
    $id = $_POST['id'];
    $old_password = md5($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //check whether the user exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$old_password'";

     //execute the query
    $res = mysqli_query($conn,$sql);


    if($res == TRUE){

        $count = mysqli_num_rows($res);
            //check whether we have admin data or not
            if($count == 1){
                //echo "user found";

                //check whether the new password and admin password are same
                if($new_password == $confirm_password){
                    $sql2 = "UPDATE tbl_admin SET
                            password = '$new_password'
                            where id='$id'
                            ";
                    $res2 = mysqli_query($conn,$sql2);
                    if($res2 == TRUE){
                        $_SESSION['change_password']="<div class='success'>password is updated</div>";

                    //redirect to manage admin
                    header('location:'.SITEURL.'admin/manage-admin.php');

                    } 
                    else{
                        $_SESSION['change_password']="<div class='error'>failed to update password</div>";

                    //redirect to manage admin
                    header('location:'.SITEURL.'admin/manage-admin.php');

                    }      

                }
                else{
                    $_SESSION['password_not_match']="<div class='error'>passwords did not match</div>";

                    //redirect to manage admin
                    header('location:'.SITEURL.'admin/manage-admin.php');

                }
            }
            else{
                $_SESSION['user_not_found']="<div class='error'>User Not Found</div>";

                //redirect to manage admin
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
    }
}
?>


<?php  include('partials/footer.php'); ?>
