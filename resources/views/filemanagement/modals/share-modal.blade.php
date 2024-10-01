
{{-- <div class="">
    <form action="{{ route('files.share') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">File Name</label>
                    <input type="text" name="filename" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Share with</label>
                    <select name="folder_id" id="" class="form-control" >
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
</div> --}}

<div class="modal fade" id="shareFileModal" tabindex="-1" role="dialog" aria-labelledby="shareFileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareFileModalLabel">Share File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="shareFileForm" method="POST">
                @csrf
                @method('GET')

                <div class="modal-body">
                    <p id="fileName"></p> <!-- File name dynamically populated -->
                    <div class="form-group">
                        <label for="user_id">Select User to Share With:</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="#">---Select---</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Share</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@section('scripts')
<script>
    // Handle the share button click
    $(document).on('click', '.btn-share-file', function () {
        var fileName = $(this).data('file_name');
        var fileId = $(this).data('file-id');

        // Update the file name in the modal
        $('#fileName').text('Share file: ' + fileName);

        // Update the form action with the correct file ID
        var action = "{{ route('files.share', ':file_id') }}";
        action = action.replace(':file_id', fileId);
        $('#shareFileForm').attr('action', action);
    });
</script>
@endsection



