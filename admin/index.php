<?php include('partials/menu.php') ?>

      <!-- main-content section starts -->
      <div class="main-content">
        <div class="wrapper">
          <h1>DASH BOARD</h1>
          <br>
          <?php
               if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
               }

          ?>
          <br>
              <div class="col-4 text-centre">

                <?php
                   //sql query
                   $sql = "SELECT * FROM tbl_category";
                   //exectute query
                   $res = mysqli_query($conn ,$sql);
                   //count the number of rows
                   $count = mysqli_num_rows($res);
                ?>

                <h1><?php echo $count?></h1>
                <br />
                Categories
              </div>


              <div class="col-4 text-centre">

              <?php
                   //sql query
                   $sql2 = "SELECT * FROM tbl_food";
                   //exectute query
                   $res2 = mysqli_query($conn ,$sql2);
                   //count the number of rows
                   $count2 = mysqli_num_rows($res2);
                ?>

                <h1><?php echo $count2?></h1>
                <br />
                Foods
              </div>


              <div class="col-4 text-centre">
   
                <?php
                   //sql query
                   $sql3 = "SELECT * FROM tbl_order";
                   //exectute query
                   $res3 = mysqli_query($conn ,$sql3);
                   //count the number of rows
                   $count3 = mysqli_num_rows($res3);
                ?>

                <h1><?php echo $count3?></h1>             
                <br />
                Total Orders
              </div>


              <div class="col-4 text-centre">

              <?php 
                 //create sql query to generate total sum
                 //aggregate function in sql
                 $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'delivered'";

                 //execute the query
                 $res4 = mysqli_query($conn ,$sql4);

                 //get value
                 $row4 = mysqli_fetch_assoc($res4);

                 //get the total revenue
                 $total_revenue = $row4['Total'];
                 
              ?>
                <h1>Rs <?php echo $total_revenue;?></h1>
                <br />
                Revenue Generated
              </div>

              <div class="clear-fix"></div>

        </div>
      </div>
      <!-- main-content section ends -->

<?php  include('partials/footer.php') ?>