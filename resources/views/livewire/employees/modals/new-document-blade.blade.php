<div class="modal" id="newfile" tabindex="-1" wire:ignore.self role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newfile">Create New Document</h5>
            </div>
            <div class="modal-body">
                <form >
                    @csrf
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="form-group">
                                <label for="">Document Name</label>
                                <input type="text" wire:model="file_name" name="filename" value="{{ old('filename')}}" class="form-control" >
                                @error('file_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Document Content</label>
                                <input type="file" wire:model="file" name="file" aria-multiselectable="" value="{{ old('file')}}" class="form-control" >
                                @error('file')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <strong class="text-danger" wire:loading wire:target="file">Loading...</strong>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div wire:loading wire:target="uploadDocument"><x-g-loader /></div>
                        <input type="button" id="closeUplaodDocument" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="uploadDocument" value="{{ __('Upload Document') }}" class="btn  btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeUplaodDocument").click();
        })
    </script>
@endpush
<x-toast-notification />
