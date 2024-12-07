<div>
    @php
   $profile=\App\Models\Utility::get_file('uploads/avatar');
   @endphp
@section('page-title')
    {{__('Supplies')}}
@endsection

@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Supplies')}}</li>
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
                            <th>{{__('Status')}}</th>
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
                                            <img src="{{ asset('uploads/project.png') }}" class="wid-40 rounded me-3">
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

                                            @if($project->project_boq==null) <span class="badge bg-danger p-2 px-3 rounded">Pending BoQ</span> @endif
                                    </td>

                                    <td class="text-end">
                                        <span>
                                            @can('edit project')
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="{{ route('supplies.details', $project->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="" data-ajax-popup="false" data-size="lg" data-bs-toggle="tooltip" title="{{__('Show Details')}}" data-title="{{__('Show Details')}}">
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                            @endcan


                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th scope="col" colspan="7"><h6 class="text-center">{{__('No Supplies yet.')}}</h6></th>
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

</div>
