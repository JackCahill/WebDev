<!DOCTYPE html>
<?php
 // include on every top level page 
 include 'includes/init.php';
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sign Up</title>
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

<?php
// Open connection to the database
$conn = openConn();
 
// Define variables and initialize with empty values
$firstName = $lastName = $phone = $username = $password = $confirm_password = "";
$firstName_err = $lastName_err = $phone_err = $username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if (empty(trim($_POST["firstName"]))){
        $firstName_err = "Please enter your first name.";
    } else {
        $firstName = trim($_POST["firstName"]);
    }
    if(empty(trim($_POST["lastName"]))){
        $lastName_err = "Please enter your last name.";
    } else {
        $lastName = trim($_POST["lastName"]);
    }
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your phone number.";
    }  else {
        $phone = trim($_POST["phone"]);
    }
    // Validate email,
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your email.";
    } else {
        // Prepare a select statement
        $sql = "SELECT AccountEmail FROM Account WHERE AccountEmail = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This email is already being used.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($firstName_err) && empty($lastName_err) && empty($phone_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO Account (AccountEmail, AccountPhoneNum, AccountPassword, AccountFName, AccountLName) VALUES (?, ?, ?, ?, ?)";
  
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_phone, $param_password, $param_firstName, $param_lastName);
            
            // Set parameters
            $param_username = $username;
            $param_phone = $phone;
            $param_password = md5($password); // Creates a password hash
            $param_firstName = $firstName;
            $param_lastName = $lastName;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                 $_SESSION["loggedin"] = true;
                 $_SESSION["AccountFName"] = $firstName;
                 $_SESSION["AccountLName"] = $lastName;
                 $_SESSION["username"] = $username;  
                header("location: welcome.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
   mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
    <body>
    <br>
    <br>
    <br>
    <br>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($firstName_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>">
                <span class="help-block"><?php echo $firstName_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($lastName_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>">
                <span class="help-block"><?php echo $lastName_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <label>Phone Number</label>
                <input type="tel" name="phone" class="form-control" value="<?php echo $phone; ?>">
                <span class="help-block"><?php echo $phone_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"id=pass>
                <input type="checkbox" onclick="showPwd()"> Show Password
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <script>
            function showPwd() {
              var x = document.getElementById("pass");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
            </script>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>   
    <?php include 'includes/footer.php'; ?>    
</body>
</html>