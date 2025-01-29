<?php
session_start();
include 'config.php'; // Ensure the database connection file is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get voter details from session
    $voterName = $_SESSION['id_number'] ?? '';
    $county = $_POST['county'] ?? '';
    $subCounty = $_POST['subCounty'] ?? '';
    $ward = $_POST['ward'] ?? '';
    $candidateId = $_POST['president'] ?? null;

    if (!$candidateId) {
        die("<script>alert('Error: No candidate selected.'); window.history.back();</script>");
    }

    // Check if the voter has already voted
    $stmt = $con->prepare("SELECT 1 FROM president_votes WHERE voter_name = ?");
    if (!$stmt) {
        die("<script>alert('Prepare failed: " . $con->error . "'); window.history.back();</script>");
    }
    $stmt->bind_param("s", $voterName);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('You have already voted. You cannot vote again.'); window.history.back();</script>";
    } else {
        // Insert vote
        $sql_insert_vote = "INSERT INTO president_votes (voter_name, county, sub_county, ward, candidate_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert_vote);

        if (!$stmt) {
            die("<script>alert('Prepare failed: " . $conn->error . "'); window.history.back();</script>");
        }
        
        $stmt->bind_param("ssssi", $voterName, $county, $subCounty, $ward, $candidateId);

        if ($stmt->execute()) {
            echo "<script>alert('Vote submitted successfully!'); window.location.href='thank_you.php';</script>";
        } else {
            echo "<script>alert('Error submitting vote: " . $stmt->error . "'); window.history.back();</script>";
        }
    }
    
    $stmt->close();
}
 


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kenya Online National Election Services</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="cast.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img class="img1" src="images/bgn1.png" alt="">
    <img class="img" src="images/seal.jpg" alt="">
    <div class="container">
      <a class="navbar-brand" href="#"> <b>Self Service Portal |</b> IEBC</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html">Home</a>
            </li>
           
           <!--<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              services
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">General Election</a></li>
              <li><a class="dropdown-item" href="#">By-election</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">others</a></li>
            </ul>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="About.html">About</a>
            <li class="nav-item">
                <a style="margin-left: 500%; color: blue; font-size: 20px;"class="nav-link active"   aria-current="page" href="index.html" onclick="logout()">Logout</a>
    
             
          </li>
        </ul>
      </div>
    </div>
    </nav>

    <div>
        <header>
            <h1>Vote Here!</h1>
        </header>
    </div>

    <div class="my-boxes">
        <div class="image2box">
        <div class="animated-images">
<img src="images/kef.png"  class="kef" alt=""><br>
 <h3 style="color: blue; display: flow-root; font-size: xx-large;">Vote here &#8594;</h3>
   <img src="images/bgn1.png" class="bgn1" alt=""><br>
   <img src="images/kef.png"  class="kef" alt=""><br>
 <h3 style="color: blue; display: flow-root; font-size: xx-large;">Vote here &#8594;</h3>
   <img src="images/bgn1.png" class="bgn1" alt="">
  </div>
        </div>
        <div class="image1box">
            <h5><b>Select your location:</b></h5>
            <form class="form" id="voteForm" method="post">
                <div class="form-row">
                    <!-- Location selection fields -->
                    <div class="col" id="countyForm">
                        <label for="exampleFormControlSelect1">County</label>
                        <select class="form-control" id="active" name="county" onchange="populateSubCounties()" required>
                            <option value="select county">Select County</option>
                            <option value="Bomet">Bomet</option>
                <option value="Bungoma">Bungoma</option>
                <option value="Busia">Busia</option>
                <option value="Elgeyo Marakwet">Elgeyo Marakwet</option>
                <option value="Embu">Embu</option>
                <option value="Garissa">Garissa</option>
                <option value="Homa Bay">Homa Bay</option>
                <option value="Isiolo">Isiolo</option>
                <option value="Kajiado">Kajiado</option>
                <option value="Kakamega">Kakamega</option>
                <option value="Kericho">Kericho</option>
                <option value="Kiambu">Kiambu</option>
                <option value="Kilifi">Kilifi</option>
                <option value="Kirinyaga">Kirinyaga</option>
                <option value="Kisii">Kisii</option>
                <option value="Kisumu">Kisumu</option>
                <option value="Kitui">Kitui</option>
                <option value="Kwale">Kwale</option>
                <option value="Laikipia">Laikipia</option>
                <option value="Lamu">Lamu</option>
                <option value="Machakos">Machakos</option>
                <option value="Makueni">Makueni</option>
                <option value="Mandera">Mandera</option>
                <option value="Marsabit">Marsabit</option>
                <option value="Meru">Meru</option>
                <option value="Migori">Migori</option>
                <option value="Mombasa">Mombasa</option>
                <option value="Murang'a">Murang'a</option>
                <option value="Nairobi">Nairobi</option>
                <option value="Nakuru">Nakuru</option>
                <option value="Nandi">Nandi</option>
                <option value="Narok">Narok</option>
                <option value="Nyamira">Nyamira</option>
                <option value="Nyandarua">Nyandarua</option>
                <option value="Nyeri">Nyeri</option>
                <option value="Samburu">Samburu</option>
                <option value="Siaya">Siaya</option>
                <option value="Taita Taveta">Taita Taveta</option>
                <option value="Tana River">Tana River</option>
                <option value="Tharaka Nithi">Tharaka Nithi</option>
                <option value="Trans Nzoia">Trans Nzoia</option>
                <option value="Turkana">Turkana</option>
                <option value="Uasin Gishu">Uasin Gishu</option>
                <option value="Vihiga">Vihiga</option>
                <option value="Wajir">Wajir</option>
                <option value="West Pokot">West Pokot</option>
                        </select>
                    </div>
                    <div class="col" id="subCountyForm">
                        <label for="subCountySelect">Sub-County</label>
                        <select class="form-control" id="subCountySelect" name="subCounty" onchange="populateWards()" required>
                            <option>Select Sub-County</option>
                            <!-- Options populated dynamically with JavaScript -->
                        </select>
                    </div>
                    <div class="col">
                        <label for="wardSelect">Ward</label>
                        <select class="form-control" id="wardSelect" name="ward" required>
                            <option>Select Ward</option>
                            <!-- Options populated dynamically with JavaScript -->
                        </select>
                    </div>
                </div>
                <input type="hidden" readonly id="voterName" name="voterName" value="<?php echo isset($_SESSION['id_number']) ? $_SESSION['id_number'] : ''; ?>">

                <h4><b>Select the Candidate of your choice:</b></h4>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Party</th>
                            <th>Photo</th>
                            <th>Vote</th>
                        </tr>
                    </thead>
                    <tbody>
                  
<!--Fetch candidates from the database-->
<?php $sql = "SELECT * FROM candidates"; // Modify the table name if different
$result = $con->query($sql);

$candidates = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $candidates[] = $row;
    }
}
?>
<tbody>
    <?php foreach ($candidates as $candidate): ?>
        <tr>
            <td><?php echo htmlspecialchars($candidate['id']); ?></td>
            <td><?php echo htmlspecialchars($candidate['firstname'] . ' ' . $candidate['lastname']); ?></td>
            <td><?php echo htmlspecialchars($candidate['party']); ?></td>
            <td><img class="candidate-photo" src="../Admin/uploads/<?php echo htmlspecialchars($candidate['photo']); ?>" alt="Candidate Photo"></td>
            <td><input type="radio" name="president" value="<?php echo htmlspecialchars($candidate['id']); ?>"></td>
        </tr>
    <?php endforeach; ?>
</tbody>

                </table>
                <br>
                <input type="submit" class="btn btn-primary custom-submit-btn" value="Submit Vote" onclick="submitForm()">
            </form>
        </div>
    </div>

    <div id="successMessage" style="display: none;"></div>

    <footer>
        <p>© 2024 IEBC Portal - All Rights Reserved.</p>
    </footer>

    <script>
       function submitForm() {
            var alreadyVoted = <?php echo ($result->num_rows > 0) ? 'true' : 'false'; ?>;
            if (alreadyVoted) {
                alert('You have already voted. You cannot vote again.');
                return false;
            }}
     function populateSubCounties() {
    var countySelect = document.getElementById('active');
    var subCountySelect = document.getElementById('subCountySelect');
    var wardSelect = document.getElementById('wardSelect');
    // Clear existing options
    subCountySelect.innerHTML = '';
    wardSelect.innerHTML = '';
    // Fetch sub-counties based on the selected county (replace with your data)
    var selectedCounty = countySelect.value;
    // Static example sub-county data (replace with dynamic data from server)
    var subCountyData = {
        Nairobi: ['Westlands', 'Kasarani', 'Embakasi', 'Langata', 'Starehe', 'Mathare', 'Kibra', 'Dagoretti', 'Makadara', 'Kamukunji', 'Roysambu', 'Ruaraka'],
        Bomet: ['Chepalungu', 'Sotik', 'Konoin'],
        // Add more county-subcounty mappings as needed
    };
    // Populate sub-county options
    if (subCountyData[selectedCounty]) {
        subCountyData[selectedCounty].forEach(function(subCounty) {
            var option = document.createElement('option');
            option.value = subCounty;
            option.text = subCounty;
            subCountySelect.add(option);
        });
    }
    // Trigger the population of wards based on the selected sub-county
    populateWards();
}

function populateWards() {
    var subCountySelect = document.getElementById('subCountySelect');
    var wardSelect = document.getElementById('wardSelect');

    // Clear existing options
    wardSelect.innerHTML = '';

    // Fetch wards based on the selected sub-county (replace with your data)
    var selectedSubCounty = subCountySelect.value;

    // Static example ward data (replace with dynamic data from server)
    var wardData = {
        Westlands: ['Runda', 'LakeView', 'Muthaiga'],
        Kasarani: ['Windsor', 'ClayCity', 'Sunset'],
        Embakasi: ['Pipeline', 'Taj Mall', 'Fedha'],
        Langata: ['Karen', 'South C', 'Nyayo'],
        Starehe: ['Central', 'Pangani', 'Ngara'],
        Mathare: ['Mabatini', 'Huruma', 'Kosovo'],
        Kibra: ['Woodley', 'Lindi', 'Makina'],
        Dagoretti: ['Kileleshwa', 'Lavington', 'Kawangware'],
        Makadara: ['Maringo', 'Hamza', 'California'],
        Kamukunji: ['Eastleigh', 'Pumwani', 'Kariokor'],
        Roysambu: ['Githurai', 'Kahawa West', 'Zimmerman'],
        Ruaraka: ['Babadogo', 'Lucky Summer', 'Kasarani'],
        Chepalungu: ['Sigor', 'Kongasis', 'Chebunyo', 'Nyongores', 'Siongiroi'],
        Sotik: ['Ndanai/Abosi', 'Kipsonoi', 'Kapletundo', 'Chemagel', 'Manaret/Rongena'],
        Konoin: ['Kimulot', 'Mogogosiek', 'Boito', 'Embomos', 'Chepchabas'],
    };

    if (wardData[selectedSubCounty]) {
        wardData[selectedSubCounty].forEach(function(ward) {
            var option = document.createElement('option');
            option.value = ward;
            option.text = ward;
            wardSelect.add(option);
        });
    }
}

function submitForm() {
    var voterName = document.getElementById('voterName').value;
    var presidentSelect = document.querySelector('input[name="president"]:checked');

    if (!presidentSelect) {
        alert('Please select a candidate.');
        return;
    }

    var candidateId = presidentSelect.value;

    // Set the voter name and candidate ID in hidden input fields
    document.getElementById('voterNameInput').value = voterName;
    document.getElementById('presidentDataInput').value = candidateId;

    // Continue with form submission
    document.getElementById('voteForm').submit();
}

document.getElementById("submitBtn").addEventListener("click", function(event) {
        validateForm();
    });

    function validateForm() {
        var county = document.getElementById("active").value;
        var subCounty = document.getElementById("subCountySelect").value;
        var ward = document.getElementById("wardSelect").value;
        var candidateSelected = document.querySelector('input[name="president"]:checked');

        if (county === "" || subCounty === "" || ward === "") {
            alert("Please select County, Sub-County, and Ward.");
            return false;
        }

        if (!candidateSelected) {
            alert("Please select a candidate.");
            return false;
        }

        // If all validations pass, the form is submitted
        document.getElementById("voteForm").submit();
    }

    </script>
</body>

</html>
