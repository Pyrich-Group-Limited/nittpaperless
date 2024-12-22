<div class="modal fade" id="createSubFolderModal" tabindex="-1" role="dialog" aria-labelledby="createSubFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('folder.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSubFolderModalLabel">Create Subfolder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Folder Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <input type="hidden" name="parent_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
