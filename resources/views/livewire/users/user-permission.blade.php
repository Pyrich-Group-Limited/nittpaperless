<div>
    @section('page-title')
    {{ $selStaff->name}}
@endsection
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">{{__('Permission ')}}</a></li>
    <li class="breadcrumb-item">{{__('Setup')}}</li><hr>
@endsection
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <div class="row">
                    @foreach ($modules as $module)
                        <div class="col-md-3 mt-1">
                            <li class="nav-item">
                                <a class="nav-link active" wire:click="setModule('{{ $module->module }}')"
                                    data-bs-toggle="modal" data-bs-target="#managePermission" href="#staff"
                                    role="tab" aria-controls="pills-home"
                                    aria-selected="true">{{ $module->module }}</a>
                            </li>
                        </div>
                    @endforeach

                    <div align="center" wire:loading wire:target="updatePermission"><x-g-loader /></div>

                    <input type="button" wire:click="updatePermission" value="{{ __('Update Permissins') }}"
                    class="btn  btn-warning mt-3">

                </div>
            </ul>
        </div>
    </div>
    @include('livewire.users.modals.manage-user-permission')
    <x-toast-notification />

</div>
{{-- {{Form::model($role,array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }} --}}
{{-- <div class="modal-body">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                @foreach($roles as $role)
                <li class="nav-item">
                    <a class="nav-link @if($role->name==Auth::user()->type) active @endif" id="pills-staff-tab" data-bs-toggle="pill" href="#{{ $role->name }}" role="tab" aria-controls="pills-{{ $role->name }}" aria-selected="true">{{ strtoupper($role->name) }}</a>
                </li>
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach($roles as $role)
                <div class="tab-pane fade @if($role->name==Auth::user()->type) show active @endif" id="{{ $role->name }}" role="tabpanel" aria-labelledby="pills-{{ $role->name }}-tab">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <div class="row">
                                    @foreach ($modules as $module)
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
                            </ul>
                        </div>
                </div>
                @endforeach

                <div align="center" wire:loading wire:target="updatePermission"><x-g-loader /></div>

                <input type="button" wire:click="updatePermission" value="{{ __('Update Permissins') }}"
                class="btn  btn-warning mt-3">
            </div>
        </div>

    </div>
</div>
 --}}
