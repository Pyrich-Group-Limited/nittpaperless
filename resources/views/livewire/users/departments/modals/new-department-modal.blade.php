<div id="department">
    <div class="modal" id="newDepartment" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Department Creation
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="category" class="form-label">Category</label>
                                <select wire:model="category" id="category" class="form-control">
                                    <option value="" selected>-- Select Category --</option>
                                    <option value="department">Department</option>
                                    <option value="directorate">Directorate</option>
                                </select>
                                @error('category')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('name', __('Department'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="department" class="form-control"
                                        placeholder="department" />
                                    @error('department')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div wire:loading wire:target="newDepartment"><x-g-loader /></div>
                        <input type="button" id="closeUserModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="newDepartment" value="{{ __('Create') }}" class="btn  btn-primary">
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
                document.getElementById("closeUserModal").click();
            })
        </script>
    @endpush

</div>
<x-toast-notification />
