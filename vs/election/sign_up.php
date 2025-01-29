<?php
session_start();
include('config.php'); // Ensure your config file sets up the `$con` connection properly

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $id_number = $_POST['id_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['Confirm_password'];

    // Validate password and confirm password
    if ($password !== $confirm_password) {
        echo "<script type='text/javascript'> alert('Passwords do not match.') </script>";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $stmt = $con->prepare("SELECT * FROM signup WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script type='text/javascript'> alert('Email already exists. Please use a different email.') </script>";
    } else {
        // Check if ID number already exists
        $stmt = $con->prepare("SELECT * FROM signup WHERE id_number = ?");
        $stmt->bind_param("s", $id_number);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "<script type='text/javascript'> alert('ID number already exists. Please use a different ID.') </script>";
        } else {
            // Insert the user into the database
            $stmt = $con->prepare("INSERT INTO signup (username, id_number, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $id_number, $email, $hashed_password);
            if ($stmt->execute()) {
                echo "<script type='text/javascript'> alert('Successfully Signed Up') </script>";
                header("Location: login.php");
                exit;
            } else {
                echo "<script type='text/javascript'> alert('Error registering user.') </script>";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Kenya Online National Election Services</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
 <link href="styles.css" rel="stylesheet" type="text/css">
  <style>
    
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img class="img1" src="images/bgn1.png" alt="">
    <img class="img" src="images/seal.jpg" alt="">
    <div class="container">
      <a class="navbar-brand" href="#"> <b>Self Service Portal |</b> IEBC</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="hm.html">Home</a>
          </li>
          <li class="nav-item services">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown aria-expanded="false">
              services
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">General Election</a></li>
              <li><a class="dropdown-item" href="#">By-election</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#"></a>others</a></li>
            </ul>
            </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header>
    <h1>Kenya Online National Election Services</h1>
  </header>
 
  <div class="signupbox">
    <img src="images/bgn1.png" class="logo">
    <h2><b>Register</b></h2>
    <form class="form" method="post">
      <label for="signup-username">Username</label>
      <input type="text" id="signup-username" name="username" placeholder="Enter Username" required>
       <label for="id-number">ID number</label>
      <input type="text" id="id-number" name="id_number" placeholder="Enter ID number"required>
        <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter Email"required>
       <label for="signup-password">Password</label>
      <input type="password" id="signup-password" name="password" placeholder="Enter Password" required>
       <label for="confirm-password">Confirm Password</label>
      <input type="password" id="confirm-password" name="Confirm_password" placeholder="Confirm Password" required>
       <a href="https://www.iebc.or.ke/registration/?aspirant">Terms and conditions</a>
      <input type="checkbox" id="terms-condition" name="terms-condition">
      <label for="terms-condition">I have agreed to the terms and conditions</label><br>
      <input type="submit" value="Register" style="border-radius: 20px;"><br>
      <a href="login.php">Already have an account? Login</a>


    </form>
  </div>
  <script>
    
     

    function Register(){
      
      alert( "you have seccessfully register your account!")
    }
              
  </script>

  <footer>
    <p>© 2024 IEBC Portal - All Rights Reserved.</p>
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script async src="script.js"></script>
</body>

</html>
  