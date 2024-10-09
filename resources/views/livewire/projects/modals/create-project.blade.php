<div id="createUser">
    <div class="modal" id="newProject" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Create Project</h5>
                    </div>
                    <div class="modal-body">
                        {{-- {{ Form::open(['url' => 'projects', 'method' => 'post','enctype' => 'multipart/form-data']) }} --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('project_name', __('Project Name'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
                                    <input type="text" wire:model="project_name" class="form-control">
                                    @error('project_name')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('description', __('Project Description'), ['class' => 'form-label']) }}
                                    {{-- {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }} --}}
                                    <textarea wire:model="description" id="" cols="50" rows="4" class="form-control"></textarea>
                                    @error('description')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                    {{-- {{ Form::date('start_date', null, ['class' => 'form-control']) }} --}}
                                    <input type="date" class="form-control" wire:model="start_date">
                                    @error('start_date')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                                    {{-- {{ Form::date('end_date', null, ['class' => 'form-control']) }} --}}
                                    <input type="date" class="form-control" wire:model="end_date">
                                    @error('end_date')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('category', __('Project Category'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                                    <select wire:model="project_category_id" id="" class="form-control">
                                        <option value="">---Select---</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                        @error('project_category_id')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                        @enderror
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                {{ Form::label('project_boq', __('Project BoQ'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
                                <div class="form-file mb-3">
                                    <input type="file" class="form-control" wire:model="project_boq" required="">
                                    {{-- @if ($project_boq)
                                        <div class="progress mt-2">
                                            <div class="progress-bar" style="width: 100%">Uploading...</div>
                                        </div>
                                    @endif --}}
                                @error('project_boq')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('supervising_staff_id', __('Supervising Staff'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                                    <select wire:model="supervising_staff_id[]" id="choices-multiple1" class="form-control select2" multiple>
                                        <option value="">---Select---</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supervising_staff_id')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('budget', __('Budget'), ['class' => 'form-label']) }}
                                    <input type="number" wire:model="budget" class="form-control">
                                    @error('budget')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
                                    <select wire:model.defer="status" id="status" class="form-control main-element">
                                        @foreach(\App\Models\ProjectCreation::$project_status as $k => $v)
                                            <option value="{{$k}}">{{__($v)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="createProject" value="{{ __('Create') }}" class="btn  btn-primary">
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    @push('script')
        @if ($errors->any() || Session::has('error'))
            <script>
                $(document).ready(function() {
                    document.getElementById("toggleOldProject").click();
                });
            </script>
        @endif
    @endpush

</div>
<x-toast-notification />
