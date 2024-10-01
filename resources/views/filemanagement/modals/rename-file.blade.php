<div class="">
    <form action="{{ route('files.rename') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
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
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="{{__('Rename File')}}" class="btn  btn-primary">
        </div>
    </form>
</div>




