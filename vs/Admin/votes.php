<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "register";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard - Online Voting System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="AdminLTE.css" rel="stylesheet" type="text/css"></head> 
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Votes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <?php

        // Query to count the number of votes for each candidate
        $sql = "SELECT candidates.id, candidates.firstname, candidates.lastname, COUNT(president_votes.id) AS vote_count
                FROM candidates
                LEFT JOIN president_votes ON candidates.id = president_votes.candidate_id
                GROUP BY candidates.id";

        $result = $con->query($sql);

        if ($result && $result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title"><?php echo "Candidate ID: " . $row["id"]; ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <p><?php echo "Name: " . $row["firstname"] . " " . $row["lastname"]; ?></p>
                      <p><?php echo "Vote Count: " . $row["vote_count"]; ?></p>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <?php
            }
        } else {
            echo "0 results";
        }

        $con->close();
        ?>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/positions_modal.php'; ?>
</div>
<!-- ./wrapper -->
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'positions_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_description').val(response.description);
      $('#edit_max_vote').val(response.max_vote);
      $('.description').html(response.description);
    }
  });
}
</script>
</body>
</html>

