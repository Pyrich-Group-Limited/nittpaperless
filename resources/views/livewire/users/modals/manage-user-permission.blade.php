<div>
    <div class="modal" id="managePermission" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $selStaff->name ?? '' }} {{ $selModule  }} Permissions</h5>
                    <label class="form-check-label">
                        <input type="checkbox" wire:model="selectAll" class="form-check-input">
                        Select All
                    </label>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            @if(count($permissions) > 0)
                                @foreach ($permissions as $permission)
                                    <div class="col-md-4">
                                        <div class="form-check form-check-inline mt-2">
                                            {{-- <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input"
                                                       wire:model="sel_permissions"
                                                       value="{{ $permission }}"
                                                       @if(in_array($permission, $sel_permissions)) checked @endif>
                                                {{ $permission }}
                                            </label> --}}
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input"
                                                wire:model="sel_permissions"
                                                value="{{ $permission }}"> {{ $permission }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center">No permissions available for this module.</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div align="center" wire:loading wire:target="updatePermission"><x-g-loader /></div>
                    <button type="button" class="btn btn-primary" wire:click="updatePermission">
                        Save Changes
                    </button>
                    <button type="button" id="closePermissions"class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closePermissions").click();
    })
</script>