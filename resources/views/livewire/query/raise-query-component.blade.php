<div>
    @section('page-title')
    Raise Query
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="#">{{ __('Query') }}</a></li>
    @endsection

    <div class="row mt-3">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title">Raise a Query </h5>
                </div>
                <div class="card-body pt-0">

                    <div class="form-group">
                        <label for="staff">Staff</label>
                        <select wire:model.live="staff_id" id="staff" class="form-control">
                            <option value="">Select Staff</option>
                            @foreach($staff as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('staff_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" wire:model="subject" class="form-control">
                        @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- <div class="form-group">
                        <label for="query_details">Query Details</label>
                        <textarea id="query_details" wire:model="query_details" class="form-control"></textarea>
                        @error('query_details') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> --}}

                    <div class="mb-3">
                        <label for="query_details" class="form-label">Query Details</label>
                        <div wire:ignore>
                            <textarea id="message" wire:model="query_details" class="form-control tinymce-basic" name="description"></textarea>
                        </div>
                        @error('query_details')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="queryDocument">queryDocument (if any)</label>
                        <input type="file" wire:model.defer="queryDocument" class="form-control" />
                        <span class="text-danger" wire:loading wire:target="queryDocument">Loading...</span>
                        @error('queryDocument')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="modal-footer mt-3">
                        <div wire:loading wire:target="raiseQuery"><x-g-loader /></div>
                        <input type="button" wire:click="raiseQuery" value="{{ __('Submit') }}"
                            class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>


    </div>
    {{-- @push('script')
        <script>
            window.addEventListener('feedback', event => {
                tinyMCE.activeEditor.setContent("");
            });
        </script>
    @endpush --}}

    @push('script')
        <script src="https://cdn.tiny.cloud/1/cvjfkxqlo8ylwqn3xgo15h2bd4xl6n7m6k5d0avjcq93c1i7/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#message',
                branding: false,
                setup: function(editor) {
                    editor.on('init change', function() {
                        editor.save();
                    });
                    editor.on('change', function(e) {
                        @this.set('description', editor.getContent());
                        @this.set('query_details', editor.getContent());
                    });
                }
            });
        </script>
    @endpush
    <x-toast-notification />
    @include('livewire.query.modals.secrete-code-modal')
</div>
