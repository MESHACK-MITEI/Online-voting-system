<?php
// Include your database configuration
include('includes/conn.php');

// Check if the ID parameter is provided in the POST request
if (isset($_POST['id'])) {
    $queryId = $_POST['id'];

    // Prepare and execute the DELETE query
    $deleteQuery = "DELETE FROM queries WHERE id = $queryId";
    $result = mysqli_query($conn, $deleteQuery);

    // Check if the deletion was successful
    if ($result) {
        $response = ['success' => true, 'message' => 'Query deleted successfully'];
    } else {
        $response = ['success' => false, 'message' => 'Error deleting query: ' . mysqli_error($conn)];
    }

    // Close the database connection
    mysqli_close($conn);

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If ID is not provided, return an error response
    $response = ['success' => false, 'message' => 'Query ID not provided'];
    header('Location: query.php');
    echo json_encode($response);
}
?>
