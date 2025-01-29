<?php
// Include your database configuration file
include('includes/conn.php');

// Check if the ID parameter is set and not empty
if(isset($_POST['id']) && !empty($_POST['id'])) {
    // Sanitize the ID to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM queries WHERE id = '$id'";
    if(mysqli_query($conn, $sql)) {
        echo "success"; // Return success message if deletion is successful
    } else {
        echo "error"; // Return error message if deletion fails
    }
} else {
    echo "error"; // Return error message if ID parameter is missing or empty
}

// Close the database connection
mysqli_close($conn);
?>
