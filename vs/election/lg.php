<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic PHP and HTML Example</title>
</head>
<body>
<?php
$host = ' root';
$db   = 'user';
$user = ' ';
$pass = ' ';

 
$conn = new mysqli($host, $user, $pass, $db);

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo 'Connected to the database!';

 
$conn->close();
?>
</body>
</html>