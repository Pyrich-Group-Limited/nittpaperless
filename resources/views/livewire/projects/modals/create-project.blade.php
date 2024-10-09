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
                                    <input type="date" class="form-control" wire:model.defer="start_date">
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
                                    <input type="date" class="form-control" wire:model.defer="end_date">
                                    @error('end_date')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row"> -->
                            <div class="col-sm-12 col-md-12">
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
                        <div class="row">
                            <div class="col-sm-6 col-md-6" wire:ignore>
                                <div class="form-group">
                                    {{ Form::label('selectedStaff', __('Supervising Staff'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                                    <select wire:model="selectedStaff" id="choices-multiple1" class="form-control sel_users select2 " multiple>
                                    {{-- <select wire:model="supervising_staff_id" class="form-control"> --}}
                                        <option value="">---Select---</option>
                                        @if (is_array($users) || is_object($users))
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('selectedStaff')
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
                        {{-- <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
                                    <select wire:model="status" id="status" class="form-control main-element">
                                        @foreach(\App\Models\ProjectCreation::$project_status as $k => $v)
                                            <option value="{{$k}}">{{__($v)}} {{$k}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}

                        

                    </div>

                    <div class="modal-footer">
                        <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" id="button" wire:click="createProject" value="{{ __('Create') }}" class="btn  btn-primary">
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>    
            $(document).ready(function(){
                $('.sel_users').select2();
            }).on('change', function(){
                var data = $('.sel_users').select2("val");
                @this.set('byproduct',data);
            });

            window.addEventListener('print',event => {
                document.getElementById("print").click();
            });
        </script>
    @endpush

    @push('script')
    <script>
         $('#button').submit(function(e) {
                e.preventDefault();
                // Coding
                $('#newProject').modal('toggle'); //or  $('#IDModal').modal('hide');
                return false;
            });
    </script>
    @endpush

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
