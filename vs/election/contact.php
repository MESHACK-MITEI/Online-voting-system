<?php
session_start();
include('config.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        
        // Use Prepared Statements to prevent SQL Injection
        $stmt = $con->prepare("INSERT INTO queries (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo "<script>alert('Query Successfully Submitted');</script>";
            header("Location: contact.php");
            exit();  // Prevent further execution
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "<script>alert('Please fill in all required fields');</script>";
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
      background-image:" ";
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-color:palegreen;
      
      
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
    .hbox
    {
        background-color: blueviolet;
        max-width: 1500px;
        padding: 2%;
        border-radius: 20px;
        width: 100%;
        height: 100px;
        text-align: left;
        
    }

    .navbar {
      margin-bottom: 20px;
      }
    .navbar-brand {
      font-size: 1rem;
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
      background-color:black;
      text-align: center;
      font-size: 14px;
      color: white;
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
    span{
      margin-right: 200px;
    }
    .dropdown-menu{
      float: none;
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
    }
    
    ul li{
      display: inline block;
      position: relative;
    }
    .navbar-brand {
      font-size: 1.5rem;
    }
    .image1box
    {
    max-width: 2000px;
    height: 550px;
      background-color:whitesmoke;
      padding: 20px;
      border-radius: 20px;
      width: 80%;
      margin: 15rem;
      text-align:center;
      margin-top: 1rem;
      margin-bottom: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    
    }
    
   
    .image2box
    {
    max-width: 217px;
    height: 550px;
      background-color:white;
      padding: 20px;
      border-radius: 20px;
      width: 80%;
      margin: 1rem;
      text-align:center;
      margin-top: -35.4rem;
      margin-bottom: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
       
    }
    
    
    .frm2
    {
     max-height: 400px;  
    box-sizing: content-box;
    }
    h3
    {
        font-size: small;
    }
    h5
    {
        color: black;
        font-size: medium;
        text-align: center;
    }
    h4
    {
        color: black;
        font-size: medium;
        text-align: center;
    }
    
    .kef
    {
      width: 150px;
      height: 150px;
      text-align: right;
    }
    .bgn1
    {
      width: 150px;
      height: 150px;
      text-align: center;
      position: relative;
      margin-bottom: 2rem;
    }
    .custom-submit-btn {
        background-color:blue;  
        color: white;  
        padding: 10px 20px; 
        border: none;  
        border-radius: 5px; 
        cursor: pointer; 
        width: 150px;
    }

    .custom-submit-btn:hover {
        background-color: #45a049; /* Darker green on hover */
    }
    @media (max-width: 768px) {
    .navbar-brand {
        font-size: 1rem; /* Smaller font size for mobile */
    }
    .form input, .form textarea {
        width: 100%; /* Full width for form elements on small screens */
    }
    .image1box, .image2box {
        margin: 1rem;
        width: auto; /* Adjust width for small screens */
    }
    .nav-item a {
        font-size: 0.8rem; /* Smaller links on the navbar for mobile */
    }
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
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html">Home</a>
            </li>
             <!-- <option data-id="390000" data-party="UDA" data-photo="Ruto.jpg" >Ruto</option>
                <option data-id="2" data-party="AZIMIO" data-photo="Raila.jpg" >Raila</option>
                <option data-id="3" data-party="Party 3" data-photo="candidate3_photo.jpg" >3</option>
                <option data-id="4" data-party="Party 4" data-photo="candidate4_photo.jpg" >4</option>
                <option data-id="5"  data-party="Party 5"data-photo="candidate5_photo.jpg" >5</option>-->
           
           <!--<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              services
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">General Election</a></li>
              <li><a class="dropdown-item" href="#">By-election</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">others</a></li>
            </ul>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="About.html">About</a>
            <li class="nav-item">
                <a style="margin-left: 500%; color: blue; font-size: 20px;"class="nav-link active"   aria-current="page" href="index.html" onclick="logout()">Logout</a>
    
             
          </li>
        </ul>
      </div>
    </div>
  </nav>
<div>
  <header>
    <h1>Contact US</h1>
  </header></div>
  </div>
  <div class="image1box">
    <header class="hbox">
        Support Query!
       <p style="font-size: 15px; color: white;"> Fill Form Below to Channel a Challenge or Issue to our support team.</p>
    </header>
    <form class="form" id="queryForm" method="POST" action="">
    <div class="form-group">
        <label for="exampleFormControlInput1">Name:</label>
        <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter your name">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Email address:</label>
        <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter email address">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Message:*</label>
        <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div><br>
    <input type="submit" class="btn btn-primary custom-submit-btn" value="submit">
</form>

      <!--<input  type="submit" class="btn btn-primary custom-submit-btn" value="submit">-->
    
</div>
<div class="image2box">
        <img src="images/kef.jpg"  class="kef" alt=""><br><br><br>
         <h5 style="color: blue; display: flow-root; font-size: xx-large; ">Contact US &#8594;</h5><br><br>
           <img src="images/bgn1.png" class="bgn1" alt="">
        
</div>

<script>
  
</script>
  <footer>
    <p>© 2024 IEBC Portal - All Rights Reserved.</p>
  </footer>
  

</body>

</html>
