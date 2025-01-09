<div id="uplodDocument">
    <div class="modal" id="uplodDocumentModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Company Document Upload
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('name', __('Project'), ['class' => 'form-label']) }}
                                        <select wire:model.defer="project" id="" class="form-control">
                                            @foreach ($applications as $application)
                                                <option value="">---Select Project---</option>
                                                <option value="{{ $application->id }}">{{ $application->project->project_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('project')
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('name', __('Document Name'), ['class' => 'form-label']) }}
                                        <input type="file" id="doc_name" wire:model="doc_name"
                                            class="form-control" placeholder="Document Name" />
                                        @error('doc_name')
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('Doucmet File', __('Doucmet File'), ['class' => 'form-label']) }}
                                        <div wire:loading wire:target="doc_file"><x-g-loader /></div>
                                        <input type="file" id="start_date" wire:model.defer="doc_file"
                                            class="form-control" />
                                        @error('doc_file')
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <div wire:loading wire:target="uploadDocument"><x-g-loader /></div>
                        <input type="button" id="closeAdvertiseProject" value="{{ __('Close') }}"
                            class="btn  btn-light" data-bs-dismiss="modal">
                        <input type="button" wire:click="uploadDocument" value="{{ __('Upload') }}"
                            class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeAdvertiseProject").click();
        })
    </script>

</div>
@push('script')
        <script>
            window.addEventListener('feedback', event => {
                tinyMCE.activeEditor.setContent("");
            });
        </script>
@endpush
<x-toast-notification />
