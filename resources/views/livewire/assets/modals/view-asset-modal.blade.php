<div id="viewAsset">
    <div class="modal" id="viewAssetModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">View Asset
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @if($selAsset)
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
                                                            <small
                                                                class="text-muted">{{ __('DEPRECIATION VALUE') }}</small>
                                                            <h6 class="m-0">RATE: {{  $selAsset->depreciation }} %</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto text-end">
                                                    <h4 class="m-0">₦{{ number_format($selAsset->initial_cost - (($selAsset->depreciation/100)*$selAsset->initial_cost)) }}
                                                    </h4>
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
                                                            <small
                                                                class="text-muted">{{ __('APPRCIATION VALUE') }}</small>
                                                                <h6 class="m-0">RATE: {{  $selAsset->appreciation }} %</h6>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto text-end">
                                                    <h4 class="m-0">₦{{ number_format($selAsset->initial_cost + (($selAsset->appreciation/100)*$selAsset->initial_cost)) }}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>{{__('Asset Description')}}</th>
                                        <td>{{ $selAsset->asset_description }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Initial Cost')}}</th>
                                        <td>₦{{ number_format($selAsset->initial_cost,2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Number of Units')}}</th>
                                        <td>{{ $selAsset->number_of_units }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Model Number')}}</th>
                                        <td> {{ $selAsset->model_number }}</td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Asset Type')}}</th>
                                        <td> {{ $selAsset->asset_type }}</td>
                                    </tr>                                    <tr>
                                        <th>{{__('Location')}}</th>
                                        <td> {{ $selAsset->location }}</td>
                                    </tr>                                    <tr>
                                        <th>{{__('Serial Number')}}</th>
                                        <td> {{ $selAsset->serial_number }}</td>
                                    </tr>                                    <tr>
                                        <th>{{__('Asset Code')}}</th>
                                        <td> {{ $selAsset->asset_identification_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Year Manufactured')}}</th>
                                        <td> {{ $selAsset->year_of_manufacture }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Date Purchased')}}</th>
                                        <td> {{ $selAsset->date_of_purchase }}</td>
                                    </tr>

                                </table>
                            </div>
                            @else
                            <div align="center"><x-g-loader /></div>
                            @endif
                            <div class="modal-footer">
                                <div wire:loading wire:target="newAsset"><x-g-loader /></div>
                                <input type="button" id="closeUserModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                                    data-bs-dismiss="modal">
                            </div>
                        </div>

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
