<?php
    // ... Your PHP code for fetching data from the database remains unchanged
    include('includes/conn.php'); // Include your database configuration

    // Execute SELECT query
    $result = mysqli_query($conn, "SELECT * FROM queries");

    if ($result) {
        // Fetch data and prepare for display and JSON encoding
        $queriesForDisplay = array();
        $queriesForJSON = array();

        while ($row = mysqli_fetch_assoc($result)) {
            // Check if the 'name' key exists in the $row array
            $name = isset($row['name']) ? $row['name'] : "Name not available";
            $email = isset($row['email']) ? $row['email'] : "Email not available";
            $message = isset($row['message']) ? $row['message'] : "Message not available";

            // Prepare data for JSON encoding
            $queriesForDisplay[] = array(
                'name' => $name,
                'email' => $email,
                'message' => $message
            );

            $queriesForJSON[] = $row;
        }

        // Free result set
        mysqli_free_result($result);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);

    // Fetch queries and encode them as JSON
    $jsonQueriesForDisplay = json_encode($queriesForDisplay);
    $jsonQueries = json_encode($queriesForJSON);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your HTML head content remains unchanged -->
    <link href="AdminLTE.css" rel="stylesheet" type="text/css">
</head>
 
<body>
    <div class="wrapper">
        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <h2>Customer Queries</h2>
        
        <div id="queries-container"></div>
    </div>
    <?php include 'includes/scripts.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch customer queries from the server and display them
            fetchQueries();
        });

        function fetchQueries() {
            // Use the encoded JSON data directly
            const queriesForDisplay = <?php echo $jsonQueriesForDisplay; ?>;

            const queriesContainer = document.getElementById("queries-container");

            // Display queries in the HTML
            queriesForDisplay.forEach(query => {
                const queryDiv = document.createElement("div");
                queryDiv.id = `query-${query.email}`; // Set the container ID using the email
                queryDiv.className = "query";
                queryDiv.innerHTML = `
                    <strong>Name:</strong> ${query.name}<br>
                    <strong>Email:</strong> ${query.email}<br>
                    <strong>Message:</strong> ${query.message}
                    <button class="btn btn-danger btn-sm delete" onclick="deleteQuery('${query.email}')">Delete</button>
                 `;
                queriesContainer.appendChild(queryDiv);
            });
        }

        function deleteQuery(email) {
            // Confirm deletion with user (optional)
            if (confirm('Are you sure you want to delete this query?')) {
                // AJAX request to delete_query.php
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Handle success response (e.g., remove deleted query from UI)
                            document.getElementById("query-" + email).remove();
                            alert('Query deleted successfully.');
                        } else {
                            // Handle error response (e.g., display error message)
                            alert('Error deleting query: ' + xhr.responseText);
                        }
                    }
                };
                xhr.open("POST", "delete_query.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("email=" + email); // Send the email as data
            }
        }
    </script>
</body>
</html>
