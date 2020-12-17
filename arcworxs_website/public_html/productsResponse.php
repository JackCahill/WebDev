<?php 
    session_start();
    $name = $_POST["vehicleSelect"];
    $_SESSION["name"] = $_POST["vehicleSelect"];
    $_SESSION["type"] = $_POST["typeSelect"];
    header("Location: products.php"); 

?>