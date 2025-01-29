<?php
session_start();

include('includes/conn.php');



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM admin WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['password'] == $password) {
                $_SESSION['username'] = $username;
                header("location: dashboard.php");
                die;
            }
        }
        
        
    } else {
      echo "<script type='text/javascript'> alert('Please Enter some valid Information') </script>";

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
  <style>
    body {
      background-image: url(" ");
      background-color: palegreen;
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
       
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
      color: green;
    }

    .navbar-brand {
      font-size: 1.5rem;
    }
    

    li {
      display: inline-block;
    }
     
    .dropdown-menu
    {
      position: relative;
      display: inline-block;
      margin: -1rem;
      border: transparent;
      
    }
    .dropdown-content
    {
      display: none;
      position: absolute;
      background-color: lightgrey;
      min-width: 0px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
     
      
    }
     .navbar ul li:hover .dropdown-content   {
      display: block;
      position: absolute;
      background-color: palegreen;
      border-bottom: 1px dotted floralwhite;
      
    }
    .navbar li ul:hover .dropdown-content li ul div 
    {
      width: 150px;
      padding: 10px;
      border-bottom: 100px dotted floralwhite;
      background: transparent;
    }

    .loginbox {
      max-width: 400px;
      background:  linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
      padding: 20px;
      border-radius: 20px;
      width: 80%;
      margin: auto;
      text-align: center;
      margin-top: 1rem;
      margin-bottom: 1rem;
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
      background-color: #2874A6;
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
    
    span{
      margin-right: 200px;
    }
  </style>
</head>

<body>

   

  <header>
    <h1> Admin Login</h1>
  </header>

  <div class="loginbox">
    <img src="imagess/bgn1.png" class="logo">
    <h2><b>Login Here</b></h2>
    <form class="form" method="post" >
      <label for="username">Email</label>
      <input type="text" id="username" name="username" placeholder="Enter Email">
      <span id="_username" style="display: none; color: red;"></span>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter Password">
      <span id="_password" style="display: none; color: red;"></span>
      <a href="lost_password.php">Forgot your password?</a><br>
      <input type="submit" value="Login"style="border-radius: 5px;"><br>
      <a href="reg.php">Don't have an account? Register</a>

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
