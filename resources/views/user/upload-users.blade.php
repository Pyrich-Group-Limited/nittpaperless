<div class="modal" id="uploadUsers" tabindex="-1" role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form wire:submit.prevent="uploadUser" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                            <h5 class="modal-title" id="applyLeave">Upload Users </h5>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            @if($failed_upload)
                            <div class="alert alert-danger alert-dismissible alert-alt fade show mt-3">
                                <strong>Attention! </strong> Some records were not uploaded. kindly ensure you <br> entered all records correctly.
                                <input type="button"  wire:click.prevent="downloadFailedUpload" value="{{__('Donlaod Failed Upload')}}" class="btn  btn-danger">
                            </div>
                        @endif
                            <div class="col-md-8 mt-1">
                                <div class="form-group">
                                    <input type="file" wire:model="uploadFile" class="form-control">
                                    <div style="color: red" align="center" wire:loading wire:target="uploadFile" >Loading...</div>

                                    @error('uploadFile')
                                    <small class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <a href="{{ asset('uploads/staf-sample.xlsx') }}"><input type="button" value="{{__('Download Template')}}" class="btn  btn-primary"></a>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <input type="button" id="closeUploadUser" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
                        <input type="submit" value="{{__('Onboard Users')}}" class="btn  btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')
    @if($errors->any() || Session::has('error'))
    <script>
        $(document).ready(function(){
            console.log('user');
            document.getElementById("toggleOldUser").click();
        });
    </script>

    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeUploadUser").click();
        })
    </script>
    @endif
@endpush
