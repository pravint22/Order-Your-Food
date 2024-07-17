<?php include('partials/menu.php') ?>

      <!-- main-content section starts -->
      <div class="main-content">
        <div class="wrapper">
          <h1>MANAGE ADMIN</h1>
          <br />

          <?php
              if(isset($_SESSION['add'])){
                echo $_SESSION['add']; //displaying seeion message
                unset($_SESSION['add']); //removing session message
              }

              if(isset($_SESSION['delete'])){
                echo $_SESSION['delete']; //displaying seeion message
                unset($_SESSION['delete']); //removing session message
              }

              if(isset($_SESSION['update'])){
                echo $_SESSION['update']; //displaying seeion message
                unset($_SESSION['update']); //removing session message
              }

              if(isset($_SESSION['user_not_found'])){
                echo $_SESSION['user_not_found']; //displaying seeion message
                unset($_SESSION['user_not_found']); //removing session message
              }

              if(isset($_SESSION['password_not_match'])){
                echo $_SESSION['password_not_match']; //displaying seeion message
                unset($_SESSION['password_not_match']); //removing session message
              }

              if(isset($_SESSION['change_password'])){
                echo $_SESSION['change_password']; //displaying seeion message
                unset($_SESSION['change_password']); //removing session message
              }
           ?>

           <br /> <br />

          <!-- button to add admin-->
          <a href="add-admin.php" class="button button-primary">Add Admin</a>


          <table class="table-full">
            <tr>
                <th>S.No</th>   
                <th>Full Name</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>
             
            <?php 
               // query to get all admin
               $sql = "SELECT * FROM tbl_admin";
               //execute the query
               $res = mysqli_query($conn, $sql);

               //check whether the query is executed or not
               if($res == TRUE){
                //count rows to check whether we have data in database or not
                $count = mysqli_num_rows($res); //function to get all rows in database

                $sn=1; //create a variable and assign the value



                //check num of rows
                if($count>0){
                    //we have data in data base
                    while($rows=mysqli_fetch_assoc($res)){
                        //using while loop to get all the data from database
                        //while loop will run as long as  we have data in dtabase

                        //get individual data
                        $id=$rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];

                        //display the vales in our table
                        ?>
                           <tr>
                                <td><?php echo $sn++;?></td>   
                                <td><?php echo $full_name;?></td>
                                <td><?php echo $username;?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="button button-primary">Change Password</a>
                                    <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="button button-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="button button-danger">Delete Admin</a>
                                </td>
                            </tr>
                        <?php
                    }
                }
                else{
                    //we do ont have data in database
                }
               }
            ?>

          </table>
              

        </div>
      </div>
      <!-- main-content section ends -->

<?php  include('partials/footer.php') ?>