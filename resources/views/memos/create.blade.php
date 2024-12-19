<div class="modal" id="raisememo" tabindex="-1" role="dialog" wire:ignore>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="raisememo">Raise a Memo
                </h5>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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
                                <label for="">Memo Priority</label>
                                <select name="priority" id="" class="form-control">
                                    <option value="0">Low</option>
                                    <option value="1">Medium</option>
                                    <option value="2">High</option>
                                    <option value="3">Critical</option>
                                </select>
                                @error('priority')
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

                        <div class="mb-3">
                            <label for="content_type" class="form-label"><b>Memo Content Type</b></label>
                            <div>
                                <input type="radio" name="content_type" value="typed" id="typed_content" checked>
                                <label for="typed_content">Type Memo Content</label>
                                &nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="content_type" value="uploaded" id="uploaded_file">
                                <label for="uploaded_file">Upload Memo Document</label>
                            </div>
                        </div>

                        <!-- Text Editor for Typed Content -->
                        <div id="typedContentSection">
                            <label for="file_content" class="form-label">Type Memo Content</label>
                            <textarea name="file_content" id="file_content" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="col-md-12" id="fileUploadSection" style="display: none;">
                            <div class="form-group">
                                <label for="">Attach Memo Document</label>
                                <input type="file" name="memofile" id="memofile" aria-multiselectable="" class="form-control" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
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
                    <input type="submit" value="{{__('Save Memo')}}" class="btn  btn-primary">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typedRadio = document.getElementById('typed_content');
        const uploadedRadio = document.getElementById('uploaded_file');
        const typedSection = document.getElementById('typedContentSection');
        const uploadSection = document.getElementById('fileUploadSection');

        typedRadio.addEventListener('change', () => {
            typedSection.style.display = 'block';
            uploadSection.style.display = 'none';
        });

        uploadedRadio.addEventListener('change', () => {
            typedSection.style.display = 'none';
            uploadSection.style.display = 'block';
        });
    });
</script>

