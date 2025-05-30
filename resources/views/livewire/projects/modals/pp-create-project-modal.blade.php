<div id="createUser">
    <div class="modal" id="ppNewProject" tabindex="-1" role="dialog" wire:ignore.self>
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
                        <div class="row" hidden>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        {{ Form::label('advertOption', __('With Advert'), ['class' => 'form-label']) }}: <span class="text-danger">*</span>
                                        <input type="radio" wire:model="advertOption" id="Information" value="{{ true }}" class="mr-3"><label class="form-label" style="margin-right: 20px" for="Information">&nbsp;Yes</label>
                                        <input type="radio" wire:model="advertOption" id="Sign-Posting" value="{{ false }}" class="mr-3"><label class="form-label" style="margin-right: 20px" for="Sign-Posting">&nbsp;No</label>
                                    </div>
                                    @error('advertOption')<label style="color: red">{{ $message }}</label>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('description', __('Project Description'), ['class' => 'form-label']) }}
                                    {{-- {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }} --}}
                                    <textarea wire:model="description" id="description" cols="50" rows="4" class="form-control"></textarea>
                                    @error('description')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
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
                                    <input type="date" class="form-control" wire:model.defer="end_date">
                                    @error('end_date')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
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
                            <div class="col-sm-12 col-md-12" wire:ignore>
                                <div class="form-group">
                                    {{ Form::label('selectedStaff', __('Supervising Staff'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                                    <select wire:model="selectedStaff" id="choices-multiple1" class="form-control sel_users select2 " multiple>
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
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div wire:loading wire:target="createProject"><x-g-loader /></div>
                        <input type="button" id="closeNewProject" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button"  wire:click="createProject" value="{{ __('Create') }}" class="btn  btn-primary">
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
        <script>
            window.addEventListener('success', event => {
                document.getElementById("closeNewProject").click();
            })
        </script>
    </div>
    @push('script')
    <script src="https://cdn.tiny.cloud/1/cvjfkxqlo8ylwqn3xgo15h2bd4xl6n7m6k5d0avjcq93c1i7/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#rdescription',
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
                editor.on('change', function(e) {
                    @this.set('rdescription', editor.getContent());
                });
            }
        });


        window.addEventListener('feedback', event => {
            tinyMCE.activeEditor.setContent("");
        });
    </script>
@endpush

    @push('script')
        <script>
            $(document).ready(function(){
                $('.sel_users');
            }).on('change', function(){
                var data = $('.sel_users').val();
                @this.set('selectedStaff',data);
            });

            window.addEventListener('print',event => {
                document.getElementById("print").click();
            });
        </script>
    @endpush

</div>
<x-toast-notification />
