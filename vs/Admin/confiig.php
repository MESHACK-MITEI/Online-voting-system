<?php

    $con = mysqli_connect("localhost", "root", "1234", "register");

    //Checking connection
    if(!$con)
    {
        die("Connection failed: " . mysqli_connect_error());
        
    }
       
?>