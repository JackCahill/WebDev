<!DOCTYPE html>
<?php
 // include on every top level page 
 include 'includes/init.php';
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Products</title>
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

<body>

<?php include 'includes/header.php';?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Products</h2>
          <ol>
            
            <li "d-flex justify-content-between align-items-left">
                
        <FORM action="productsResponse.php" method=post>
        <div stile="left-margin: auto;right-margin: auto;"
        <h4> &nbsp Vehicle: <SELECT id="vehicle" NAME = "vehicleSelect"> <option value="none" selected disabled hidden> Select a Vehicle </option>  
        <?php 
            $conn = openConn();
            $sql = "SELECT DISTINCT ProductFitment.FitmentID, ProductFitment.FitmentName FROM ProductFitment ORDER BY ProductFitment.FitmentID";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    ?><OPTION value = "<?php echo $row["FitmentID"];?>" <?php if ($row["FitmentID"] == $name) { echo "SELECTED";}?>> <?php echo $row["FitmentName"];?></OPTION><?php
                }
            }
             else{
                echo "0 results";
            }
            
        
            ?>
            </SELECT><?php
              mysqli_close($conn);
              
               $conn = openConn();
              ?> &nbsp Product Type: <SELECT id = "type" NAME = "typeSelect"> <option value="none" selected disabled hidden> Select a part type </option> <?php 
            $sql = "SELECT DISTINCT Product.ProductType FROM Product ORDER BY Product.ProductType;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    ?><OPTION> <?php echo $row["ProductType"];?></OPTION><?php
                }
            }
             else{
                echo "0 results";
            }
            
            ?></SELECT></h4>
            

            
            &nbsp <INPUT type="submit" value="Submit" class="active">
            &nbsp <INPUT type="button" value="Reset" class="button_active" onclick="location.href='item.php';" class="active">
            
            </form>
            
            <?php
              mysqli_close($conn);?>
             
            </li>
            &nbsp 
            &nbsp
            &nbsp 
            &nbsp 
            &nbsp
            &nbsp 
            &nbsp
            &nbsp 
            &nbsp
            &nbsp 
            &nbsp
            &nbsp 
            <li><a href="index.php">Home</a></li>
            <li>Products</li>
            
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

<?php
    $name = null;
    $type = null;
    $name = $_SESSION["name"];
    $type = $_SESSION["type"];
    if (htmlspecialchars($_GET["name"]) != ""){
        $name = htmlspecialchars($_GET["name"]);
        
    }
    

   
    
    
session_start();

include 'includes/component.php';
$conn = openConn();


if (isset($_POST['add'])){

    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'products.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        //print_r($_SESSION['cart']);
    }
}
?>
    
 
<?php  
      if ($type == null and $name == null ){
                $conn = openConn();
                 
                         $sql = "SELECT Product.ProductID, ProductFitment.FitmentID, ProductFitment.FitmentName, Product.ProductName, Product.ProductDescription, Product.ProductPrice, ProductPhoto.ProductPhoto, Product.ProductStock FROM ProductFitment INNER JOIN Product ON ProductFitment.ProductID = Product.ProductID INNER JOIN ProductPhoto ON Product.ProductID = ProductPhoto.ProductID ORDER BY ProductFitment.FitmentID;";
                         $result = mysqli_query($conn, $sql);
                         ?>
                         <div class="container">
                            <div class="row text-center py-5">
                             <?php 
                             if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    component($row['ProductName'], $row['ProductPrice'], $row["ProductPhoto"], $row['ProductID'], $row['ProductDescription'], $row['FitmentName']);
                                }
                             } else {
                              echo "No products for that vehicle/product type";
                            }
                            ?>
                            </div>
                        </div>
                        <?php
                 mysqli_close($conn);
                 
        }
        elseif ($type == null and $name != null){
            
             $conn = openConn();
                 
                          $sql = "SELECT Product.ProductID, ProductFitment.FitmentID, ProductFitment.FitmentName, Product.ProductName, Product.ProductDescription, Product.ProductPrice, ProductPhoto.ProductPhoto, Product.ProductStock FROM ProductFitment INNER JOIN Product ON ProductFitment.ProductID = Product.ProductID INNER JOIN ProductPhoto ON Product.ProductID = ProductPhoto.ProductID WHERE ProductFitment.FitmentID = '". $name ."' ORDER BY ProductFitment.FitmentID;";
                          $result = mysqli_query($conn, $sql);
                         ?>
                         <div class="container">
                            <div class="row text-center py-5">
                             <?php 
                             if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    component($row['ProductName'], $row['ProductPrice'], $row["ProductPhoto"], $row['ProductID'], $row['ProductDescription'], $row['FitmentName']);
                                }
                             } else {
                              echo "No products for that vehicle/product type";
                            }
                            ?>
                            </div>
                        </div>
                 <?php
                 mysqli_close($conn);
                 
            
        }
        elseif ($type != null and $name == null ){
            
            $conn = openConn();
                 
                          $sql = "SELECT Product.ProductID, ProductFitment.FitmentID, ProductFitment.FitmentName, Product.ProductName, Product.ProductDescription, Product.ProductPrice, ProductPhoto.ProductPhoto, Product.ProductStock FROM ProductFitment INNER JOIN Product ON ProductFitment.ProductID = Product.ProductID INNER JOIN ProductPhoto ON Product.ProductID = ProductPhoto.ProductID WHERE Product.ProductType = '". $type ."' ORDER BY ProductFitment.FitmentID;";
                          $result = mysqli_query($conn, $sql);
                         ?>
                         <div class="container">
                            <div class="row text-center py-5">
                             <?php 
                             if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    component($row['ProductName'], $row['ProductPrice'], $row["ProductPhoto"], $row['ProductID'], $row['ProductDescription'], $row['FitmentName']);
                                }
                             } else {
                              echo "No products for that vehicle/product type";
                            }
                            ?>
                            </div>
                        </div>
                 <?php
                 mysqli_close($conn);
            
           
        }
        
        else {
            
             $conn = openConn();
                 
                          $sql = "SELECT Product.ProductID, ProductFitment.FitmentID, ProductFitment.FitmentName, Product.ProductName, Product.ProductDescription, Product.ProductPrice, ProductPhoto.ProductPhoto, Product.ProductStock FROM ProductFitment INNER JOIN Product ON ProductFitment.ProductID = Product.ProductID INNER JOIN ProductPhoto ON Product.ProductID = ProductPhoto.ProductID WHERE ProductFitment.FitmentID = '". $name ."' AND Product.ProductType = '". $type ."' ORDER BY ProductFitment.FitmentID;";
                          $result = mysqli_query($conn, $sql);
                         ?>
                         <div class="container">
                            <div class="row text-center py-5">
                             <?php 
                             if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    component($row['ProductName'], $row['ProductPrice'], $row["ProductPhoto"], $row['ProductID'], $row['ProductDescription'], $row['FitmentName']);
                                }
                             } else {
                              echo "No products for that vehicle/product type";
                            }
                            ?>
                            </div>
                        </div>
                 <?php
                 mysqli_close($conn);
        }
         // This makes things clear after adding to cart but it also makes it so the sessions are destroyed when the page is reset.
        // unset($_SESSION['name']);
        // unset($_SESSION['type']);
    ?>
    <!-- ======= Services Section ======= -->
    <!--
    <section id="services" class="services">
      <div class="container">

        <div class="row">
          <div class="col-md-6">
            <div class="icon-box">
              <i class="icofont-computer"></i>
              <h4><a href="#">Lorem Ipsum</a></h4>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="icofont-chart-bar-graph"></i>
              <h4><a href="#">Dolor Sitema</a></h4>
              <p>Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="icofont-image"></i>
              <h4><a href="#">Sed ut perspiciatis</a></h4>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="icofont-settings"></i>
              <h4><a href="#">Nemo Enim</a></h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="icofont-earth"></i>
              <h4><a href="#">Magni Dolore</a></h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="icofont-tasks-alt"></i>
              <h4><a href="#">Eiusmod Tempor</a></h4>
              <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
            </div>
          </div>
        </div>

      </div>
    </section>
    --><!-- End Services Section -->

    <!-- ======= Features Section ======= -->
    <!--
    <section id="features" class="features">
      <div class="container">

        <div class="section-title">
          <h2>Features</h2>
          <p>Check our Features</p>
        </div>

        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-toggle="tab" href="#tab-1">Modi sit est</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-2">Unde praesentium sed</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-3">Pariatur explicabo vel</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-4">Nostrum qui quasi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-5">Iusto ut expedita aut</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Architecto ut aperiam autem id</h3>
                    <p class="font-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                    <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/features-1.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Et blanditiis nemo veritatis excepturi</h3>
                    <p class="font-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                    <p>Ea ipsum voluptatem consequatur quis est. Illum error ullam omnis quia et reiciendis sunt sunt est. Non aliquid repellendus itaque accusamus eius et velit ipsa voluptates. Optio nesciunt eaque beatae accusamus lerode pakto madirna desera vafle de nideran pal</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/features-2.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-3">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Impedit facilis occaecati odio neque aperiam sit</h3>
                    <p class="font-italic">Eos voluptatibus quo. Odio similique illum id quidem non enim fuga. Qui natus non sunt dicta dolor et. In asperiores velit quaerat perferendis aut</p>
                    <p>Iure officiis odit rerum. Harum sequi eum illum corrupti culpa veritatis quisquam. Neque necessitatibus illo rerum eum ut. Commodi ipsam minima molestiae sed laboriosam a iste odio. Earum odit nesciunt fugiat sit ullam. Soluta et harum voluptatem optio quae</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/features-3.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-4">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Fuga dolores inventore laboriosam ut est accusamus laboriosam dolore</h3>
                    <p class="font-italic">Totam aperiam accusamus. Repellat consequuntur iure voluptas iure porro quis delectus</p>
                    <p>Eaque consequuntur consequuntur libero expedita in voluptas. Nostrum ipsam necessitatibus aliquam fugiat debitis quis velit. Eum ex maxime error in consequatur corporis atque. Eligendi asperiores sed qui veritatis aperiam quia a laborum inventore</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/features-4.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-5">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Est eveniet ipsam sindera pad rone matrelat sando reda</h3>
                    <p class="font-italic">Omnis blanditiis saepe eos autem qui sunt debitis porro quia.</p>
                    <p>Exercitationem nostrum omnis. Ut reiciendis repudiandae minus. Omnis recusandae ut non quam ut quod eius qui. Ipsum quia odit vero atque qui quibusdam amet. Occaecati sed est sint aut vitae molestiae voluptate vel</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/features-5.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    --><!-- End Features Section -->

  </main><!-- End #main -->

<?php include 'includes/footer.php';?>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>