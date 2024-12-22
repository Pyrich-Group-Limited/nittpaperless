<div id="viewBudget">
    <div class="modal" id="viewItemRequisitionDetails" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title">ITEM REQUISITION DETAILS </h5>
                    </div>
                    <div class="modal-body">
                        @if ($selectedRequisition)
                            <div class="row">
                                @if (count($selectedRequisition->items) > 0)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('SN') }}</th>
                                                    <th>{{ __('Item Name') }}</th>
                                                    <th>{{ __('Item Description') }}</th>
                                                    <th>{{ __('Quantity') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($selectedRequisition->items as $index => $item)
                                                    <tr>
                                                        <td>
                                                            <p>{{ $index + 1 }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $item->item_name }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $item->description }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $item->quantity_requested }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="py-5">
                                        <h6 class="h6 text-center">{{ __('No record found!') }}</h6>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleFormControlTextarea1">{{ __('Comment') }}</label>
                                <textarea class="form-control" wire:model.defer="comments" id="exampleFormControlTextarea1"></textarea>
                                @error('comments')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="modal-footer">

                                <div wire:loading wire:target="liaisonHeadApproveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="approveRequisition"><x-g-loader /></div>

                                <input type="button" id="closeItemRequisitionApproval" value="{{ __('Close') }}"
                                    class="btn  btn-light btn-sm" data-bs-dismiss="modal">

                                @can('hod approve SRN')
                                    @if ($selectedRequisition->status == 'pending_hod_approval' || $selectedRequisition->status == 'liaison_head_approved')
                                        <input type="button"
                                            wire:click="approveRequisition({{ $selectedRequisition->id }})"
                                            value="{{ __('HOD Approve') }}" class="btn  btn-primary btn-sm">
                                        <input type="button"
                                            wire:click="rejectRequisition({{ $selectedRequisition->id }})"
                                            value="{{ __('Reject') }}" class="btn  btn-danger btn-sm">
                                    @endif
                                @endcan

                                @can('liaison approve SRN')
                                    @if ($selectedRequisition->status == 'liaison_head_approval')
                                        <input type="button"
                                            wire:click="liaisonHeadApproveRequisition({{ $selectedRequisition->id }})"
                                            value="{{ __('Approve') }}" class="btn  btn-primary btn-sm">
                                        <input type="button"
                                            wire:click="rejectRequisition({{ $selectedRequisition->id }})"
                                            value="{{ __('Reject') }}" class="btn  btn-danger btn-sm">
                                    @endif
                                @endcan
                            </div>
                        @else
                            <label align="center" class="mb-4" style="color: red">Loading...</label>
                        @endif
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
                        <h5 class="modal-title"> Verify Secret Code </h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="secretCode">{{ __('Enter Secret Code') }}</label>
                                <input wire:model="secretCode" type="password" class="form-control @error('secretCode') is-invalid @enderror">
                                @error('secretCode') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="verifyAndApprove"><x-g-loader /></div>
                        <input type="button" id="closeVerifyModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="verifyAndApprove" value="{{ __('Approve') }}"
                            class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            window.addEventListener('showSecretCodeModal', function () {
                $('#viewItemRequisitionDetails').modal('hide'); // Close the first modal
                $('#secretCodeModal').modal('show'); // Show the second modal
            });
        });
    </script>

    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeItemRequisitionApproval").click();
        })
    </script>
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeVerifyModal").click();
        })
    </script>
    <x-toast-notification />
</div>