<div id="createUser">
    <div class="modal" id="shareProjectDetails" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Share Project Details</h5>
                    </div>
                    <div class="modal-body">
                        <form action="#" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    {{-- <div class="form-group">
                                        <label for="">Project Applicant</label>
                                            <h2>{{ $projectApplicant->applicant->company_name }}</h2>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="">Share with: (<span class="text-xs text-muted">{{ __('You can select one or more users to share file with')}}</span>) </label>
                                        <select name="user_id[]" id="choices-multiple1" class="form-control select2" multiple>
                                            <option value="#">Select one or more Users</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }} &nbsp; ({{ $user->type }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                </div>
                            </div>
                    
                            <div class="modal-footer">
                                <input type="button" id="closeModal" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
                                <input type="submit" value="{{__('Share')}}" class="btn  btn-primary">
                            </div>
                        </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeModal").click();
    })
</script>



