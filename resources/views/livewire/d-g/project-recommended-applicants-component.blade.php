<div>
    @php
   $profile=\App\Models\Utility::get_file('uploads/avatar');
   @endphp
@section('page-title')
    {{__('Top 3 Applicants')}}
@endsection

@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Top 3 Applicants')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        {{------------ Start Filter ----------------}}
                <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-filter"></i>
                </a>
                <div class="dropdown-menu  dropdown-steady" id="project_sort">
                    <a class="dropdown-item active" href="#" data-val="created_at-desc">
                        <i class="ti ti-sort-descending"></i>{{__('Newest')}}
                    </a>
                    <a class="dropdown-item" href="#" data-val="created_at-asc">
                        <i class="ti ti-sort-ascending"></i>{{__('Oldest')}}
                    </a>

                    <a class="dropdown-item" href="#" data-val="project_name-desc">
                        <i class="ti ti-sort-descending-letters"></i>{{__('From Z-A')}}
                    </a>
                    <a class="dropdown-item" href="#" data-val="project_name-asc">
                        <i class="ti ti-sort-ascending-letters"></i>{{__('From A-Z')}}
                    </a>
                </div>

            {{------------ End Filter ----------------}}

            {{------------ Start Status Filter ----------------}}
                <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="btn-inner--icon">{{__('Status')}}</span>
                </a>
                <div class="dropdown-menu  project-filter-actions dropdown-steady" id="project_status">
                    <a class="dropdown-item filter-action filter-show-all pl-4 active" href="#">{{__('Show All')}}</a>
                    {{-- @foreach(\App\Models\Project::$project_status as $key => $val)
                        <a class="dropdown-item filter-action pl-4" href="#" data-val="{{ $key }}">{{__($val)}}</a>
                    @endforeach --}}
                </div>
            {{------------ End Status Filter ----------------}}
    </div>
@endsection

{{-- @section('content') --}}
    <div class="col-xl-12 mt-5">

        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{__('#')}}</th>
                            <th>{{__('Applicant Name')}}</th>
                            <th>{{__('Company Name')}}</th>
                            <th>{{__('Year of Inc.')}}</th>
                            <th>{{__('TIN')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Phone')}}</th>
                            <th>{{__('Application Status')}}</th>
                            <th class="text-end">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($projectApplicants)>0)
                            @foreach ($projectApplicants as $projectApplicant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0">{{ $projectApplicant->contractor->name }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0">{{ $projectApplicant->applicant->company_name }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0">{{ $projectApplicant->applicant->year_of_incorporation }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0">{{ $projectApplicant->applicant->company_tin }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0">{{ $projectApplicant->applicant->email }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0">{{ $projectApplicant->applicant->phone }}</p>
                                        </div>
                                    </td>
                                    <td class="">
                                        <span class="badge @if($projectApplicant->application_status=='pending') bg-warning
                                            @elseif ($projectApplicant->application_status=='on_review') bg-info
                                            @elseif ($projectApplicant->application_status=='selected') bg-primary
                                            @elseif ($projectApplicant->application_status=='rejected') bg-danger
                                            @endif p-2 px-3 rounded">{{ $projectApplicant->application_status }}</span>
                                    </td>
                                    
                                    <td class="text-end">
                                        <span>
                                            {{-- @can('edit project') --}}
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" id="toggleApplicantDetails" data-bs-target="#viewApplicantModal" data-size="lg" data-bs-toggle="tooltip" title="{{__('View Applicant Details')}}" data-title="{{__('View Applicant Details')}}">
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                            {{-- @endcan  --}}
                                            {{-- @can('edit project') --}}
                                            <div class="action-btn bg-info ms-2">
                                                    <a href="#" wire:click="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#uploadBOQModal" data-size="lg" data-bs-toggle="tooltip" title="{{__('Recommend to DG')}}" data-title="{{__('Recommend contractor for DG Approval')}}">
                                                        <i class="ti ti-share text-white"></i>
                                                    </a>
                                                </div>
                                            {{-- @endcan --}}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th scope="col" colspan="9"><h6 class="text-center">{{__('No Appplicants yet.')}}</h6></th>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>


{{-- @endsection --}}

<x-toast-notification />
@include('livewire.d-g.modals.recommended-applicant-details')
{{-- @livewire('physical-planning.projects.uploadboq') --}}

</div>
