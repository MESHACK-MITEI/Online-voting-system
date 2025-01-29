<?php include 'includes/conn.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Positions
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Candidate Vote Counts</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Rank</th>
                    <th>Candidate ID</th>
                    <th>Name</th>
                    <th>Vote Count</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  // Query to count the number of votes for each candidate
                  $sql = "SELECT candidates.id, candidates.firstname, candidates.lastname, COUNT(president_votes.id) AS vote_count
                          FROM candidates
                          LEFT JOIN president_votes ON candidates.id = president_votes.candidate_id
                          GROUP BY candidates.id
                          ORDER BY vote_count DESC";

                  $result = $conn->query($sql);

                  if ($result && $result->num_rows > 0) {
                      // Initialize rank counter
                      $rank = 1;
                      // Output data of each row
                      while($row = $result->fetch_assoc()) {
                          ?>
                          <tr>
                            <td><?php echo $rank; ?></td>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["firstname"] . " " . $row["lastname"]; ?></td>
                            <td><?php echo $row["vote_count"]; ?></td>
                          </tr>
                          <?php
                          // Increment rank counter
                          $rank++;
                      }
                  } else {
                      ?>
                      <tr>
                        <td colspan="4">0 results</td>
                      </tr>
                      <?php
                  }

                  $conn->close();
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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
