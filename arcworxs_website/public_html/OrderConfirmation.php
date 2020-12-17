<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Order Confirmation</title>
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

?>

<body>

<?php include 'includes/header.php';?>
 <main id="main">
 <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-left">
          <h2>Order Confirmation</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Order Confirmation</li>
          </ol>
         </div>
    </section><!-- End Breadcrumbs -->
    
    <div class=container>
    <div class="row content">
        <div class="col-lg-6">
        <p>
        <h4>Thank you for shopping with Arcworxs.</h4>
        <p>
        Your order for the products below has been succesfully placed!<br>
    
    </div>
    </div>
    </div>
   
    
<div class="container">
    <div class="row text-center py-5">
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
                                    orderElement($row['ProductPhoto'], $row['ProductName'],$row['ProductPrice'], $row['ProductID'], $row['ProductDescription'], $row['FitmentName']);
                                    $total = $total + (int)$row['ProductPrice'];
                                }
                            }
                        }
                       
                    }

                ?>
    </div>
</div>

 <div class=container>
    <div class="row content">
        <div class="col-lg-6">
            <br><a href="clearCartSession.php" class="get-started-btn ml-auto">Continue Shopping?</a><br>
            
        <p>
    </div>
    </div>
    </div>
    
<?php include 'includes/footer.php'; ?>
</body>
</html>
 


