<div class="">
    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">File Name</label>
                    <input type="text" name="filename" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">File Content</label>
                    <input type="file" name="file" aria-multiselectable="" class="form-control">
                </div>
                {{-- <div class="form-group">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                    </div>
                </div> --}}

                <div class="form-group">
                    <label for="">File Folder</label>
                    <select name="folder_id" id="" class="form-control" >
                        <option value="#">Select folder</option>
                        @foreach ($folders as $folder)
                            <option value="{{ $folder->id }}">{{ $folder->folder_name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="{{__('Upload File')}}" class="btn  btn-primary">
        </div>
    </form>
</div>




