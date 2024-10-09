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
                                    {{ Form::text('project_name', null, ['class' => 'form-control','required'=>'required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('description', __('Project Description'), ['class' => 'form-label']) }}
                                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                    {{ Form::date('start_date', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                                    {{ Form::date('end_date', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                {{ Form::label('category', __('Project Category'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                                {!! Form::select('category', $categories, null,array('class' => 'form-control','required'=>'required')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12">
                                {{ Form::label('project_boq', __('Project BoQ'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
                                <div class="form-file mb-3">
                                    <input type="file" class="form-control" name="project_boq" required="">
                                @error('level')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                                </div>

                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('user', __('Supervising Staff'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                                    {!! Form::select('user[]', $users, null,array('class' => 'form-control','required'=>'required')) !!}
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('budget', __('Budget'), ['class' => 'form-label']) }}
                                    {{ Form::number('budget', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
                                    <select name="status" id="status" class="form-control main-element">
                                        @foreach(\App\Models\Project::$project_status as $k => $v)
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
