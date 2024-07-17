<?php include('../config/constants.php');?>

<html>
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-centre">login</h1>
            <br>

            <?php
               if(isset($_SESSION['login'])){
                echo $_SESSION['login']; //displaying seeion message
                unset($_SESSION['login']); //removing session message
              }

              if(isset($_SESSION['no_login_message'])){
                echo $_SESSION['no_login_message']; //displaying seeion message
                unset($_SESSION['no_login_message']); //removing session message
              }


             ?>
             <br>

            <!-- login page starts here-->
            <form action="" method="POST">
                Username:
                <input type="text" name="username" placeholder="enter username">
                <br> <br>
                Password:
                <input type="password" name="password" placeholder="enter password">
                <br><br>

                <input type="submit" name="submit" value="login" class="button button-secondary">


            </form>

            <!-- login page ends here-->
            <br>

            <p class="text-centre">Created By <a href="#">Shanwitha</a></p>
        </div>
    </body>
</html>

<?php
//check whether submit is clicked or not
if(isset($_POST['submit'])){
    //proceed for login
   //get data from login form
   //$username = $_POST['username'];
   $username = mysqli_real_escape_string($conn,$_POST['username']);
   //$password = md5($_POST['password']);
   $password = mysqli_real_escape_string($conn,md5($_POST['password']));

   //check whether user name and password exists or not
   $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

   //execute the query
   $res = mysqli_query($conn,$sql);

   //count rows to check whether the user exists or not
   $count = mysqli_num_rows($res);

   if($count == 1){
      //user available and login success
      $_SESSION['login'] = "<div class='success'>Login Successful</div>";
      $_SESSION['user'] = $username; //to check whether user is logged in or not and log out will unset it
      //redirect to home page
      header('location:'.SITEURL.'admin/');
   }
   else{
    //user not available or login failed
    $_SESSION['login'] = "<div class='error'>Username or password is wrong</div>";
    //redirect to login page
    header('location:'.SITEURL.'admin/login.php');

   }


}

?>