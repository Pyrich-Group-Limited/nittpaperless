<div>
    @php
    $profile=\App\Models\Utility::get_file('uploads/avatar');
    @endphp
 @section('page-title')
     {{__('ERGP')}}
 @endsection

 @push('script-page')
 @endpush
 @section('breadcrumb')
     <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
     <li class="breadcrumb-item">{{__('ERGP')}}</li>
 @endsection
 @section('action-btn')
        <div class="float-end">

            @can('create project')
                {{-- <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#publishAdvertModal" id="toggleOldProject"
                    data-bs-toggle="tooltip" title="{{ __('Advertise Project') }}" class="btn btn-sm btn-primary">
                    <i class="ti ti-share"></i>
                </a> --}}

                <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#editProject" id="toggleOldProject"
                    data-bs-toggle="tooltip" title="{{ __('Add ERGP') }}" class="btn btn-sm btn-primary">
                    <i class="ti ti-plus text-white"> Add</i>
                </a>
            @endcan
        </div>
    @endsection

<div class="col-xl-12">

    <div class="card mt-4">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th>{{__('SN')}}</th>
                        <th>{{__('ERGP CODE')}}</th>
                        <th>{{__('ERGP TITLE')}}</th>
                        <th>{{__('Total Value')}}</th>
                        <th>{{__('Amount Paid')}}</th>
                        <th>{{__('Balance')}}</th>
                        <th>{{__('Deficit')}}</th>
                        <th>{{__('Year')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                    </thead>

                    <tbody>
                    {{-- @foreach ($transactions as $transaction) --}}
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div>
