<div id="unit">
    <div class="modal" id="newUnit" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Unit Creation
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="category" class="form-label">Department</label>
                                <select wire:model="department" id="department" class="form-control">
                                    <option value="" selected>-- Select department --</option>
                                    @foreach(App\Models\Department::all() as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('name', __('Unit'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="unit" class="form-control"
                                        placeholder="Enter Unit name" />
                                    @error('unit')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div wire:loading wire:target="newUnit"><x-g-loader /></div>
                        <input type="button" id="closeUserModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="newUnit" value="{{ __('Create') }}" class="btn  btn-primary">
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
