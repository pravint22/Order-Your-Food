<?php include('config/constants.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>DAMN RESTUARENT</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>

    <!-- Link CSS file-->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <!-- Navbar starts-->
    <section class="Navigation Bar">
        <div class="container">
            <div class="logo">
                <img src="images/logo.jpg" alt="Damn Restuarent" class="img-responsive">
            </div>
            <div class="menu text-right">
               <ul>
                 <li>
                    <a href="<?php echo SITEURL;?>">Home</a>
                 </li>
                 <li>
                    <a href="<?php echo SITEURL;?>categories.php">Categories</a>
                 </li>
                 <li>
                    <a href="<?php echo SITEURL;?>food.php">Foods</a>
                 </li>
                 <li>
                    <a href="<?php echo SITEURL;?>contact.php">Conatct</a>
                 </li>
               </ul>
            </div>
            <div class="clear-fix"></div>
        </div>   
    </section>
    <!-- Navbar ends-->