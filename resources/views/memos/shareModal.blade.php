
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
                    <label for="">Share with: (<span class="text-xs text-muted">{{ __('You can select one or more staff to send memo')}}</span>) </label>
                    <select name="shared_with[]" id="choices-multiple1" class="form-control select2" multiple>
                        <option value="#">Select one or more Staff</option>
                        
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->employee->id ?? 'No employee ID yet' }})
                                | {{ strtoupper($user->type) }} | {{ $user->department->name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="secret_code">Secret Code</label>
                    <input type="password" name="secret_code" placeholder="Enter your secret code" id="secret_code" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="{{__('Share')}}" class="btn  btn-primary">
        </div>
    </form>
</div>




