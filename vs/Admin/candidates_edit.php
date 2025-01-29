<?php
// DB Connection
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "register";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID not provided.";
    exit;
}

// Retrieve candidate information based on ID
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM candidates WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$candidate = $result->fetch_assoc();
$stmt->close();

// Check if candidate exists
if (!$candidate) {
    echo "Candidate not found.";
    exit;
}

// Check if form is submitted for editing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update candidate information
    $position = $_POST['position'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $party = $_POST['party'];

    // Handle photo update
    if (!empty($_FILES['photo']['name'])) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["photo"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (in_array($fileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
                // Update photo file name in the database
                $photo = $fileName;
            } else {
                echo "Error uploading photo.";
                exit;
            }
        } else {
            echo "Invalid photo format.";
            exit;
        }
    } else {
        // Keep the existing photo if no new photo is uploaded
        $photo = $candidate['photo'];
    }

    // Update candidate information in the database
   // Update candidate information in the database
$stmt = $conn->prepare("UPDATE candidates SET id = ?, position = ?, firstname = ?, lastname = ?, photo = ?, party = ? WHERE id = ?");
$stmt->bind_param("isssssi", $id, $position, $firstname, $lastname, $photo, $party, $id);

    if ($stmt->execute()) {
		header("Location: candidates.php");
        echo "Candidate updated successfully.";
    } else {
        echo "Error updating candidate: " . $conn->error;
    }
    $stmt->close();
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Candidate - Online Voting System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        form {
            background-color: #ffffff;
            max-width: 800px;
            margin: 0 auto;
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
            margin-top: 8px;
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
    </style>
</head>
<body>
<h2>Edit Candidate</h2>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $id); ?>" method="post" enctype="multipart/form-data">
    <label>ID:</label>
    <input type="text" name="id" value="<?php echo $candidate['id']; ?>" required><br>
    <label>Position:</label>
    <input type="text" name="position" value="<?php echo $candidate['position']; ?>" required><br>
    <label>First Name:</label>
    <input type="text" name="firstname" value="<?php echo $candidate['firstname']; ?>" required><br>
    <label>Last Name:</label>
    <input type="text" name="lastname" value="<?php echo $candidate['lastname']; ?>" required><br>
    <label>Current Photo:</label><br>
    <img src="uploads/<?php echo $candidate['photo']; ?>" alt="Current Photo" style="max-width: 200px;"><br>
    <label>New Photo:</label>
    <input type="file" name="photo"><br>
    <label>Party:</label>
    <textarea name="party"><?php echo $candidate['party']; ?></textarea><br>
    <button type="submit">Update Candidate</button>
</form>
</body>
</html>

<?php
