
<div class="">
    <form action="{{ route('files.share',$file->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">Document Name</label>
                    <input type="text" value="{{ $file->file_name }}" name="file_id" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="">Share with: (<span class="text-xs text-muted">{{ __('You can select one or more users to share document with')}}</span>) </label>
                    <select name="user_id[]" id="choices-multiple1" class="form-control select2" multiple>
                        <option value="#">Select one or more Users</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="{{__('Share')}}" class="btn  btn-primary">
        </div>
    </form>
</div>



