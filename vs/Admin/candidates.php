<?php
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// DB Connection
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "register";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to add a candidate
function addCandidate($conn, $data, $file) {
    $targetDir = "uploads/";
    $fileName = basename($file["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
    // Check if id_number is provided and not empty
    if (isset($data['id']) && !empty($data['id'])) {
        if (in_array($fileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                $stmt = $conn->prepare("INSERT INTO candidates (id, position, firstname, lastname, photo, party) VALUES (?,?,?,?,?,?)");
                $stmt->bind_param("iissss", $data['id'], $data['position'], $data['firstname'], $data['lastname'], $fileName, $data['party']);

                if ($stmt->execute()) {
                    return "Candidate added successfully.";
                } else {
                    return "Error: Unable to execute the query.";
                }
            } else {
                return "Error uploading file.";
            }
        } else {
            return "Invalid file format.";
        }
    } else {
        return "ID Number is required.";
    }
}

// Check Operation Type
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['operation']) && $_POST['operation'] == "add") {
    $message = addCandidate($conn, $_POST, $_FILES['photo']);
}

// Fetch Candidates for Display
$candidates = [];
try {
    $result = $conn->query("SELECT * FROM candidates");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $candidates[] = $row;
        }
    }
} catch (mysqli_sql_exception $e) {
    $message = "Error fetching candidates: " . $e->getMessage();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Online Voting System</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        form {
            background-color: #ffffff;
            max-width: 800px;
            margin-left:15rem;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px 0 rgba(0,0,0,0.1);
        }

        form label {
            font-weight: bold;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form input[type="file"] {
            margin: 8px 0;
        }

        button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            color: red;
        }

        .candidate-photo {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
<div class="wrapper">
<?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>
    
    <div id="Candidates-container">
        <?php if($message) echo "<p>$message</p>"; ?>
        
        <h2>Add Candidate</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="operation" value="add">
            <label>ID Number:</label><input type="text" name="id" required><br>
            <label>Position:</label><input type="text" name="position" required><br>
            <label>First Name:</label><input type="text" name="firstname" required><br>
            <label>Last Name:</label><input type="text" name="lastname" required><br>
            <label>Photo:</label><input type="file" name="photo" required><br>
            <label>Party:</label><textarea name="party"></textarea><br>
            <button type="submit">Add Candidate</button>
        </form>

        <h2>Candidates List</h2>
        <table>
            <tr>
                <th>ID NUMBER</th>
                <th>Position</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Photo</th>
                <th>Party</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($candidates as $candidate): ?>
    <tr>
        <td><?php echo isset($candidate['id']) ? htmlspecialchars($candidate['id']) : ''; ?></td>
        <td><?php echo htmlspecialchars($candidate['position']); ?></td>
        <td><?php echo htmlspecialchars($candidate['firstname']); ?></td>
        <td><?php echo htmlspecialchars($candidate['lastname']); ?></td>
        <td><img class="candidate-photo" src="uploads/<?php echo htmlspecialchars($candidate['photo']); ?>" alt="Candidate Photo"></td>
        <td><?php echo htmlspecialchars($candidate['party']); ?></td>
        <td>
            <a href="candidates_edit.php?id=<?php echo isset($candidate['id']) ? $candidate['id'] : ''; ?>">Edit</a> | 
            <a href="candidates_delete.php?id=<?php echo isset($candidate['id']) ? $candidate['id'] : ''; ?>" onclick="return confirm('Are you sure you want to delete this candidate?')">Delete</a>
        </td>
    </tr>
<?php endforeach; ?>

        </table>
    </div>
</div>
</body>
</html>

 