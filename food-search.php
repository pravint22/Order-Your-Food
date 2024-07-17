<?php include('partials_front/menu.php') ?>

    <!-- foodsearch starts-->
    <section class="food-search text-centre">
        <div class="container">
            <?php
            //$search = $_POST['search']; this old method is not secure cause the hacker can easily delete our whole data base with searching like biryani ',Drop the database etc cases
            $search = mysqli_real_escape_string($conn,$_POST['search']);
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>
            
        </div>

    </section>
    <!--foodsearch ends-->

     <!-- food menu starts-->
     <section class="food-menu">
        <div class="container">
            <h2 class="text-centre">Food Menu</h2>

            <?php

            //get search key word

            //sql query based on foods based on search key word
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //execute the query
            $res = mysqli_query($conn, $sql);
 
            //count rows to check whether rows are available or not
            $count = mysqli_num_rows($res);

            if($count>0){
                //food available
                while($row = mysqli_fetch_assoc($res)){
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
                //food not available
                echo "<div class='error'>Food not found</div>";
            }
            ?>
            <div class="clear-fix"></div>
        </div>
        <h3 class="text-centre"> <a href="#">See all foods</a></h3>
    </section>
    <!-- food menu ends-->



    <?php include('partials_front/footer.php') ?>