<div class="modal" id="raisememo" tabindex="-1" role="dialog" wire:ignore>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="raisememo">Raise a Memo
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('memos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Memo Title</label>
                                <input type="text" name="title" value="{{ old('title')}}" class="form-control">
                                @error('title')
                                <small class="invalid-password" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Memo Description</label>
                                <textarea name="description" value="{{ old('description')}}" class="form-control" cols="30"></textarea>
                                @error('description')
                                <small class="invalid-password" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Attach File</label>
                                <input type="file" name="memofile" value="{{ old('memofile')}}" aria-multiselectable="" class="form-control" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
                                @error('memofile')
                                <small class="invalid-password" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
                    <input type="submit" value="{{__('Submit')}}" class="btn  btn-primary">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

