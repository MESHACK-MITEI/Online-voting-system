<!-- positions_modal.php -->
<!-- Add New Modal -->
<div id="addnew" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Position</h4>
            </div>
            <div class="modal-body">
                <form id="addForm" action="add_position.php" method="POST">
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

<!-- Edit Modal -->
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Position</h4>
            </div>
            <div class="modal-body">
                <form id="editForm" action="edit_position.php" method="POST">
                    <input type="hidden" class="id" name="id">
                    <div class="form-group">
                        <label for="edit_description">Description:</label>
                        <input type="text" class="form-control" id="edit_description" name="description" required>
                    </div>
                    <div class="form-group">
                       
