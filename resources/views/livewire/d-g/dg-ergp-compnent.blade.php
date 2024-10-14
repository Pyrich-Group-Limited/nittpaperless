<div>
    @php
        $profile = \App\Models\Utility::get_file('uploads/avatar');
    @endphp
    @section('page-title')
        {{ __('ERGP') }}
    @endsection

    @push('script-page')
    @endpush
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item">{{ __('ERGP') }}</li>
    @endsection
    @section('action-btn')
        <div class="float-end">

            @can('create project')
                {{-- <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#publishAdvertModal" id="toggleOldProject"
                    data-bs-toggle="tooltip" title="{{ __('Advertise Project') }}" class="btn btn-sm btn-primary">
                    <i class="ti ti-share"></i>
                </a> --}}

                <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#AddErgpModal" id="toggleOldProject"
                    data-bs-toggle="tooltip" title="{{ __('Add ERGP') }}" class="btn btn-sm btn-primary">
                    <i class="ti ti-plus text-white"> </i>Add
                </a>
            @endcan
        </div>
    @endsection

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
                                <th>{{ __('ERGP TITLE') }}</th>
                                <th>{{ __('Total Value') }}</th>
                                <th>{{ __('Amount Paid') }}</th>
                                <th>{{ __('Balance') }}</th>
                                <th>{{ __('Deficit') }}</th>
                                <th>{{ __('Year') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($ergps) && !empty($ergps) && count($ergps) > 0)
                                @foreach ($ergps as $ergp)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ergp->projectCategory->category_name }}</td>
                                        <td>{{ $ergp->code }}</td>
                                        <td>{{ $ergp->title }}</td>
                                        <td>₦ {{ number_format($ergp->project_sum, 2) }}</td>
                                        <td>₦ {{ number_format($ergp->amount_paid, 2) }}</td>
                                        <td>₦ {{ number_format($ergp->balance, 2) }}</td>
                                        <td>₦ {{ number_format($ergp->deficit, 2) }}</td>
                                        <td>{{ $ergp->year }}</td>
                                        <td>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="{{ route('project.details', $ergp->id) }}"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                    data-url="" data-ajax-popup="false" data-size="lg"
                                                    data-bs-toggle="tooltip" title="{{ __('Show Details') }}"
                                                    data-title="{{ __('Show Details') }}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                        </td>
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
    {{-- @include('livewire.physical-planning.projects.modals.add-ergp') --}}
    <x-toast-notification />
<div>
