<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cart</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/awfav.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>



<?php

session_start();
include 'includes/init.php';
require_once ('includes/component.php');

if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["product_id"] == $_GET['ProductID']){
              unset($_SESSION['cart'][$key]);
              echo "<script>alert('Product has been Removed...!')</script>";
              echo "<script>window.location = 'cart.php'</script>";
          }
      }
  }
}


?>

<body>

<?php include 'includes/header.php';?>
 <main id="main">
 <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-left">
          <h2></h2>
          <h2>Shopping Cart</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Cart</li>
          </ol>
         </div>
    </section><!-- End Breadcrumbs -->

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <?php
                $conn = openConn();
                $total = 0;
                    if (isset($_SESSION['cart'])){
                        $count = count($_SESSION['cart']);
                        $product_id = array_column($_SESSION['cart'], 'product_id');
                        $sql = "SELECT * FROM `Product` INNER JOIN ProductPhoto ON Product.ProductID = ProductPhoto.ProductID";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)){
                            foreach ($product_id as $id){
                                if ($row['ProductID'] == $id){
                                    cartElement($row['ProductPhoto'], $row['ProductName'],$row['ProductPrice'], $row['ProductID'], $row['ProductDescription']);
                                    $total = $total + (int)$row['ProductPrice'];
                                }
                            }
                        }
                        if ($count == 0) {
                            echo "<hr><br><h5>Your Cart is Empty</h5><br><hr>";
                        }
                    }else{
                        echo "<hr><br><h5>Your Cart is Empty</h5><br><hr>";
                    }

                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>$<?php echo number_format($total,2); ?></h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6>$<?php echo number_format($total,2); ?></h6>
                    
                       
                    </div>
                    <div class="col-md-6">
                    <?php 
                    if (isset($_SESSION['cart'])){
                        $count = count($_SESSION['cart']);
                    }
                    if ($count < 1) {
                    ?>
                   
                    <?php 
                    } else {
                        ?> <h6><a href="OrderConfirmation.php" class="get-started-btn ml-auto">Place Order</a></h6><?php
                    }
                    ?>
                </div>
                
            </div>

        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
