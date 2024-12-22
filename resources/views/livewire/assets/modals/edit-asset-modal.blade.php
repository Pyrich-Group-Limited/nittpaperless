<div id="editAsset">
    <div class="modal" id="editAssetModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Asset Creation
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @if($selAsset)
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('asset_code', __('Asset Code'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="asset_code" class="form-control"
                                        placeholder="Asset Code" />
                                    @error('asset_code')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="asset_type" class="form-label">Asset Type</label>
                                <select wire:model="asset_type" id="asset_type" class="form-control">
                                    <option value="" selected>-- Select Asset Type --</option>
                                    <option value="PLANT AND MACHINERY">PLANT AND MACHINERY</option>
                                    <option value="SPECIALIZE LABORATORY EQUIPMENT">SPECIALIZE LABORATORY EQUIPMENT</option>
                                    <option value="FURNITURE">FURNITURE</option>
                                    <option value="OFFICE EQUIPMENT">OFFICE EQUIPMENT</option>
                                </select>
                                @error('asset_type')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
                                    <input type="description" wire:model.defer="description" class="form-control"
                                        placeholder="Description" />
                                    @error('description')
                                        <small class="invalid-description" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('location', __('location'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="location" class="form-control"
                                        placeholder="Location" />
                                    @error('location')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('serial_no', __('Serial Number'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="serial_no" class="form-control"
                                        placeholder="Serial Number" />
                                    @error('serial_no')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('model_no', __('Model'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="model_no" class="form-control"
                                        placeholder="model_no Number" />
                                    @error('model_no')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('quantity', __('Quantity'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="quantity" class="form-control"
                                        placeholder="Quantity" />
                                    @error('quantity')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('initial_cost', __('Initial Cost'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="initial_cost" class="form-control"
                                        placeholder="Initial Cost" />
                                    @error('initial_cost')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('date_purchased', __('Date Purchased'), ['class' => 'form-label']) }}
                                    <input type="date" wire:model.defer="date_purchased" class="form-control"
                                        placeholder="Date Purchased" />
                                    @error('date_purchased')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('man_year', __('Year Manufactured'), ['class' => 'form-label']) }}
                                    <input type="number" min="1900" max="2099" step="1" value="2016" wire:model.defer="man_year" class="form-control"
                                        placeholder="Year Manufactured" />
                                    @error('man_year')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('depreciation', __('Depreciation Value(%)'), ['class' => 'form-label']) }}
                                    <input type="number" min="0" max="100" step="1"  wire:model.defer="depreciation" class="form-control"
                                        placeholder="Depreciation Value(%)" />
                                    @error('depreciation')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('appreciation', __('Appreciation Value(%)'), ['class' => 'form-label']) }}
                                    <input type="number" min="0" max="100" step="1"  wire:model.defer="appreciation" class="form-control"
                                        placeholder="Appreciation Value(%)" />
                                    @error('appreciation')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            @else
                            <div align="center"><x-g-loader /></div>
                            @endif

                        </div>

                    </div>

                    <div class="modal-footer">
                        <div wire:loading wire:target="updateAsset"><x-g-loader /></div>
                        <input type="button" id="closeEditAssetModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="updateAsset" value="{{ __('Update') }}" class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        @if ($errors->any() || Session::has('error'))
            <script>
                $(document).ready(function() {
                    document.getElementById("toggleOldUser").click();
                });
            </script>
        @endif

        <script>
            window.addEventListener('success', event => {
                document.getElementById("closeEditAssetModal").click();
            })
        </script>
    @endpush

</div>
<x-toast-notification />
