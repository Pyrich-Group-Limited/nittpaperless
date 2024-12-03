<div>
    @php
   $profile=\App\Models\Utility::get_file('uploads/avatar');
   @endphp
@section('page-title')
    {{__('Manage Projects')}}
@endsection

@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Projects')}}</li>
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


        {{-- @can('create project')
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newProject" id="toggleOldProject"  data-bs-toggle="tooltip" title="{{__('Create New Project')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        @endcan --}}
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
                            <th>{{__('Project')}}</th>
                            <th>{{__('Project No.')}}</th>
                            <th>{{__('Project Status')}}</th>
                            <th>{{__('Users')}}</th>
                            <th>{{__('Completion')}}</th>
                            <th>{{__('Approval Status')}}</th>
                            <th class="text-end">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($projects) && !empty($projects) && count($projects) > 0)
                            @foreach ($projects as $key => $project)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0"><a href="{{ route('project.details',$project) }}" class="name mb-0 h6 text-sm">{{ $project->project_name }}</a></p>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="d-flex align-items-center">
                                            <p class="mb-0"><a href="#" class="name mb-0 h6 text-sm">{{ $project->projectId }}</a></p>
                                        </div>
                                    </td>
                                    <td class="">
                                        <span class="badge @if($project->status=='pending') bg-secondary
                                            @elseif ($project->status=='in_progress') bg-info
                                            @elseif ($project->status=='on_hold') bg-warning
                                            @elseif ($project->status=='completed') bg-primary
                                            @elseif ($project->status=='canceled') bg-danger
                                            @endif p-2 px-3 rounded">{{ $project->status }}</span>
                                    </td>
                                    <td class="">
                                        <div class="avatar-group" id="project_{{ $project->id }}">
                                            @if(isset($project->users) && !empty($project->users) && count($project->users) > 0)
                                                @foreach($project->users as $key => $user)
                                                    @if($key < 3)
                                                        <a href="#" class="avatar rounded-circle">
                                                            <img @if($user->avatar) src="{{asset('/storage/uploads/avatar/'.$user->avatar)}}" @else src="{{asset('uploads/user.png')}}" @endif title="{{ $user->name }}" style="height:36px;width:36px;">
                                                        </a>
                                                    @else
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if(count($project->users) > 3)
                                                    <a href="#" class="avatar rounded-circle avatar-sm">
                                                        <img avatar="+ {{ count($project->users)-3 }}" style="height:36px;width:36px;">
                                                    </a>
                                                @endif
                                            @else
                                                {{ __('-') }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <h5 class="mb-0 text-success">
                                            {{ $project->project_progress()['percentage'] }}
                                        </h5>
                                        <div class="progress mb-0">
                                            <div class="progress-bar bg-{{ $project->project_progress()['color'] }}" style="width: {{ $project->project_progress()['percentage'] }};"></div>
                                        </div>
                                    </td>
                                    <td class="">
                                        @if($project->advert_approval_status == false)
                                            <span class="badge bg-warning p-2 px-3 rounded">Pending</span>
                                        @elseif ($project->advert_approval_status== true)
                                            <span class="badge bg-success p-2 px-3 rounded">Approved</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <span>
                                            {{-- @can('edit project') --}}
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="{{ route('dg.projectDetails', $project->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="" data-ajax-popup="false" data-size="lg" data-bs-toggle="tooltip" title="{{__('Show Details')}}" data-title="{{__('Show Details')}}">
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                            {{-- @endcan --}}
                                        </span>

                                        @if($project->project_boq!=null && $project->advert_approval_status==true)
                                            {{-- @can('edit project') --}}
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="{{ route('dg.projectApplicants',$project->id) }}" data-size="lg"  data-bs-toggle="tooltip" title="{{__('View Recommended Applicant')}}"  class="mx-3 btn btn-sm d-inline-flex align-items-center">
                                                        <i class="ti ti-users text-white"></i>
                                                    </a>
                                                </div>
                                            {{-- @endcan --}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th scope="col" colspan="7"><h6 class="text-center">{{__('No Projects Pending approval Found.')}}</h6></th>
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
{{-- @livewire('physical-planning.projects.uploadboq') --}}
{{-- @include('livewire.projects.modals.create-project') --}}

</div>
