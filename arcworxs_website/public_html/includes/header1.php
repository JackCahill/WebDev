<?php session_start(); ?>
<!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <div class="container d-flex align-items-center">

      <!--<h1 class="logo"><img src="assets/img/Logo_Main.png" ></a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.php" class="logo"><img src="assets/img/Main_Logo.png" alt="" class="img-fluid"></a>

      <nav class="nav-menu d-none d-lg-block">

        <ul>
          <li class="active"><a href="index.php">Home</a></li>

          <li class="drop-down"><a href="#">About</a>
            <ul>
              <li><a href="#about">About Us</a></li>
              <!--<li><a href="team.php">Team</a></li>-->
              <li><a href="contact.php">Contact</a></li>
            </ul>
          </li>

          <li><a href="products.php">Products</a></li>
          <li><a href="shopByVehicle.php">Shop by Vehicle</a></li>
          <li><a href="technology.php">Technology</a></li>
          <!-- <li><a href="blog.php">Forum</a></li> -->
          <li><a href="contact.php">Contact</a></li>
          <li><a href="cart.php"><i class="fas fa-shopping-cart"><span> &nbsp <?php 
          if (isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                            echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
                        }else{
                            echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
                        }
          ?></span></i></a></li>
          
          <?php if (isset($_SESSION["loggedin"])) { ?>
              <li class="active"><a href="welcome.php">Hi, <b><?php echo htmlspecialchars($_SESSION["AccountFName"]); ?></b></a></li>
          <?php } else { 
                echo "";
             } ?>
          

        </ul>

      </nav><!-- .nav-menu -->

     <script type="text/javascript">
		function showMessage(){
			alert("Logout Successful.");
		}
		</script> 
    <?php if (!isset($_SESSION["loggedin"])) { ?>
        <a href="login.php" class="get-started-btn ml-auto">Login</a>
    <?php } else { ?>
         <a href="logout.php" class="get-started-btn ml-auto" onClick='showMessage()'>Logout</a>
    <?php } ?>

    </div>
  </header><!-- End Header -->