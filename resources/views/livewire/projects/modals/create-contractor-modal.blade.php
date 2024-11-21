<div id="createUser">
    <div class="modal" id="newContractor" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Create Contractor</h5>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="row"> --}}
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('contractor_name', __('Contractor Name'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
                                    <input type="text" wire:model="contractor_name" class="form-control">
                                    @error('contractor_name')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('cemail', __('Email'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
                                    <input type="email" wire:model="cemail" class="form-control">
                                    @error('cemail')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('cpassword', __('Password'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
                                    <input type="password" wire:model="cpassword" class="form-control">
                                    @error('cpassword')
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                        {{-- </div> --}}
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="createContractor"><x-g-loader /></div>
                        <input type="button" id="closeNewContractor" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button"  wire:click="createContractor" value="{{ __('Create') }}" class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.addEventListener('success', event => {
                document.getElementById("closeNewContractor").click();
            })
        </script>
    </div>
</div>
<x-toast-notification />
