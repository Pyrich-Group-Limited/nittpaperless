<div id="createUser">
    <div class="modal" id="AddErgpModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Add ERGP</h5>
                    </div>
                    <div class="modal-body">
                        {{-- {{ Form::open(['url' => 'projects', 'method' => 'post','enctype' => 'multipart/form-data']) }} --}}
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('code', __('ERGP Code'), ['class' => 'form-label']) }}<span
                                        class="text-danger">*</span>
                                    <input type="text" wire:model="code" class="form-control">
                                    @error('code')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('title', __('ERGP Title'), ['class' => 'form-label']) }}<span
                                        class="text-danger">*</span>
                                    <input type="text" wire:model="title" class="form-control">
                                    @error('title')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('value', __('ERGP Value'), ['class' => 'form-label']) }}<span
                                    class="text-danger">*</span>
                                <input type="number" wire:model="value" class="form-control">
                                @error('value')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('ergp_year', __('ERGP Year'), ['class' => 'form-label']) }}
                                <input type="month" class="form-control" wire:model="ergp_year">
                                @error('ergp_year')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('projectCat', __('Project Category'), ['class' => 'form-label']) }}
                                <select name="" id="" class="form-control" wire:model="projectCat">
                                    <option value=""></option>
                                    @foreach ($projectCats as $projectCat)
                                        <option value="{{ $projectCat->id }}">{{ $projectCat->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('projectCat')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <input type="button" id="closeAddErgpModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="createProject" value="{{ __('Save') }}"
                            class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeAddErgpModal").click();
    })
</script>

