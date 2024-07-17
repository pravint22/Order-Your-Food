<?php include('partials/menu.php'); ?>

<div class="main-content">
<div class="wrapper">
          <h1>MANAGE ORDER</h1>
          <br />

          <?php 

        if(isset($_SESSION['update'])){
            echo $_SESSION['update']; //displaying seeion message
            unset($_SESSION['update']); //removing session message
        }

        if(isset($_SESSION['no-order-found'])){
            echo $_SESSION['no-order-found']; //displaying seeion message
            unset($_SESSION['no-order-found']); //removing session message
        }
         
         
        ?>
        <br>

<!-- button to add admin-->


<table class="table-full">
  <tr>
      <th>S.No.<br></th>   
      <th>Food </th>
      <th>Price </th>
      <th>Quantity </th>
      <th>Total </th>
      <th>Order Date </th>
      <th>Status </th>
      <th>Customer Name </th>
      <th>Customer Contact </th>
      <th>Customer Email </th>
      <th>Customer Adress </th>
      <th>Actions </th>
  </tr>

  <?php 
               // query to get all food
               $sql = "SELECT * FROM tbl_order ORDER BY id DESC";  //display latest order on top
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
                        $food=$rows['food'];
                        $price=$rows['price'];
                        $quantity=$rows['quantity'];
                        $total=$rows['total'];
                        $order_date=$rows['order_date'];
                        $status=$rows['status'];
                        $customer_name=$rows['customer_name'];
                        $customer_contact=$rows['customer_contact'];
                        $customer_email=$rows['customer_email'];
                        $customer_adress=$rows['customer_adress'];


                        //display the vales in our table
                        ?>
                            <tr>
                                <td><?php echo $sn++;?></td>   
                                <td><?php echo $food;?></td>
                                <td><?php echo "Rs".$price;?></td>
                                <td><?php echo $quantity;?></td>
                                <td><?php echo "Rs".$total;?></td>
                                <td><?php echo $order_date;?></td>
                                <td>
                                    <?php
                                          if($status == "ordered"){
                                            echo "<label style:'color:blue;'>$status</label>";
                                          }
                                          else if($status == "on delivery"){
                                            echo "<label style:'color:yellow;'>$status</label>";
                                          }
                                          else if($status == "delivered"){
                                            echo "<label style:'color:green;'>$status</label>";
                                          }
                                          else if($status == "cancelled"){
                                            echo "<label style:'color:red;'>$status</label>";
                                          }
                                    ?>
                                </td>
                                <td><?php echo $customer_name;?></td>
                                <td><?php echo $customer_contact;?></td>
                                <td><?php echo $customer_email;?></td>
                                <td><?php echo $customer_adress;?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="button button-secondary">Update Order</a>
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
                        <td colspan="12"><div class="error">No Orders Requested</div></td>
                    </tr>
                    <?php
                }
               }
            ?>

</table>
     

 </div>

</div> 

<?php include('partials/footer.php'); ?>