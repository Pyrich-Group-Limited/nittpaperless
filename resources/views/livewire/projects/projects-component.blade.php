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
        @if($view == 'grid')
            <a href="{{ route('projects.list','list') }}"  data-bs-toggle="tooltip" title="{{__('List View')}}" class="btn btn-sm btn-primary">
                <i class="ti ti-list"></i>
            </a>

        @else
            <a href="{{ route('created-projects') }}"  data-bs-toggle="tooltip" title="{{__('Grid View')}}" class="btn btn-sm btn-primary">
                <i class="ti ti-layout-grid"></i>
            </a>
        @endif


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


        @can('create project')
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newProject" id="toggleOldProject"  data-bs-toggle="tooltip" title="{{__('Create New Project')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection

{{-- @section('content') --}}
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{__('#')}}</th>
                            <th>{{__('Project')}}</th>
                            <th>{{__('Project No.')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Users')}}</th>
                            <th>{{__('Completion')}}</th>
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
                                    <td class="text-end">
                                        <span>
                                            {{-- @can('edit project') --}}
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="{{ route('project.details', $project->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="" data-ajax-popup="false" data-size="lg" data-bs-toggle="tooltip" title="{{__('Show Details')}}" data-title="{{__('Show Details')}}">
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                            {{-- @endcan --}}
                                            {{-- @can('edit project') --}}
                                                <div class="action-btn bg-info ms-2">
                                                        {{-- <a href="{{ route('project.edit',$project) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{ URL::to('projects/'.$project->id.'/edit') }}" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Edit Project')}}">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a> --}}
                                                        <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#editProject" id="toggleOldProject"  wire:click="selProject({{$project->id}})"  data-bs-toggle="tooltip" title="{{__('Modify Project')}}"  class="mx-3 btn btn-sm d-inline-flex align-items-center">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                        {{-- <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#viewApplicantModal" wire:click="setApplicant('{{ $applicant->id }}')" href="#"><i class="fa fa-eye"></i> View Details</a> --}}
                                                    </div>
                                            {{-- @endcan --}}
                                            {{-- @can('edit project') --}}
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#publishAdvertModal" id="toggleOldProject"  data-bs-toggle="tooltip" title="{{__('Advertise Project')}}"  class="mx-3 btn btn-sm d-inline-flex align-items-center">
                                                    <i class="ti ti-share text-white"></i>
                                                </a>
                                            </div>
                                    {{-- @endcan --}}

                                            @can('delete project')
                                                <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['projects.user.destroy', [$project->id,$user->id]]]) !!}
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}"><i class="ti ti-trash text-white"></i></a>
                                                        {!! Form::close() !!}
                                                    </div>
                                            @endcan
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th scope="col" colspan="7"><h6 class="text-center">{{__('No Projects Found.')}}</h6></th>
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
@include('livewire.projects.modals.create-project')
@include('livewire.projects.modals.edit-project')
@include('livewire.physical-planning.projects.modals.new-advert')
</div>
