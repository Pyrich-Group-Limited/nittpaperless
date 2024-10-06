
<div class="">
    <form action="{{ route('memos.share',$file->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">File Name</label>
                    <input type="text" value="{{ $file->file_name }}" name="file_id" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="">Share with</label>
                    <select name="user_id" id="" class="form-control" >
                        <option value="#">Select User</option>
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



