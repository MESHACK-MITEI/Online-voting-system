<?php
    // Include your database configuration
    include('includes/conn.php');

    // Execute SELECT query
    $result = mysqli_query($conn, "SELECT * FROM signup");

    if ($result) {
        // Fetch data and prepare for display and JSON encoding
        $signupForDisplay = array();
        $signupForJSON = array();

        while ($row = mysqli_fetch_assoc($result)) {
            // Check if the 'username', 'id_number', and 'email' keys exist in the $row array
            $username = isset($row['username']) ? $row['username'] : "Name not available";
            $id_number = isset($row['id_number']) ? $row['id_number'] : "id not available";
            $email = isset($row['email']) ? $row['email'] : "Email not available";

            // Prepare data for JSON encoding
            $signupForDisplay[] = array(
                 'id_number' => $id_number,
                 'username' => $username,
                 'email' => $email,
            );

            $signupForJSON[] = $row;
        }

        // Free result set
        mysqli_free_result($result);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Fetch queries and encode them as JSON
    $jsonSignupForDisplay = json_encode($signupForDisplay);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voters Details</title>
  <!-- Include necessary CSS files -->
  <link href="AdminLTE.css" rel="stylesheet" type="text/css">
  <style>
    /* Style for the container holding the signup details */
    #signup-container {
        width: 80%; /* Adjust width as needed */
        margin: 0 auto; /* Center the container horizontally */
        text-align: center;
    }

    /* Style for the signup table */
    .signup-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        text-align: center;
         margin-left: 7rem;
    }

    /* Style for table headers */
    .signup-table th {
        background-color: #f2f2f2;
        text-align: center;
        padding: 8px;
    }

    /* Style for table rows */
    .signup-table td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    /* Style for alternate rows */
    .signup-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Style for delete button */
    .delete-btn {
        background-color: #ff0000;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
    }

    /* Style for delete button on hover */
    .delete-btn:hover {
        background-color: blue;
    }
  </style>
</head>
<body>
    <div class="wrapper">
    <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>
        <!-- Your PHP includes -->
        <h2>Voters Details</h2>
        
        <div id="signup-container">
            <!-- Table for displaying signup details -->
            <table class="signup-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>ID Number</th>
                        <th>Email</th>
                        <th>Action</th>
                        <?php
                        include('delete.php');
                        ?>
                    </tr>
                </thead>
                <tbody id="signup-table-body"></tbody>
            </table>
        </div>
    </div>
    <!-- Include necessary JavaScript files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
   document.addEventListener("DOMContentLoaded", function() {
    // Fetch customer queries from the server and display them
    fetchQueries();
});

function fetchQueries() {
    // Use the encoded JSON data directly
    const signupForDisplay = <?php echo $jsonSignupForDisplay; ?>;

    const signupTableBody = document.getElementById("signup-table-body");

    // Clear existing table rows
    signupTableBody.innerHTML = "";

    // Display queries in the table
    signupForDisplay.forEach(signup => {
        const row = document.createElement("tr");

        // Insert data into table cells
        row.innerHTML = `
            <td>${signup.username}</td>
            <td>${signup.id_number}</td>
            <td>${signup.email}</td>
            <td><button class="delete-btn" data-id="${signup.id_number}">Delete</button></td>
        `;

        signupTableBody.appendChild(row);
    });
}

// Assuming jQuery is included
$(function(){
    $(document).on('click', '.delete-btn', function(e){
        e.preventDefault();
        var id_number = $(this).data('id');

        if (id_number) {
            // Ask for confirmation before deleting the record
            if(confirm("Are you sure you want to delete this record?")) {
                // Send AJAX request to delete.php with the ID of the record to be deleted
                $.ajax({
                    url: 'delete.php',
                    method: 'POST',
                    data: { id_number: id_number },
                    success: function(response) {
                        // Check if the response contains a success message
                        if (response.trim() === "Record deleted successfully") {
                            // Refresh the table after successful deletion
                            fetchQueries();
                        } else {
                            console.error("Deletion failed: " + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error: ", xhr, status, error);
                        // Handle error if AJAX request fails
                    }
                });
            }
        } else {
            console.error("Error: No ID provided");
        }
    });
});
</script>

</body>
</html>
