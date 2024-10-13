<div>
    @php
   $profile=\App\Models\Utility::get_file('uploads/avatar');
   @endphp
@section('page-title')
    {{__('Awarded Contracts')}}
@endsection

@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Contracts')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
            {{------------ Start Status Filter ----------------}}
                <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="btn-inner--icon">{{__('Status')}}</span>
                </a>
                <div class="dropdown-menu  project-filter-actions dropdown-steady" id="project_status">
                    <a class="dropdown-item filter-action filter-show-all pl-4 active" href="#">{{__('Show All')}}</a>
                </div>
            {{------------ End Status Filter ----------------}}


        @can('create project')
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newProject" id="toggleOldProject"  data-bs-toggle="tooltip" title="{{__('Create New Project')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
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
                            <th>{{__('Subject')}}</th>
                            <th>{{__('Contractor')}}</th>
                            <th>{{__('Project')}}</th>
                            <th>{{__('Contract Type')}}</th>
                            <th>{{__('Contract Value')}}</th>
                            <th>{{__('Start Date')}}</th>
                            <th>{{__('End Date')}}</th>
                            <th class="text-end">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- @if(isset($projects) && !empty($projects) && count($projects) > 0) --}}
                            {{-- @foreach ($projects as $key => $project) --}}
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            {{-- <p class="mb-0"><a href="{{ route('project.details',$project) }}" class="name mb-0 h6 text-sm">{{ $project->project_name }}</a></p> --}}
                                        </div>
                                    </td>
                                    <td>

                                        <div class="d-flex align-items-center">
                                            {{-- <p class="mb-0"><a href="#" class="name mb-0 h6 text-sm">{{ $project->projectId }}</a></p> --}}
                                        </div>
                                    </td>
                                    <td class="">
                                        {{-- <span class="badge @if($project->status=='pending') bg-secondary
                                            @elseif ($project->status=='in_progress') bg-info
                                            @elseif ($project->status=='on_hold') bg-warning
                                            @elseif ($project->status=='completed') bg-primary
                                            @elseif ($project->status=='canceled') bg-danger
                                            @endif p-2 px-3 rounded">{{ $project->status }}</span> --}}
                                    </td>
                                    
                                    <td class="text-end">
                                        <h5 class="mb-0 text-success">
                                            {{-- {{ $project->project_progress()['percentage'] }} --}}
                                        </h5>
                                        <div class="progress mb-0">
                                            {{-- <div class="progress-bar bg-{{ $project->project_progress()['color'] }}" style="width: {{ $project->project_progress()['percentage'] }};"></div> --}}
                                        </div>
                                    </td>
                                    
                                    <td class="text-end">
                                        
                                    </td>
                                </tr>
                            {{-- @endforeach --}}
                        {{-- @else --}}
                            <tr>
                                <th scope="col" colspan="7"><h6 class="text-center">{{__('No contracts Found.')}}</h6></th>
                            </tr>
                        {{-- @endif --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


{{-- @endsection --}}

<x-toast-notification />
{{-- @livewire('physical-planning.projects.uploadboq') --}}
{{-- @include('livewire.projects.modals.create-project') --}}

</div>
