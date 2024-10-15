<div>
    @php
        $profile = \App\Models\Utility::get_file('uploads/avatar');
    @endphp
    @section('page-title')
        {{ __('ERGP Details for Projects') }}
    @endsection

    @push('script-page')
    @endpush
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item">{{ __('ERGP Projects') }}</li>
    @endsection
    @section('action-btn')
        <div class="float-end">

            @can('create project')
                <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#AddErgpModal" id="toggleOldProject"
                    data-bs-toggle="tooltip" title="{{ __('Add ERGP') }}" class="btn btn-sm btn-primary">
                    <i class="ti ti-plus text-white"> </i>Add
                </a>
            @endcan
        </div>
    @endsection

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-danger">
                                    <i class="ti ti-report-money"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted">{{ __('Total') }}</small>
                                    <h6 class="m-0">{{ __('ERGP VALUE') }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0">
                                @php
                                    foreach ($ergpDetails as $ergpDetail){

                                    }
                                @endphp
                                {{ \Auth::user()->priceFormat($ergpDetail->category->ergp->project_sum) }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-cash"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted">{{ __('Total') }}</small>
                                    <h6 class="m-0">{{ __('PROJECTS VALUE') }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0">
                                {{ \Auth::user()->priceFormat($ergpDetails->sum('budget')) }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">

        <div class="card mt-4">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('SN') }}</th>
                                <th>{{ __('Project Category') }}</th>
                                <th>{{ __('ERGP CODE') }}</th>
                                <th>{{ __('project Title') }}</th>
                                <th>{{ __('Project Value') }}</th>
                                {{-- <th>{{ __('Action') }}</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($ergpDetails) && !empty($ergpDetails) && count($ergpDetails) > 0)
                                @foreach ($ergpDetails as $ergpDetail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ergpDetail->category->category_name }}</td>
                                        <td>{{ $ergpDetail->category->ergp->code }}</td>
                                        <td>{{ $ergpDetail->project_name }}</td>
                                        <td>₦ {{ number_format($ergpDetail->budget, 2) }}</td>
                                        {{-- <td>...</td> --}}
                                        
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th scope="col" colspan="9">
                                        <h6 class="text-center">{{ __('No Record Found.') }}</h6>
                                    </th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-toast-notification />
<div>
