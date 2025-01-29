<?php
include("config.php");

function generateToken($length = 32)
{
    return bin2hex(random_bytes($length));
}

function sendPasswordResetEmail($email, $token)
{
    $subject = "Password Reset";
    // Correct the URL (removed one 'http://')
    $message = "Click the following link to reset your password: http://localhost/election.com/reset_password.php?token=$token";
    $headers = "From: glites81@gmail.com"; // Use a valid email address

    // Use PHP's mail function to send the email
    if (mail($email, $subject, $message, $headers)) {
        echo "Password reset link sent to your email.";
    } else {
        echo "Failed to send password reset email.";
    }
}

if ($_SERVER["REQUEST_METHOD"]  == "POST") {
    $email = $_POST["email"];
    $token = generateToken();

    // Prepare an SQL statement to prevent SQL injection
    $sql = "UPDATE users SET reset_token = ? WHERE email = ?";
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $token, $email);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            sendPasswordResetEmail($email, $token);
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    } else {
        echo "Error preparing statement: " . mysqli_error($con);
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
  <style>
    body {
      background-color: lightgreen;
    }

    header {
      font-family: Arial;
      color: white;
      text-align: center;
      font-size: xx-large;
      background-color: blueviolet;
      padding: 20px;
      margin-top: -1rem;
    }

    .navbar {
      margin-bottom: 20px;
    }

    .navbar-brand {
      font-size: 1.5rem;
    }

    .loginbox {
      max-width: 400px;
      background-color: #fff;
      padding: 20px;
      border-radius: 20px;
      width: 80%;
      margin: auto;
      text-align: center;
      margin-top: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .logo {
      width: 100px;
      height: 100px;
      border-radius: 50%;
    }

    .form {
      margin-top: 20px;
    }

    label {
      display: block;
      text-align: left;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      background-color: blue;
      color: white;
      cursor: pointer;
    }

    a {
      text-decoration: none;
      color: blue;
    }

    a:hover {
      text-decoration: underline;
    }

    footer {
      height: 50px;
      padding: 10px;
      background-color: #f0f0f0;
      text-align: center;
      font-size: 14px;
    }

    .lost-password-box {
      max-width: 400px;
      background-color: #fff;
      padding: 20px;
      border-radius: 20px;
      width: 80%;
      margin: auto;
      text-align: center;
      margin-top: 2px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .lost-password-form {
      margin-top: 20px;
    }
    .img {
      width: 50px;
      height: 50px;
      margin-right: 20px;

    }

    .img1 {
      width: 40px;
      height: 40px;
      margin-right: 20px;
    }
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
            <a class="nav-link active" aria-current="page" href="#">Home</a>
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

  <div class="lost-password-box">
    <img src="images/bgn1.png" class="logo">
    <h2><b>Lost Password</b></h2>
    <form class="lost-password-form" method="post" action="reset_pass.php">
      <label for="lost-email">Email</label>
      <input type="email" id="lost-email" name="lost-email" placeholder="Enter Email" required>
      <input type="submit" value="Reset Password">
    </form>
  </div>

  <footer>
    <p>© 2024 IEBC Portal - All Rights Reserved.</p>
  </footer>

</body>

</html>
