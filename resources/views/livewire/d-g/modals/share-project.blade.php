<div id="createUser">
    <div class="modal" id="shareProjectDetails" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Share Project Details with HoDs</h5>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="shareProjectDetails">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12" wire:ignore>
                                        <div class="form-group" >
                                            <label for="">Share with: (<span class="text-xs text-muted">{{ __('You can select one or more users to share file with')}}</span>) </label>
                                            <select wire:model="selectedHods" id="choices-multiple1" class="form-control sel_users select2" multiple>
                                                @if (is_array($users) || is_object($users))
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }} &nbsp; ({{ $user->type }})</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('selectedHods') 
                                                <small class="invalid-type_of_leave" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="modal-footer">
                                <div wire:loading wire:target="shareProjectDetails"><x-g-loader /></div>
                                <input type="button" id="closeModal" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
                                <input type="submit" value="{{__('Share')}}" class="btn  btn-primary">
                            </div>
                        </form>
                </div>
            </div>
        </div>

    </div>

    @push('script')
        <script>
            $(document).ready(function(){
                $('.sel_users').select2();
            }).on('change', function(){
                var data = $('.sel_users').val();
                @this.set('selectedHods',data);
            });

            window.addEventListener('print',event => {
                document.getElementById("print").click();
            });
        </script>
    @endpush
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeModal").click();
    })
</script>



