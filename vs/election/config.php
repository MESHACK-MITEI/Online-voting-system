<?php

    $con = mysqli_connect("localhost", "root", "1234", "register");

    
    if(!$con)
    {
        die("Connection failed: " . mysqli_connect_error());
        
    }
       
?>