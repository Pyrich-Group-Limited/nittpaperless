<div>
    @section('page-title')
     Query Reply
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="#">{{ __('Query') }}</a></li>
    @endsection

    <div class="row mt-3">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title">Query Answer Module </h5>
                </div>
                <div class="card-body pt-0">

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" wire:model="subject" class="form-control" readonly disabled>
                        @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="answer" class="form-label"><b>Answer</b></label>
                        <div wire:ignore>
                            <textarea id="message" wire:model="answer" class="form-control tinymce-basic" name="description"></textarea>
                        </div>
                        @error('answer')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="supporting_documents">Supporting Document</label>
                        <input type="file" wire:model.defer="supporting_documents" class="form-control" />
                        <span class="text-danger" wire:loading wire:target="supporting_documents">Loading...</span>
                        @error('supporting_documents')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="modal-footer mt-3">
                        <div wire:loading wire:target="answerQuery"><x-g-loader /></div>
                        <input type="button" wire:click="answerQuery" value="{{ __('Send Query Answer') }}"
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
                        @this.set('answer', editor.getContent());
                    });
                }
            });
        </script>
    @endpush
    <x-toast-notification />

</div>
