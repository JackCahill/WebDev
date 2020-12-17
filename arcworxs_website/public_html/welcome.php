<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Welcome to Arcworxs</title>
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
<br>
<br>
<br>
<br>
<br>
<br>
<?php
//include 'includes/session.php';
include 'includes/header.php';
?>
<script type="text/javascript">
	function showMessage(){
		alert("Logout Successful");
	}
</script>
<div class=container>
    <div class="row content">
        <div class="col-lg-6">
        <h3>Hi, <b><?php echo htmlspecialchars($_SESSION["AccountFName"]); ?></b>. Welcome to Arcworxs.</h3><br>
        <p>
        <h4>Arcworxs is a new fabrication company disrupting the off-road industry with extremely high-quality parts that are not widely available in the market.</h4>
        <p>
        Arcworxs - shop products, find information, and interact with other members of the off-road community. We make it easy to search for products and see what other people have to say about them. Your one-stop-shop for quality parts and information.  
        <p>
        <br><a href="logout.php" class="get-started-btn ml-auto" onClick='showMessage()'>Sign out of your acccount</a>
        <p>
    </div>
    <div class="col-lg-6">
        <h3> Content Management</h3>
        <br><a href ="#" class="get-started-btn ml-auto">Manage Orders</a><br>
        <br><a href ="#" class="get-started-btn ml-auto">Manage Products</a><br>
        <br><a href ="#" class="get-started-btn ml-auto">Manage Customers</a><br>
        <br><a href ="#" class="get-started-btn ml-auto">Manage Vendors</a><br>
        </div>
    </div>
</div> 

    <?php include 'includes/footer.php'; ?>
</body>
</html>