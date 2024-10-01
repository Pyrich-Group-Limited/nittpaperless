<div class="">
    <form action="{{ route('folders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">Folder Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="{{__('Create Folder')}}" class="btn  btn-primary">
        </div>
    </form>
</div>



