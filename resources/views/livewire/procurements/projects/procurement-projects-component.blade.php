@section('page-title')
    {{__('Manage Projects')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Projects')}}</li>
@endsection
@push('script-page')


    <script>
        function copyToClipboard(element) {

            var copyText = element.id;
            navigator.clipboard.writeText(copyText);
            // document.addEventListener('copy', function (e) {
            //     e.clipboardData.setData('text/plain', copyText);
            //     e.preventDefault();
            // }, true);
            //
            // document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        }
    </script>


@endpush


@section('action-btn')
    <div class="float-end">
        @can('create job')
            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#publishAdvertModal"  data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create New Job')}}">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection

    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-cast"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted">{{__('Total')}}</small>
                                    <h6 class="m-0">{{__('Projects')}}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0">{{ count($totalProjects)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-info">
                                    <i class="ti ti-cast"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted">{{__('Pending')}}</small>
                                    <h6 class="m-0">{{__('Projects')}}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0">{{ count($totalProjects->where('status','Pending') )}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-warning">
                                    <i class="ti ti-cast"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted">{{__('Completed')}}</small>
                                    <h6 class="m-0">{{__('Projects')}}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0">{{ count($totalProjects->where('status','Completed') )}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('Project Name')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Start Date')}}</th>
                                <th>{{__('End Date')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Created At')}}</th>
                                @if( Gate::check('edit Job') ||Gate::check('delete job') ||Gate::check('show job'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->project_name}}</td>
                                    <td>{!! Str::limit(strip_tags($project->description),120) !!}</td>
                                    <td>{{\Auth::user()->dateFormat($project->start_date)}}</td>
                                    <td>{{\Auth::user()->dateFormat($project->end_date)}}</td>
                                    <td>
                                        @if($job->status=='active')
                                            <span class="status_badge badge bg-success p-2 px-3 rounded">{{ $project->status }}</span>
                                        @else
                                            <span class="status_badge badge bg-danger p-2 px-3 rounded">{{ $project->status  }}</span>
                                        @endif
                                    </td>
                                    <td>{{ \Auth::user()->dateFormat($project->created_at) }}</td>
                                    @if( Gate::check('edit job') ||Gate::check('delete job') || Gate::check('show job'))
                                        <td>
                                            @can('show job')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-title="{{__('View Project')}}" title="{{__('View')}}"  class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" data-original-title="{{__('View Project')}}">
                                                        <i class="ti ti-eye text-white"></i></a>
                                                </div>
                                            @endcan
                                            @can('edit job')
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-title="{{__('Edit Project')}}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit Project')}}">
                                                        <i class="ti ti-pencil text-white"></i></a>
                                                </div>
                                            @endcan
                                            @can('edit job')
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" data-title="{{__('Advertise Project')}}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit Project')}}">
                                                    <i class="ti ti-pencil text-white"></i></a>
                                            </div>
                                        @endcan
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('livewire.procurements.projects.modals.new-advert')
