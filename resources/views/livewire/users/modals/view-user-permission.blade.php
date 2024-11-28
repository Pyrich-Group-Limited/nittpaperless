<div id="viewPermissionss">
    <div class="modal" id="viewPermissions" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">@if($selUser) {{$selUser->name}} @endif Permissions
                        </h5>

                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                @if(count($permissions)>0)
                                @foreach ($permissions as $permission)
                                    <div class=" col-md-4" wire:ignore.self>
                                        <div class="form-check form-check-inline mt-2" wire:ignore.self>
                                            <label class="form-check-label" wire:ignore.self>
                                                <input disabled type="checkbox" key="{{ $permission}}" id="{{ $permission}}" class="form-check-input"
                                                    @if ($permission) checked @endif
                                                    wire:model.defer="sel_permissions"
                                                    value="{{ $permission }}">{{ $permission }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                    <div align="center"><x-g-loader /></div>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <input type="button" value="{{ __('OK') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">

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
    @endpush

</div>
