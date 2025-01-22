<div id="createUser">
    <div class="modal" id="newRequisition" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Raise Requisition Module</h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('value', __('Type of Requisition'), ['class' => 'form-label']) }}<span
                                    class="text-danger">*</span>
                                <input type="text" wire:model="type" class="form-control">
                                @error('type')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('value', __('Purpose of Requisition'), ['class' => 'form-label']) }}<span
                                    class="text-danger">*</span>
                                <input type="text" wire:model="purpose" class="form-control">
                                @error('purpose')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('amount', __('Amount'), ['class' => 'form-label']) }} (₦) <span
                                class="text-danger">*</span>
                                <input type="number" class="form-control" wire:model="amount">
                                @error('amount')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('amount', __('Detailed description'), ['class' => 'form-label']) }} <span
                                class="text-danger">*</span>
                                <textarea class="form-control" wire:model="description" rows="4"></textarea>
                                @error('description')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('document', __('Supporting Document'), ['class' => 'form-label']) }}
                                <input type="file" id="document" wire:model.defer="document"
                                    class="form-control" placeholder="File" />
                                <strong class="text-danger" wire:loading
                                    wire:target="document">Loading...</strong>
                                @error('document')
                                    <small class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="submitForm"><x-g-loader /></div>
                        <input type="button" id="closeNewRequisitionModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="submitForm" value="{{ __('Submit') }}"
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
                        <h5 class="modal-title" id="applyLeave">Secret Code Verification</h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="secretCode">{{ __('Secret Code') }}</label>
                                <input wire:model="secretCode" type="password" class="form-control @error('secretCode') is-invalid @enderror">
                                @error('secretCode') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="verifyAndSubmit"><x-g-loader /></div>
                        <input type="button" id="closeVerifyModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="verifyAndSubmit" value="{{ __('Submit') }}"
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
            $('#newRequisition').modal('hide'); // Close the first modal
            $('#secretCodeModal').modal('show'); // Show the second modal
        });
    });
</script>

<script>
    window.addEventListener('success', event => {
        document.getElementById("closeNewRequisitionModal").click();
    })
</script>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeVerifyModal").click();
    })
</script>
