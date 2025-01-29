const registerLink = document.querySelector('. register-link');
const btnPopup = document.querySelector('. btnLogin-popup');
const iconClose = document.querySelector('.icon-close');
registerLink.addEventListener('click', () => { wrapper.classList.add('active');
});
loginLink.addEventListener('click', () => { wrapper.classList.remove('active');
});
btnPopup.addEventListener('click', () => {
wrapper.classList.add('active-popup');
});
iconClose.addEventListener('click', () => { wrapper.classList.remove('active-popup');
});
I
/*<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
      background-image: url("");
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
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
      margin-top: 1rem;
      margin-bottom: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .logo {
      width: 100px;
      height: 100px;
      border-radius: 50%;
    }
    footer {
      height: 50px;
      padding: 10px;
      background-color: #f0f0f0;
      text-align: center;
      font-size: 14px;
    }

    </style>
</head>
<header>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="hm.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
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
</header>
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
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
    <h1>welcome to IEBC online services</h1>
    <h2> </h2>
    <div>
      <footer>
        <p>© 2024 IEBC Portal - All Rights Reserved.</p>
      </footer>
    </div>
    
    
</body>
</html>*/