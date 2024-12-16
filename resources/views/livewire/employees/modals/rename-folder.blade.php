<div id="createUser">
    <div class="modal" id="renameFolder" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Rename Folder
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
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

                    </div>

                    <div class="modal-footer">
                        <div wire:loading wire:target="renameFolder"><x-g-loader /></div>
                        <input type="button" id="closeUserModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="renameFolder" value="{{ __('Create') }}" class="btn  btn-primary">
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
