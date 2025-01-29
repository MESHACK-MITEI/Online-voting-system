<?php
// Include your database configuration
include('includes/conn.php');

// Check if the 'id_number' parameter is set in the POST request
if(isset($_POST['id_number'])) {
    // Sanitize the input to prevent SQL injection
    $id_number = mysqli_real_escape_string($conn, $_POST['id_number']);

    // SQL query to delete the record with the given ID
    $sql = "DELETE FROM signup WHERE id_number = '$id_number'";

    if(mysqli_query($conn, $sql)) {
        // Return success message if deletion is successful
        echo "Record deleted successfully";
    } else {
        // Return error message if deletion fails
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Return error message if 'id_number' parameter is not set
    echo "Error: ID not provided";
}

// Close connection
mysqli_close($conn);
?>
