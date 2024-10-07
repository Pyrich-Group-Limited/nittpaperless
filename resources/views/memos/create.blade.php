<div class="">
    <form action="{{ route('memos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">Memo Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Memo Description</label>
                    <textarea name="description" id="" class="form-control" cols="30" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Attach File</label>
                    <input type="file" name="file" aria-multiselectable="" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="{{__('Submit')}}" class="btn  btn-primary">
        </div>
    </form>
</div>




