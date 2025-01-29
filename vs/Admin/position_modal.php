<!-- Add Position Modal -->
<div id="addnew" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Position</h4>
      </div>
      <div class="modal-body">
        <form id="add_position_form" action="add_position.php" method="post">
          <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" id="description" name="description" required>
          </div>
          <div class="form-group">
            <label for="max_vote">Maximum Vote:</label>
            <input type="number" class="form-control" id="max_vote" name="max_vote" required>
          </div>
          <button type="submit" class="btn btn-primary">Add Position</button>
        </form>
      </div>
    </div>
  </div>
</div>
