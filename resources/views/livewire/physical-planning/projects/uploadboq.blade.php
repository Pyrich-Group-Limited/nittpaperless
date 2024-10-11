<div id="uploadBOQ">
    <div class="modal" id="uploadBOQModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
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
                                    {{ Form::label('bduget', __('ERGP'), ['class' => 'form-label']) }}
                                    {{-- <input type="text" id="boq_file" wire:model.defer="budget" class="form-control"
                                        placeholder="Estimated Budget"  /> --}}
                                        <select name="" id="" wire:model.defer="budget" class="form-control">
                                            @foreach ($projAccounts as $projAccount)
                                                <option value="{{ $projAccount->code }}">{{ $projAccount->code }}  </option>
                                            @endforeach
                                        </select>
                                    @error('bduget')
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
                                       <strong class="text-danger" wire:loading wire:target="boq_file">Loading...</strong>
                                    @error('boq_file')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            @foreach($inputs as $key => $input)

                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <input type="text" @error('inputs.'.$key.'.item') style="border-color: red" @enderror id="input_{{$key}}_item" id="input_{{$key}}_item" placeholder="Item" wire:model.defer="inputs.{{$key}}.item" class="form-control" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" @error('inputs.'.$key.'.description') style="border-color: red" @enderror id="input_{{$key}}_description" id="input_{{$key}}_description" placeholder="Description" wire:model.defer="inputs.{{$key}}.description" class="form-control" />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text"  @error('inputs.'.$key.'.unit_price') style="border-color: red" @enderror id="input_{{$key}}_unit_price" id="input_{{$key}}_unit_price" placeholder="Unit Price" wire:model.defer="inputs.{{$key}}.unit_price" class="form-control" />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" @error('inputs.'.$key.'.quantity') style="border-color: red" @enderror id="input_{{$key}}_quantity" id="input_{{$key}}_quantity" placeholder="Quantity" wire:model.defer="inputs.{{$key}}.quantity" class="form-control" />
                                    </div>
                                    <div class="col-md-1">
                                        @if($key > 0)
                                        <a href="#" wire:click="removeInput({{$key}})"  data-bs-toggle="tooltip" title="{{__('Add Field')}}" class="btn btn-sm btn-danger mt-1">
                                           X
                                        </a>
                                        @endif
                                    </div>
                            </div>
                            @endforeach

                            <a href="#" wire:click="addInput"  data-bs-toggle="tooltip" title="{{__('Add Field')}}" class="btn btn-sm btn-primary mt-3">
                                <i class="ti ti-plus"></i>
                            </a>

                            @else
                            <label align="center" class="mb-4" style="color: red">Loading...</label>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" id="closeUplaodBOQ" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="uploadBOQ" value="{{ __('Uplaod Bill of Quantity') }}" class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeUplaodBOQ").click();
    })
</script>
@endpush
<x-toast-notification />
