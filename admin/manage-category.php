<?php include('partials/menu.php'); ?>

<div class="main-content">
<div class="wrapper">
          <h1>MANAGE CATEGORY</h1>
          <br />

          <?php 
         if(isset($_SESSION['add'])){ //checking whether the session is set or not
            echo $_SESSION['add'];  //display the session message if set
            unset($_SESSION['add']); // remove session message
         }

        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete']; //displaying seeion message
            unset($_SESSION['delete']); //removing session message
        }

        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove']; //displaying seeion message
            unset($_SESSION['remove']); //removing session message
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update']; //displaying seeion message
            unset($_SESSION['update']); //removing session message
        }

        if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found']; //displaying seeion message
            unset($_SESSION['no-category-found']); //removing session message
        }

        if(isset($_SESSION['upload'])){ //checking whether the session is set or not
            echo $_SESSION['upload'];  //display the session message if set
            unset($_SESSION['upload']); // remove session message
         }
         
        ?>
        <br>

<!-- button to add admin-->
<a href="add-category.php" class="button button-primary">Add category</a>


<table class="table-full">
  <tr>
      <th>S.No</th>   
      <th>Title</th>
      <th>Image</th>
      <th>Feature</th>
      <th>Active</th>
      <th>Actions</th>
  </tr>

  <?php 
               // query to get all category
               $sql = "SELECT * FROM tbl_category";
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
                        $title=$rows['title'];
                        $image_name=$rows['image_name'];
                        $feature=$rows['feature'];
                        $active=$rows['active'];

                        //display the vales in our table
                        ?>
                            <tr>
                                <td><?php echo $sn++;?></td>   
                                <td><?php echo $title;?></td>

                                <td>
                                    <?php
                                       //check whether image name is available or not
                                       if($image_name!=""){
                                        //display the image
                                        ?>

                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="150px">

                                        <?php

                                       } 
                                       else{
                                        //display the message
                                        echo "<div class='error'>Image not Available</div>";
                                       }
                                    ?>
                                </td>

                                <td><?php echo $feature;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="button button-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="button button-danger">Delete category</a>
                                </td>
                             </tr>
                        <?php
                    }
                }
                else{
                    //we do ont have data in database
                    //we will display message inside table
                    ?>
                    <tr>
                        <td colspan="6"><div class="error">No Category Added</div></td>
                    </tr>
                    <?php
                }
               }
            ?>

</table>
     

 </div>

</div> 

<?php include('partials/footer.php'); ?>