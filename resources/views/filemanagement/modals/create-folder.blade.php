<div class="">
    <form action="{{ route('folders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">Folder Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="parent_id">Parent Folder (Optional)</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="">None</option>
                        @foreach($folders as $folder)
                            <option value="{{ $folder->id }}">{{ $folder->folder_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="{{__('Create Folder')}}" class="btn  btn-primary">
        </div>
    </form>
</div>



