<?php
   session_start();
   $conn = opneConn();
   
   $user_check = $_SESSION['AccountEmail'];
   
   $ses_sql = mysqli_query($conn,"SELECT AccountEmail from Account where AccountEmail = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
?>