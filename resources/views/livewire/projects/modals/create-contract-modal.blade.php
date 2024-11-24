<div id="createUser">
    <div class="modal" id="createNewContract" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Create New Contract</h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{ Form::label('contractor_name', __('Contractor Name'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
                                <select wire:model="contractorId" class="form-control">
                                    <option value="">Select Contractor</option>
                                    @foreach ($contractors as $contractor)
                                        <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>
                                    @endforeach
                                </select>
                                @error('contractorId')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="createContract"><x-g-loader /></div>
                        <input type="button" id="closeNewContract" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="createContract" value="{{ __('Create Contract') }}" class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.addEventListener('success', event => {
                document.getElementById("closeNewContract").click();
            })
        </script>
    </div>
</div>
<x-toast-notification />
