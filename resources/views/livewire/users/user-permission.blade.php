<div>
    @section('page-title')
        {{ $selStaff->name }}
    @endsection
    @push('script-page')
    @endpush
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="#">{{ __($selStaff->name) }}</a></li>
        <li class="breadcrumb-item">{{ __('Permission') }}</li>
        <hr>
    @endsection
    
    <div class="row" wire:ignore>
        <div class="col-lg-12">
            <ul class="nav nav-tabs mb-4 justify-content-center" id="permissionTabs" role="tablist">
                @foreach ($categories as $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if ($loop->first) active @endif"
                                id="tab-{{ $loop->index }}"
                                data-bs-toggle="tab"
                                data-bs-target="#content-{{ $loop->index }}"
                                type="button"
                                role="tab"
                                aria-controls="content-{{ $loop->index }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $category->category }}
                        </button>
                    </li>
                @endforeach
            </ul>
    
            <div class="tab-content" id="permissionTabsContent">
                @foreach ($categories as $category)
                    <div class="tab-pane fade @if ($loop->first) show active @endif"
                         id="content-{{ $loop->index }}"
                         role="tabpanel"
                         aria-labelledby="tab-{{ $loop->index }}">
    
                        <div class="row g-3">
                            @foreach (
                                Spatie\Permission\Models\Permission::where('category', $category->category)
                                    ->groupBy('module')
                                    ->orderBy('module', 'ASC')
                                    ->get() as $module
                            )
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-md h-100">
                                        <div class="card-body d-flex align-items-center justify-content-between">
                                            <span class="fw-semibold text-dark">{{ $module->module }}</span>
                                            <button class="btn btn-sm btn-outline-primary"
                                                    wire:click="setModule('{{ $module->module }}')"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#managePermission">
                                                Manage
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
    
            <div class="text-center my-4" wire:loading wire:target="updatePermission">
                <x-g-loader />
            </div>
    
            <div class="text-center mt-4">
                <button wire:click="updatePermission" class="btn btn-warning btn-lg px-5">
                    {{ __('Update Permissions') }}
                </button>
            </div>
        </div>
    </div>
    @include('livewire.users.modals.manage-user-permission')
    <x-toast-notification />

</div>
<div class="modal-body">

</div>
