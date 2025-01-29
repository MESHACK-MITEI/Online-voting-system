<?php
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

$sql = "SELECT id, CONCAT(firstname, ' ', lastname) AS name, photo, party FROM candidates WHERE position = 'president'";
$result = $conn->query($sql);

$candidates = [];

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $candidates[] = $row;
    }
} else {
    echo "0 results";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $presidentData = json_decode($_POST['presidentData'], true);
    $sql_insert = "INSERT INTO president (president_id, name, party, photo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("isss", $presidentData['id'], $presidentData['name'], $presidentData['party'], $presidentData['photo']);
        if ($stmt->execute()) {
        echo '<script>document.getElementById("successMessage").innerHTML = "President data inserted successfully!"; document.getElementById("successMessage").style.display = "block";</script>';
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>
<?php
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch Candidates for Display
$candidates = [];
try {
    $result = $conn->query("SELECT * FROM candidates WHERE position='president'");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $candidates[] = $row;
        }
    }
} catch (mysqli_sql_exception $e) {
    $message = "Error fetching candidates: " . $e->getMessage();
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
            <a class="nav-link active" aria-current="page" href="hm.html">Home</a>
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
            <a class="nav-link" href="contact.html">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="About.html">About</a>
            <li class="nav-item">
                <a style="margin-left: 500%; color: blue; font-size: 20px;"class="nav-link active"   aria-current="page" href="hm.html" onclick="logout()">Logout</a>
    
             
          </li>
        </ul>
      </div>
    </div>
  </nav>
<div>
  <header>
    <h1>Vote Here!</h1>
  </header></div>
  </div>
 <div class="my-boxes">
 <div class="image2box">
  <div class="animated-images">
<img src="images/kef.png"  class="kef" alt=""><br>
 <h3 style="color: blue; display: flow-root; font-size: xx-large;">Vote here &#8594;</h3>
   <img src="images/bgn1.png" class="bgn1" alt="">
  </div>
</div>
  <div class="image1box">
    <h5><b>Select your location:</b></h5>
    <form class="form" onsubmit="event.preventDefault(); verification();">
    <div class="form-row">
    <div class="col" id="countyForm">
            <label for="exampleFormControlSelect1">County </label>
            <select class="form-control" id="active" name="county" onchange="populateSubCounties()">
            <option value="select county">select county</option>
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
            <label for="subCountySelect">Sub-County </label>
            <select class="form-control" id="subCountySelect" name="subCounty" onchange="populateWards()">
              <option></option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
          <div class="col">
            <label for="wardSelect">Ward </label>
            <select class="form-control" id="wardSelect" name="ward">
              
            </select>
          </div>
        </div>
        <input type="hidden" id="presidentDataInput" name="presidentData" value="">

      </form><br>
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
        <?php foreach ($candidates as $candidate): ?>
            <tr>
                <td><?php echo htmlspecialchars($candidate['id']); ?></td>
                <td><?php echo htmlspecialchars($candidate['firstname'] . ' ' . $candidate['lastname']); ?></td>
                <td><?php echo htmlspecialchars($candidate['party']); ?></td>
                <td><img class="candidate-photo" src="uploads/<?php echo htmlspecialchars($candidate['photo']); ?>" alt="Candidate Photo"></td>
                <td><input type="radio" name="president" value="<?php echo htmlspecialchars($candidate['id']); ?>"></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<input  type="submit" class="btn btn-primary custom-submit-btn" value="submit">
</div>
 </div>
<div id="successMessage" style="display: none;"></div>
       </div><br><br>
      </form><br><br>
     <script>
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
          Bomet: ['Chepalungu','Sotik', 'Konoin',],
          select_county:['select sub-county'],
            // Add more county-subcounty mappings as needed
        };
        // Populate sub-county options
        if (subCountyData[selectedCounty]) {
            subCountyData[selectedCounty].forEach(function (subCounty) {
                var option = document.createElement('option');
                option.value = subCounty;
                option.text = subCounty;
                subCountySelect.add(option);
            });
        }        // Trigger the population of wards based on the selected sub-county
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
          Westlands: ['Runda','LakeView', 'Muthaiga'],
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
          
         select_Sub_County:['select ward'],
        };
          if (wardData[selectedSubCounty]) {
            wardData[selectedSubCounty].forEach(function (ward) {
                var option = document.createElement('option');
                option.value = ward;
                option.text = ward;
                wardSelect.add(option);
            });
        }
    }

     populateSubCounties();
   
</script>
<script>
    function submitForm() {
        var countySelect = document.getElementById('active');
        var subCountySelect = document.getElementById('subCountySelect');
        var wardSelect = document.getElementById('wardSelect');
        var presidentSelect = document.getElementById('exampleFormControlSelect1');

        // Check if any of the select elements have null values
        if (countySelect.value === 'select county' || subCountySelect.value === '' || wardSelect.value === '' || presidentSelect.value === '') {
            alert('Please select a location and candidate.');
            return false;
        }

        // Extract candidate data attributes
        var selectedOption = presidentSelect.options[presidentSelect.selectedIndex];
        var candidateId = selectedOption.value;
        var candidateName = selectedOption.getAttribute('data-name');
        var candidateParty = selectedOption.getAttribute('data-party');
        var candidatePhoto = selectedOption.getAttribute('data-photo');

        // Create an object with candidate data
        var candidateData = {
            id: candidateId,
            name: candidateName,
            party: candidateParty,
            photo: candidatePhoto
        };

        // Convert the object to a JSON string
        var candidateJson = JSON.stringify(candidateData);

        // Set the JSON string as the value of the hidden input field
        document.getElementById('presidentDataInput').value = candidateJson;

        // Continue with form submission
        return true;
    }
</script>
</div>

  <footer>
    <p>© 2024 IEBC Portal - All Rights Reserved.</p>
  </footer>

</body>

</html>