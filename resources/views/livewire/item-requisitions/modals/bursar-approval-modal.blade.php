<div id="viewBudget">
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
                // $('#viewItemRequisitionDetails').modal('hide'); // Close the first modal
                $('#secretCodeModal').modal('show'); // Show the second modal
            });
        });
    </script>
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeVerifyModal").click();
        })
    </script>
    <x-toast-notification />
</div>