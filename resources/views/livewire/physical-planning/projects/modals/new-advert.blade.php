<div id="publishAdvert">
    <div class="modal" id="publishAdvertModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Project Advert Publish
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @if ($project)
                                <div class="form-group col-md-12">
                                    <label for="type_of_advert" class="form-label">Type of Advert</label>
                                    <select wire:model="type_of_advert" id="type_of_advert" class="form-control">
                                        <option value="" selected>-- Select Type of Advert --</option>
                                        <option value="Internal">Internal</option>
                                        <option value="External">External</option>
                                    </select>
                                    @error('type_of_advert')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('name', __('Project Name'), ['class' => 'form-label']) }}
                                        <input type="text" id="project_name" disabled value="{{ $project->project_name }}"
                                            class="form-control" placeholder="Project Name" />
                                        @error('project_name')
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3" >
                                    <label class="form-label" for="description">Blog Description</label>
                                    <div wire:ignore>
                                        <textarea id="message" wire:model="description" class="form-control tinymce-basic" name="description"></textarea>
                                    </div>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                        <input type="date" id="start_date" wire:model.defer="ad_start_date"
                                            class="form-control" placeholder="Project Start Date" />
                                        @error('ad_start_date')
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                                        <input type="date" id="end_date" wire:model.defer="ad_end_date"
                                            class="form-control" placeholder="Project End Date" />
                                        @error('ad_end_date')
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <label align="center">Loading...</label>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" id="closeAdvertiseProject" value="{{ __('Cancel') }}"
                            class="btn  btn-light" data-bs-dismiss="modal">
                        <input type="button" wire:click="advertiseProject" value="{{ __('Publish Advert') }}"
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
