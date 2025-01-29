<?php
// DB Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the candidate ID is provided through GET parameter
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare and execute the SQL statement to delete the candidate
    $stmt = $conn->prepare("DELETE FROM candidates WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Candidate deleted successfully.";
    } else {
        echo "Error deleting candidate: " . $conn->error;
    }
} else {
    echo "Invalid candidate ID.";
}

// Close connection
$conn->close();
header('location: candidates.php');
?>
