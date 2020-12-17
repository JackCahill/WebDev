<?php

session_start();
 unset($_SESSION['name']);
 unset($_SESSION['type']);
 unset($_SESSION['cart']);
 ($_SESSION['name'] = null);
 ($_SESSION['type'] = null);
 ($_SESSION['type'] = null);
 header("location: products.php");

?>