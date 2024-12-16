<div id="documentFile">
    <div class="modal" id="renameFile" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Rename File
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('name', __('Folder Name'), ['class' => 'form-label']) }}
                                    <input type="text" wire:model.defer="file_name" class="form-control"
                                        placeholder="File Name" />
                                    @error('file_name')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>

                    </div>

                    <div class="modal-footer">
                        <div wire:loading wire:target="renameFile"><x-g-loader /></div>
                        <input type="button" id="closeRenameFIle" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="renameFile" value="{{ __('Rename') }}" class="btn  btn-primary">
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
                document.getElementById("closeRenameFIle").click();
            })
        </script>
    @endpush


</div>
<x-toast-notification />
