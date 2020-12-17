<?php

session_start();
 unset($_SESSION['name']);
 unset($_SESSION['type']);
 ($_SESSION['name'] = null);
 ($_SESSION['type'] = null);
 header("location: products.php");

?>