<div id="uploadBOQ">
    <div class="modal" id="uploadBOQModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Project Bill of Quantity Upload
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @if($selProject)
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('name', __('Project Name'), ['class' => 'form-label']) }}
                                    <input type="text" id="project_name" value="{{ $selProject->project_name }}" disabled  class="form-control"
                                        placeholder="Project Name" />
                                    @error('project_name')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('bduget', __('Estimated Budget'), ['class' => 'form-label']) }}
                                    <input type="text" id="boq_file" wire:model.defer="budget" class="form-control"
                                        placeholder="Estimated Budget" />
                                    @error('boq_file')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('boq_file', __('File Upload'), ['class' => 'form-label']) }}
                                    <input type="file" id="boq_file" wire:model.defer="boq_file" class="form-control"
                                        placeholder="File" />
                                    @error('boq_file')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @else
                        <label align="center" class="mb-4" style="color: red">Loading...</label>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <input type="button" id="closeUplaodBOQ" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="registerUser" value="{{ __('Uplaod Bill of Quantity') }}" class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        @if ($errors->any() || Session::has('error'))
            <script>
                $(document).ready(function() {
                    document.getElementById("toggleOldUser").click();
                });
            </script>
        @endif
    @endpush

</div>
@push('script')
    <script src="https://cdn.tiny.cloud/1/cvjfkxqlo8ylwqn3xgo15h2bd4xl6n7m6k5d0avjcq93c1i7/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#description',
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
                editor.on('change', function(e) {
                    @this.set('description', editor.getContent());
                });
            }
        });


        window.addEventListener('feedback', event => {
            tinyMCE.activeEditor.setContent("");
        });
    </script>
@endpush
<x-toast-notification />
