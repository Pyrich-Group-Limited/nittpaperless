<div id="createUser">
    <div class="modal" id="modifyRequisition" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title">Modify Requisition Module</h5>
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
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="updateRequisition"><x-g-loader /></div>
                        <input type="button" id="closeUpdateRequisitionModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="updateRequisition" value="{{ __('Update') }}"
                            class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeUpdateRequisitionModal").click();
    })
</script>
