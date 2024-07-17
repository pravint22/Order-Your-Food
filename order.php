<?php include('partials_front/menu.php') ?>

<?php
   //check if food id is set or not
   if(isset($_GET['food_id'])){
      //get details of food selected
      $food_id  = $_GET['food_id'];

      //get the details of selected food
      $sql ="SELECT * FROM tbl_food WHERE id = $food_id";

      //execute the query
      $res = mysqli_query($conn , $sql);

      //count the number of rows
      $count = mysqli_num_rows($res);

      if($count==1){
           //we have data
           //get data from data base
           $row = mysqli_fetch_assoc($res);
           $title=$row['title'];
           $price=$row['price'];
           $image_name=$row['image_name'];


      }
      else{
         //food not available
          //redirect to home page
          header('location:'.SITEURL);

      }

   }
   else{
    //redirect to home page
    header('location:'.SITEURL);
   }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-centre text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend class="text-white">Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            //check whether the image is available or not
                            if($image_name==""){
                                //image not available
                                echo "<div class='error'>Image not available</div>";
                            }
                            else{
                                //image is available
                                ?>
                                 <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name?>" alt="Biryani" class="img-responsive img-curve">

                                <?php
                            }

                        ?>
                    </div>
    
                    <div class="menu-description">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>"> <!--passing as hiiden type for tbl_order in       data base-->


                        <p class="food-price"><?php echo $price?> rupees</p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend >Delivery Details</legend>
                    <div class="order-label">Full Name:</div>
                    <input type="text" name="full_name" placeholder="E.g. Shanwitha" class="input-responsive" required>

                    <div class="order-label">Phone Number:</div>
                    <input type="tel" name="contact" placeholder="E.g. 987654321" class="input-responsive" required>

                    <div class="order-label">Email:</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address:</div>
                    <textarea name="adress" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
               if(isset($_POST['submit'])){

                

                //get all the details from the form
                $food=$_POST['food'];
                $price = $_POST['price'];
                $quantity=$_POST['quantity'];
                $total = $price * $quantity;
                $order_date = date("Y-m-d h-i-sa"); //order date
                $status = "ordered"; //ordered on delivery delivered cancelled

                $customer_name = $_POST['full_name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_adress = $_POST['adress']; 

                 //save the order in data base

                 $sql2="INSERT INTO tbl_order SET 
                     food='$food',
                     price = '$price',
                     quantity = '$quantity',
                     total = '$total',
                     order_date = '$order_date',
                     status = '$status',
                     customer_name = '$customer_name',
                     customer_contact = '$customer_contact',
                     customer_email = '$customer_email',
                     customer_adress = '$customer_adress'
                     
                 ";


                 $res2 = mysqli_query($conn, $sql2);

                 if($res2 == TRUE){
                    //query is executed
                    $_SESSION['order'] = "<div class='success text-centre'>Food ordered successfully</div>";
                    header('location:'.SITEURL);

                 }
                 else{
                    //failed to order
                    $_SESSION['order'] = "<div class='error text-centre' >Failed to order food</div>";
                    header('location:'.SITEURL);
                    
                 }

               }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php include('partials_front/footer.php') ?>