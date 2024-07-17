<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br>

        <?php 
        if(isset($_GET['id'])){
                //get id of selected admin
        $id = $_GET['id'];

        //create sql query to get details
        $sql = "SELECT * FROM tbl_order WHERE id=$id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whether it is executed or not
        if($res == TRUE){
            //check whether the data is available or not
            $count = mysqli_num_rows($res);
            //check whether we have admin data or not
            if($count == 1){
                //we will get details
                //echo "Category available";
                $row=mysqli_fetch_assoc($res);
                $id = $row['id'];
                $status = $row['status'];
            }
            else{
                //redirect to manage order with message
                $_SESSION['no-order-found'] = "<div class='error'>Order not found</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }

        }
        }
        else{
            header('location:'.SITEURL.'admin/manage-order.php');

        }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="table-30">
            <tr>
                    <td>Status:</td>
                    <td>
                      <select name="status">
                        <option <?php if($status =="ordered"){echo "selected";}?>value="ordered">ordered</option>
                        <option <?php if($status =="on delivery"){echo "selected";}?>value="on delivery">on delivery</option>
                        <option <?php if($status =="delivered"){echo "selected";}?>value="delivered">delivered</option>
                        <option <?php if($status =="cancelled"){echo "selected";}?>value="cancelled">cancelled</option>
                      </select>
                    </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update Order" class="button button-secondary">

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
    //get all values from form to update
    $id = $_POST['id'];
    $status = $_POST['status'];

    //update the database
    $sql2 = "UPDATE tbl_order SET
    status='$status'
    WHERE id='$id'
    ";

    //execute the query
    $res2 = mysqli_query($conn,$sql2);

    //check sucess
    if($res2 == TRUE){
        //updated successfully
        $_SESSION['update'] = "<div class='success'>Order updated successfully</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
    else{
        //failed to update
        $_SESSION['update'] = "<div class='error'>Failed to update order</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
}
?>


<?php  include('partials/footer.php'); ?>
