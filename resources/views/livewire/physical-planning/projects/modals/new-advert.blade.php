<div id="publishAdvert">
    <div class="modal" id="publishAdvertModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Project Advert Publish</h5>
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
                                        <option value="Contractor">Award to Contractor</option>
                                    </select>
                                    @error('type_of_advert')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>

                                <!-- Contractor Dropdown - Only visible if 'Award to Contractor' is selected -->
                                @if($type_of_advert === 'Contractor')
                                    <div class="form-group col-md-12 mt-3">
                                        <label for="contractor" class="form-label">Select Contractor</label>
                                        <select wire:model="selected_contractor" id="contractor" class="form-control">
                                            <option value="" selected>-- Select Contractor --</option>
                                            @foreach($contractors as $contractor)
                                                <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('selected_contractor')
                                            <small class="text-danger" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @else
                                <!-- Existing Fields for Advert -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('name', __('Project Name'), ['class' => 'form-label']) }}
                                            <input type="text" id="project_name" disabled value="{{ $project->project_name }}" class="form-control" placeholder="Project Name" />
                                            @error('project_name')
                                                <small class="invalid-name" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ad_description" class="form-label">Advert Description</label>
                                        <div wire:ignore>
                                            <textarea id="message" wire:model="ad_description" class="form-control tinymce-basic" name="description"></textarea>
                                        </div>
                                        @error('ad_description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                            <input type="date" id="start_date" wire:model.defer="ad_start_date" class="form-control" placeholder="Project Start Date" />
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
                                            <input type="date" id="end_date" wire:model.defer="ad_end_date" class="form-control" placeholder="Project End Date" />
                                            @error('ad_end_date')
                                                <small class="invalid-name" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            @else
                                <label align="center">Loading...</label>
                            @endif
                        </div>
                    </div>

                    <!-- Modal Footer with Conditional Button -->
                    <div class="modal-footer">
                        <div wire:loading wire:target="createContract"><x-g-loader /></div>
                        <div wire:loading wire:target="advertiseProject"><x-g-loader /></div>
                        <input type="button" id="closeAdvertiseProject" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">

                        <!-- Conditionally Render Button Based on 'type_of_advert' -->
                        @if($type_of_advert === 'Contractor' && $selected_contractor)
                            <input type="button" wire:click="createContract" value="{{ __('Create Contract') }}" class="btn btn-primary">
                        @else
                            <input type="button" wire:click="advertiseProject" value="{{ __('Publish Advert') }}" class="btn btn-primary">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('success', event => {
        document.getElementById("closeAdvertiseProject").click();
    });
</script>
@push('script')
    <script>
        window.addEventListener('feedback', event => {
            tinyMCE.activeEditor.setContent("");
        });
    </script>
@endpush
<x-toast-notification />
