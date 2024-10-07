
<div class="">
    <form action="{{ route('memos.share', $memo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">Memo Title</label>
                    <input type="text" disabled value="{{ $memo->title }}" name="file_id" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="">Share with</label>
                    <select name="shared_with" id="shared_with" class="form-control">
                        <option value="#">---Select---</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="{{__('Share')}}" class="btn  btn-primary">
        </div>
    </form>
</div>



