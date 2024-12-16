<div id="createUser">
    <div class="modal" id="newFolder" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Employee File Creation
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-control-wrap col-md-12 mb-3">
                                <div  wire:ignore>
                                    {{ Form::label('name', __('Select employee'), ['class' => 'form-label']) }}

                                    <select id="employeeRecord" class="form-control sel_customer">
                                        <option value="#" selected>Please Select employee</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('employee')
                                    <code>{{ $message }}</code>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('name', __('Folder Name'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="folder_name" class="form-control"
                                        placeholder="folder_name" />
                                    @error('folder_name')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <label for="folder_type" class="form-label">Type of File</label>
                                <select wire:model="folder_type" id="folder_type" class="form-control">
                                    <option value="" selected>-- Select Employee Folder --</option>
                                    <option value="Secrete">Secrete File</option>
                                    <option value="Open">Open File</option>
                                </select>
                                @error('folder_type')
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>

                    </div>

                    <div class="modal-footer">
                        <div wire:loading wire:target="createFile"><x-g-loader /></div>
                        <input type="button" id="closeUserModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="createFile" value="{{ __('Create') }}" class="btn  btn-primary">
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

    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

$(document).ready(function() {
    // Initialize Select2 when the modal is shown
    $('#newFolder').on('shown.bs.modal', function () {
        $('#employeeRecord').select2({
            dropdownParent: $('#newFolder') // Attach the dropdown to the modal to prevent display issues
        });
    });
});

$(document).ready(function(){
    $('.sel_customer').select2();
}).on('change', function(){
    var data = $('.sel_customer').select2("val");
    @this.set('employee',data);
});
</script>
@endpush

</div>
<x-toast-notification />
