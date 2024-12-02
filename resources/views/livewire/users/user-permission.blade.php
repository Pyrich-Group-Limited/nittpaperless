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
        <div class="col-lg-12 col-md-12 col-sm-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link @if ($loop->first == 1) active @endif"
                            id="pills-{{ $loop->index }}-tab" data-bs-toggle="pill" href="#perm_{{ $loop->index }}"
                            role="tab" aria-controls="pills-{{ $loop->index }}"
                            aria-selected="false">{{ $category->category }}</a>
                    </li> &nbsp;
                @endforeach

            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach ($categories as $category)
                    <div class="tab-pane fade @if ($loop->first == 1) show active @endif" id="perm_{{ $loop->index }}" role="tabpanel" aria-labelledby="pills-{{ $loop->index }}-tab">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <div class="col-md-12">
                                    <div class="row">
                                        @foreach (Spatie\Permission\Models\Permission::where('category', $category->category)->groupBy('module')->orderBy('module', 'ASC')->get() as $module)

                                        <div class="col-md-3 mt-1">
                                            <li class="nav-item">
                                                <a class="nav-link active" wire:click="setModule('{{ $module->module }}')"
                                                    data-bs-toggle="modal" data-bs-target="#managePermission" href="#staff"
                                                    role="tab" aria-controls="pills-home"
                                                    aria-selected="true">{{ $module->module }}</a>
                                        </li>
                                        </div>

                                @endforeach
                                    </div>

                                </div>

                            </ul>
                    </div>
                @endforeach
            </div>
            <div align="center" wire:loading wire:target="updatePermission"><x-g-loader /></div>

        <input type="button" wire:click="updatePermission" value="{{ __('Update Permissins') }}"
        class="btn  btn-warning mt-3">
        </div>

    </div>
    @include('livewire.users.modals.manage-user-permission')
    <x-toast-notification />

</div>
{{-- {{Form::model($role,array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }} --}}
<div class="modal-body">

</div>
