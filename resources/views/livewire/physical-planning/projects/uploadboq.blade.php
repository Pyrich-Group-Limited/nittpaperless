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
                            @if ($selProject)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('name', __('Project Name'), ['class' => 'form-label']) }}
                                        <input type="text" id="project_name" value="{{ $selProject->project_name }}"
                                            disabled class="form-control" placeholder="Project Name" />
                                        @error('project_name')
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                @if($this->ergp)
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-danger">
                                                                <i class="ti ti-report-money"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                <small class="text-muted">{{ __('PROJECT') }}</small>
                                                                <h6 class="m-0">{{ __('SUM') }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-end">
                                                        <h4 class="m-0">{{ number_format($ergp->project_sum) }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-danger">
                                                                <i class="ti ti-report-money"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                <small class="text-muted">{{ __('PROJECT') }}</small>
                                                                <h6 class="m-0">{{ __('BALLANCE') }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-end">
                                                        <h4 class="m-0">{{number_format( $ergp->ballance) }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('bduget', __('ERGP'), ['class' => 'form-label']) }}
                                        {{-- <input type="text" id="boq_file" wire:model.defer="budget" class="form-control"
                                        placeholder="Estimated Budget"  /> --}}
                                        <select name="" id="" wire:model="budget"
                                            class="form-control">
                                            <option value="" selected>-- Select ERGP -- </option>
                                            @foreach ($projAccounts as $projAccount)
                                                <option value="{{ $projAccount->code }}">{{ $projAccount->code }} &nbsp; ({{ $projAccount->projectCategory->category_name }}) </option>
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
                                        {{ Form::label('boq_file', __('Supporting Document'), ['class' => 'form-label']) }}
                                        <input type="file" id="boq_file" wire:model.defer="boq_file"
                                            class="form-control" placeholder="Supporting Document" />
                                        <strong class="text-danger" wire:loading
                                            wire:target="boq_file">Loading...</strong>
                                        @error('boq_file')
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>

                                @foreach ($inputs as $key => $input)
                                    <div class="row mb-2">
                                        <div class="col-md-3">
                                            <input type="text"
                                                @error('inputs.' . $key . '.item') style="border-color: red" @enderror
                                                id="input_{{ $key }}_item"
                                                id="input_{{ $key }}_item" placeholder="Item"
                                                wire:model.defer="inputs.{{ $key }}.item"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text"
                                                @error('inputs.' . $key . '.description') style="border-color: red" @enderror
                                                id="input_{{ $key }}_description"
                                                id="input_{{ $key }}_description" placeholder="Description"
                                                wire:model.defer="inputs.{{ $key }}.description"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text"
                                                @error('inputs.' . $key . '.unit_price') style="border-color: red" @enderror
                                                id="input_{{ $key }}_unit_price"
                                                id="input_{{ $key }}_unit_price" placeholder="Unit Price"
                                                wire:model="inputs.{{ $key }}.unit_price"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text"
                                                @error('inputs.' . $key . '.quantity') style="border-color: red" @enderror
                                                id="input_{{ $key }}_quantity"
                                                id="input_{{ $key }}_quantity" placeholder="Quantity"
                                                wire:model="inputs.{{ $key }}.quantity"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-1">
                                            @if ($key > 0)
                                                <a href="#" wire:click="removeInput({{ $key }})"
                                                    data-bs-toggle="tooltip" title="{{ __('Add Field') }}"
                                                    class="btn btn-sm btn-danger mt-1">
                                                    X
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                <a href="#" wire:click="addInput" data-bs-toggle="tooltip"
                                    title="{{ __('Add Field') }}" class="btn btn-sm btn-primary mt-3">
                                    <i class="ti ti-plus"></i>
                                </a>
                            @else
                                <label align="center" class="mb-4" style="color: red">Loading...</label>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <div class="d-flex align-items-center">
                                                <div class="theme-avtar bg-danger">
                                                    <i class="ti ti-report-money"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <small class="text-muted">{{ __('SUB') }}</small>
                                                    <h6 class="m-0">{{ __('TOTAL') }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-end">
                                            <h4 class="m-0">{{ number_format($sumTotal) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <div class="d-flex align-items-center">
                                                <div class="theme-avtar bg-danger">
                                                    <i class="ti ti-report-money"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <small class="text-muted">{{ __('7.5%') }}</small>
                                                    <h6 class="m-0">{{ __('VAT') }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-end">
                                            <h4 class="m-0">{{number_format( 7.5/100 * ($sumTotal)) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" id="closeUplaodBOQ" value="{{ __('Cancel') }}"
                            class="btn  btn-light" data-bs-dismiss="modal">
                        <input type="button" wire:click="uploadBOQ" value="{{ __('Uplaod Bill of Quantity') }}"
                            class="btn  btn-primary">
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
