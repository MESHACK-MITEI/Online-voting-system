<?php
// Replace these variables with your actual database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'your_database';

// Create a connection to the MySQL database
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to create the table
$query = "CREATE TABLE IF NOT EXISTS voted_status (
    user_id INT PRIMARY KEY,
    voted_president BOOLEAN DEFAULT 0,
    voted_governor BOOLEAN DEFAULT 0,
    voted_senator BOOLEAN DEFAULT 0,
    voted_representative BOOLEAN DEFAULT 0,
    voted_mp BOOLEAN DEFAULT 0,
    voted_mca BOOLEAN DEFAULT 0
)";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the table creation was successful
if ($result) {
    echo "Table 'voted_status' created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
