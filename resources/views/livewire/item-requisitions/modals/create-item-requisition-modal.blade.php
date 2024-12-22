<div id="createItemRequisition">
    <div class="modal" id="newItemRequisition" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h2 class="modal-title">STORE REQUISITION NOTE</h2>
                        {{-- <h5 class="modal-title">Item Requisition Module
                        </h5> --}}
                    </div>
                    <div class="modal-body">
                        <div class="row">
                                @foreach ($items as $index => $item)
                                    <div class="row mb-2">
                                        <div class="col-md-3">
                                            @if($loop->first)
                                                <label for="" class="text-primary"><b>Item Name</b></label>
                                            @endif
                                            <input type="text" wire:model="items.{{ $index }}.name"  class="form-control" placeholder="Item Name" required>
                                            @error("items.{$index}.name")
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            @if($loop->first)
                                                <label for="" class="text-primary"><b>Item Description</b></label>
                                            @endif
                                            <input type="text" wire:model="items.{{ $index }}.description"  class="form-control" placeholder="Item Description (optional)">
                                            @error("items.{$index}.description")
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            @if($loop->first)
                                                <label for="" class="text-primary"><b>Item Quantity</b></label>
                                            @endif
                                            <input type="number" wire:model="items.{{ $index }}.quantity" min="1" class="form-control" placeholder="Qty" required>
                                            @error("items.{$index}.quantity")
                                            <small class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-1">
                                            @if ($index > 0)
                                                <a href="#" wire:click="removeItem({{ $index }})"
                                                    data-bs-toggle="tooltip" title="{{ __('Remove Field') }}"
                                                    class="btn btn-sm btn-danger mt-1">
                                                    X
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                <a href="#" wire:click="addItem" data-bs-toggle="tooltip"
                                    title="{{ __('Add Field') }}" class="btn btn-sm btn-primary mt-3">
                                    <i class="ti ti-plus"></i>
                                </a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="createItemRequisition"><x-g-loader /></div>
                        <input type="button" id="closeItemRequisitionModal" value="{{ __('Cancel') }}"
                            class="btn  btn-light" data-bs-dismiss="modal">
                            
                        <input type="button" wire:click="createItemRequisition" value="{{ __('Submit Request') }}"
                            class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="secretCodeModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title"> Verify Secret Code</h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="secretCode">{{ __('Enter Secret Code') }}</label>
                                <input wire:model="secretCode" type="password" id="secretCode" class="form-control @error('secretCode') is-invalid @enderror">
                                @error('secretCode') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="verifySecretCode"><x-g-loader /></div>
                        <input type="button" id="closeVerifyModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="verifySecretCode" value="{{ __('Verify and Submit') }}"
                            class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        document.addEventListener('livewire:load', function () {
            window.addEventListener('showSecretCodeModal', function () {
                $('#newItemRequisition').modal('hide'); // Close the first modal
                $('#secretCodeModal').modal('show'); // Show the second modal
            });
        });
    </script>
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeItemRequisitionModal").click();
        })
    </script>
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeVerifyModal").click();
        })
    </script>
<x-toast-notification />
