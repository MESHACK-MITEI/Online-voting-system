<?php
session_start();
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (!empty($username) && !empty($password)) {
        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM signup WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            // Verify the hashed password
            if (password_verify($password, $user_data['password'])) {
                // Set session variables and redirect
                $_SESSION['username'] = $user_data['username'];
                $_SESSION['id_number'] = $user_data['id_number'];
                header("Location: cast.php");
                exit;
            } else {
                echo "<script>alert('Invalid password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Invalid username. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="login.css">
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
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="hm.html">Home</a>

             
          </li>
           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              services
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <div class="dropdown-content">
                <li><a class="dropdown-item" href="login.php" onclick="Generalelection()" >&#11162;General Election</a></li>
                <li><a class="dropdown-item" href="#" onclick="Byelection()" >&#11162;By-election</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">&#11162;others</a></li>
              </div>
             
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="About.html">About</a>
            <li class="nav-item">
            <a style="margin-left: 500%; color: white; font-size: 20px;"class="nav-link active" aria-current="page" href="login.html">Login</a>

             
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header>
    <h1>Kenya Online National Election Services</h1>
  </header>

  <div class="loginbox">
    <img src="images/bgn1.png" class="logo">
    <h2><b>Login Here</b></h2>
    <form class="form" method="post" >
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Enter Username">
      <span id="_username" style="display: none; color: red;"></span>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter Password">
      <span id="_password" style="display: none; color: red;"></span>
      <a href="lost_password.php">Forgot your password?</a><br>
      <input type="submit" value="Login"   style="border-radius: 20px;"><br>
      <a href="sign_up.php">Don't have an account? Register</a>

    </form>
  </div>

  <footer>
    <p>© 2024 IEBC Portal - All Rights Reserved.</p>
  </footer>
  <script>
function verification() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const usernameSpan = document.getElementById('_username');
    const passwordSpan = document.getElementById('_password');
    usernameSpan.innerText = (username === "") ? "Username is required" : "";
    usernameSpan.style.display = (username === "") ? "block" : "none";

    passwordSpan.innerText = (password === "") ? "Password is required" : "";
    passwordSpan.style.display = (password === "") ? "block" : "none";
}
function login(){
          var username = document.getElementById("username").value;
             var password = document.getElementById("password").value;
              if(username== "" && password==""){
             window.location.assign("cast.html");
           alert("Login Successfully ");
            }
              else{
              alert("Invalid Information ");
                return;
             }
        }
        function Generalelection() {
      alert("Please go to login!");
        }
        function Byelection() {
      alert("Please go to login!");
        }
  </script>
</body>

</html>
