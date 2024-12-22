<div id="PurchaseRequisition">
    <div class="modal" id="newPurchaseRequisition" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Purchase Requisition
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" wire:model="comment" id="comment"
                                             class="form-control" placeholder="Comment" />
                                        @error('comment')
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="date" wire:model="last_date" id="last_date"
                                             class="form-control" placeholder="last_date" />
                                        @error('last_date')
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                @foreach ($inputs as $key => $input)
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <input type="text"
                                                @error('inputs.' . $key . '.item_name') style="border-color: red" @enderror
                                                id="input_{{ $key }}_item_name" id="input_{{ $key }}_item_name" placeholder="Item Name"
                                                wire:model="inputs.{{ $key }}.item_name"
                                                class="form-control" />
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text"
                                                @error('inputs.' . $key . '.quantity') style="border-color: red" @enderror
                                                id="input_{{ $key }}_quantity" id="input_{{ $key }}_quantity" placeholder="Quantity"
                                                wire:model="inputs.{{ $key }}.quantity"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text"
                                                @error('inputs.' . $key . '.quantity_left') style="border-color: red" @enderror
                                                id="input_{{ $key }}_quantity_left" id="input_{{ $key }}_quantity_left" placeholder="Quantity Left"
                                                wire:model="inputs.{{ $key }}.quantity_left"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-2">
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



                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="purchaseRequest"><x-g-loader /></div>
                        <input type="button" id="closeSupplierModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="purchaseRequest" value="{{ __('Submit Request') }}" class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeSupplierModal").click();
        })
    </script>
@endpush
<x-toast-notification />
