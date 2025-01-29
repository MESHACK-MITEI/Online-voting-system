<?php
// Start the session (if not already started)
session_start();

// Check if the user is logged in and the user data is stored in the session
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
} else {
    // Handle the case when the user is not logged in or user data is not available
    // You might redirect the user to the login page or perform other actions.
    // For now, let's set a default user for testing purposes.
    /*$user = [
        'firstname' => '',
        'lastname' => '',
        'photo' => '',
        'created_on' => date('Y-m-d'),
    ];*/
}

// Rest of your code...
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Online Voting System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="AdminLTE.css" rel="stylesheet" type="text/css"></head>
 
<body>

<header class="main-header">
<!--<img src="images/bgn1.jpg" class="imgb" alt="">
<img src="images/seal.jpg" class="imgs" alt="">-->


  <!-- Logo -->
  <a href="dashboard.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b style="color: white;">M</b><b style="color: white;">K</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg" style="color: white; font: size 50px;"  ><b>Voting System</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only" style="color: white;">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        
            <li class="user-footer">
              <div class="pull-right">
                <a href="index.php" class="btn btn-default btn-flat"><b>Sign out</b></a>
              </div>
        </li>
      </ul>
    </div>
  </nav>
</header>
<?php include 'includes/profile_modal.php'; ?>