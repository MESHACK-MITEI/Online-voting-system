<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$database = "register";

$conn = new mysqli($servername, $username, $password, $database);

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO signup (username,ID_number, email, password,password) VALUES ('$username','$IDnumber' '$email', '$password','$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Signup successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
