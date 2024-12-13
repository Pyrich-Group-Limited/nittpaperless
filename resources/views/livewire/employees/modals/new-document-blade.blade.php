<div class="modal" id="newfile" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newfile">Create New Document</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="form-group">
                                <label for="">Document Name</label>
                                <input type="text" name="filename" value="{{ old('filename')}}" class="form-control" >
                                @error('filename')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Document Content</label>
                                <input type="file" name="file" aria-multiselectable="" value="{{ old('file')}}" class="form-control" >
                                @error('file')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
                        <input type="submit" value="{{__('Upload Document')}}" class="btn  btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



{{-- <div class="">
    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="form-group">
                    <label for="">File Name</label>
                    <input type="text" name="filename" value="{{ old('filename')}}" class="form-control" >
                    @error('filename')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">File Content</label>
                    <input type="file" name="file" aria-multiselectable="" value="{{ old('file')}}" class="form-control" >
                    @error('file')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">File Folder</label>
                    <select name="folder_id" id="" class="form-control" >
                        <option value="">Select folder (optional)</option>
                        @foreach ($folders as $folder)
                            <option value="{{ $folder->id }}">{{ $folder->folder_name }}</option>
                        @endforeach
                    </select>
                    @error('folder_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="{{__('Upload File')}}" class="btn  btn-primary">
        </div>
    </form>
</div> --}}




