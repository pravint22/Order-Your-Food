<?php include('partials_front/menu.php') ?>


    <!-- categories starts-->
     
    <section class="categories">
        <div class="container">
            <h2 class="text-centre">Categories</h2>

            <?php
               //create sql query to display categories from database
               $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

               //execute the query
               $res = mysqli_query($conn, $sql);
 
               //count rows to check whether rows are available or not
               $count = mysqli_num_rows($res);

               if($count>0){
                //categories available
                while($row = mysqli_fetch_assoc($res)){
                    //get the values like title ,id,image name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                     
                     <a href="<?php echo SITEURL;?>inside-catergories.php?category_id=<?php echo $id;?>">
                        <div class="boxes float-container">
                            <?php

                                //check whether image is available or not
                                if($image_name == ""){
                                    //display message
                                    echo "<div class='error'>Image not available</div>";
                                }
                                else{
                                    //image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name?>" alt="Biryani" class="img-responsive img-curve">
                                     <?php

                                }
                            ?>

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                     </a>
            
                    <?php

                }

               }
               else{
                //categories not available
                echo "<div class='error text-centre'>CATEGORY NOT ADDED</div>";

               }

            ?>

           
            <div class="clear-fix"></div>

        </div>
    </section>
    <!-- categories ends-->