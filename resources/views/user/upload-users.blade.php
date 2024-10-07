<div class="modal" id="uploadUsers" tabindex="-1" role="dialog" wire:ignore>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {{Form::open(array('url'=>'upload-users','enctype'=>'multipart/form-data','method'=>'post'))}}
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="applyLeave">Upload Users
                    </h5>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    {{Form::file('uploadFile',null,array('class'=>'form-control','placeholder'=>__('Select File'),'required'=>'required'))}}
                                    @error('uploadFile')
                                    <small class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <input type="submit" value="{{__('Download Template')}}" class="btn  btn-primary">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
                        <input type="submit" value="{{__('Onboard Users')}}" class="btn  btn-primary">
                    </div>
                {{Form::close()}}
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
    @endif
@endpush
