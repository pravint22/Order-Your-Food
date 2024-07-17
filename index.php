<?php include('partials_front/menu.php') ?>

    <!-- foodsearch starts-->
    <section class="food-search text-centre">
        <div class="container">
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food" required>
                <input type="submit" name="submit" placeholder="search" class="button button-primary">
            </form>
            
        </div>

    </section>
    <!--foodsearch ends-->

    <?php
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?>

    <!-- categories starts-->
    <section class="categories">
        <div class="container">
            <h2 class="text-centre">Categories</h2>

            <?php
               //create sql query to display categories from database
               $sql = "SELECT * FROM tbl_category WHERE feature = 'Yes' AND active = 'Yes' LIMIT 3";

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
  

    <!-- food menu starts-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-centre">Explore Foods</h2>
             
            <?php
               //create sql query to display categories from database
               $sql2 = "SELECT * FROM tbl_food WHERE feature = 'Yes' AND active = 'Yes' LIMIT 6";

               //execute the query
               $res2 = mysqli_query($conn, $sql2);
 
               //count rows to check whether rows are available or not
               $count = mysqli_num_rows($res2);

               if($count>0){
                //foods available
                while($row = mysqli_fetch_assoc($res2)){
                    //get the values like title ,id,image name
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                     
                     <div class="food-menu-box ">
                         <div class="food-menu-img">

                         <?php

                            //check whether image is available or not
                            if($image_name == ""){
                              //display message
                              echo "<div class='error'>Image not available</div>";
                            }
                            else{
                                  //image available
                         ?>
                               <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name?>" alt="Biryani" class="img-responsive img-curve">
                         <?php

                            }
                         ?>

                         </div>
                         <div class="menu-description">
                              <h4><?php echo $title;?></h4>
                              <p class="food-price"><?php echo $price;?></p>
                              <p class="food-description">
                                    <?php echo $description;?>
                             </p>
                              <br>
                              <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="button button-primary">order now</a>
                            

                        </div>
                     </div>
                     
            
                    <?php


                }

               }
               else{
                //categories not available
                echo "<div class='error text-centre'>FOOD NOT ADDED</div>";

               }

            ?>
            <div class="clear-fix"></div>
        </div>
        <h3 class="text-centre"> <a href="#">See all foods</a></h3>
    </section>
    <!-- food menu ends-->


    <?php include('partials_front/footer.php') ?>