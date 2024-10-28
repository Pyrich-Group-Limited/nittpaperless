@section('page-title')
    {{ucwords($project->project_name)}}
@endsection
@push('script-page')
    </script>

    {{--share project copy link--}}
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
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('projects.index')}}">{{__('Project')}}</a></li>
    <li class="breadcrumb-item">{{ucwords($project->project_name)}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        @if($project->project_boq==null)
            @can('edit project')
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#uploadBOQModal" id="toggleUploadBOQ"  data-bs-toggle="tooltip" title="{{__('Upload Bill of Quantity')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-upload"></i>
            </a>
            @endcan
        @else
        @can('edit project')
        <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#uploadBOQModal" id="toggleUploadBOQ"  data-bs-toggle="tooltip" title="{{__('Edit Bill of Quantity')}}"  class="btn btn-sm btn-primary">
            <i class="ti ti-edit"></i>
        </a>
        @endcan
        @endif
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
                                <small class="text-muted">{{__('Total')}}</small>
                                <h6 class="m-0">{{__('Budget')}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-end">
                        <h4 class="m-0">{{ \Auth::user()->priceFormat($project->budget)}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->type !='client')
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-report-money"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted">{{__('Total')}}</small>
                                    <h6 class="m-0">{{__('Expense')}}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0">{{ \Auth::user()->priceFormat($project_data['expense']['total']) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-lg-4 col-md-6"></div>
    @endif
    <div class="col-lg-4 col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar me-3">
                        <img {{ $project->img_image }} alt="" class="img-user wid-45 rounded-circle">
                    </div>
                    <div class="d-block  align-items-center justify-content-between w-100">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="mb-1"> {{$project->project_name}}</h5>
                            <p class="mb-0 text-sm">
                            <div class="progress-wrapper">
                                <span class="progress-percentage"><small class="font-weight-bold">{{__('Completed:')}} : </small>{{ $project->project_progress()['percentage'] }}</span>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="{{ $project->project_progress()['percentage'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $project->project_progress()['percentage'] }};"></div>
                                </div>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <h4 class="mt-3 mb-1"></h4>
                        <p> {{$project->description }}</p>
                    </div>
                </div>
                <div class="card bg-primary mb-0">
                    <div class="card-body">
                        <div class="d-block d-sm-flex align-items-center justify-content-between">
                            <div class="row align-items-center">
                                <span class="text-white text-sm">{{__('Start Date')}}</span>
                                <h5 class="text-white text-nowrap">{{ Utility::getDateFormated($project->start_date) }}</h5>
                            </div>
                            <div class="row align-items-center">
                                <span class="text-white text-sm">{{__('End Date')}}</span>
                                <h5 class="text-white text-nowrap">{{ Utility::getDateFormated($project->end_date) }}</h5>
                            </div>

                        </div>
                        <div class="row">
                            <span class="text-white text-sm">{{__('Contractor')}}</span>
                            <h5 class="text-white text-nowrap">{{ (!empty($project->client)?$project->client->name: '-') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5>{{__('Bill of Quantity')}}</h5>
                    <div class="float-end">
                        <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#viewBOQModal" id="toggleUploadBOQ"  data-bs-toggle="tooltip" title="{{__('Create')}}"  class="btn btn-sm btn-primary">
                            <i class="ti ti-eye"></i>
                        </a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @if(count($project->boqs)>0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{__('SN')}}</th>
                                <th>{{__('Item')}}</th>
                                <th>{{__('Unit Price')}}</th>
                                <th>{{__('QTY')}}</th>
                                <th>{{__('Total')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($project->boqs as $key => $boq)
                                @php
                                    $totalSum = $totalSum + ($boq->quantity * $boq->unit_price);
                                @endphp
                                    <tr>
                                        <td> <p>{{ $key+1 }}</p> </td>
                                        <td> <p>{{ $boq->description }}</p> </td>
                                        <td> <p>{{ number_format($boq->unit_price) }}</p> </td>
                                        <td> <p>{{ $boq->quantity }}</p> </td>
                                        <td> <p>{{ number_format($boq->quantity * $boq->unit_price) }}</p> </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td></td>
                                    <td><b>SUB TOTAL</b></td>
                                    <td> <b>{{ number_format($totalSum) }}</b> </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td></td>
                                    <td><b>VAT(7.5%)</b></td>
                                    <td> <b>{{ number_format(7.5/100 * ($totalSum)) }}</b> </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Profit Margin(10%)</b></td>
                                    @php
                                        $PM = 10/100 * ($totalSum);
                                    @endphp
                                    <td> <b>{{number_format($PM) }}</b> </td>
                                </tr>

                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td></td>
                                    <td><b>SUM TOTAL</b></td>
                                    <td> <b>{{ number_format((7.5/100 * ($totalSum)) + $totalSum) }}</b> </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="py-5">
                            <h6 class="h6 text-center">{{__('No Bill of Quantity Uploaded yet!')}}</h6>
                        </div>
                    @endif
                </ul>

            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5>{{__('Members')}}</h5>
                    @can('edit project')
                        <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#addProjectUser"
                        id="toggleUploadProjectUser" data-bs-toggle="tooltip" title="{{ __('Add Member') }}"
                        class="btn btn-sm btn-primary">
                        <i class="ti ti-plus"></i>
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush list" id="project_users">
                    @foreach($project->users as $user)
                        <li class="list-group-item px-0">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-sm-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar rounded-circle avatar-sm me-3">
                    {{--                        <img src="@if($user->avatar) src="{{asset('/storage/uploads/avatar/'.$user->avatar)}}" @else src="{{asset('/storage/uploads/avatar/avatar.png')}}" @endif " alt="kal" class="img-user">--}}
                                            <img @if($user->avatar) src="{{asset('/storage/uploads/avatar/'.$user->avatar)}}" @else src="{{ asset('uploads/user.png')}}" @endif  alt="image" >

                                        </div>
                                        <div class="div">
                                            <h5 class="m-0">{{ $user->name }}</h5>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-auto text-sm-end d-flex align-items-center">
                                    <div class="action-btn bg-danger ms-2">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['projects.user.destroy',  [$project->id,$user->id]]]) !!}
                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}"><i class="ti ti-trash text-white"></i></a>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5>{{__('Attachements')}}</h5>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @if($project->project_boq!=null)
                        <li class="list-group-item px-0">
                            <div class="row align-items-center justify-content-between">
                                <div class="col mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="div">
                                            <h6 class="m-0">{{ $project->project_name }} Bill of Quantity</h6>
                                            <small class="text-muted">{{ $project->file_size }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-sm-end d-flex align-items-center">
                                    <div class="action-btn bg-info ms-2">
                                        <a href="{{asset(Storage::url('tasks/'.$project->file))}}"  data-bs-toggle="tooltip" title="{{__('Download')}}" class="btn btn-sm" download>
                                            <i class="ti ti-download text-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @else
                        <div class="py-5">
                            <h6 class="h6 text-center">{{__('No Milestone Found.')}}</h6>
                        </div>
                    @endif
                </ul>

            </div>
        </div>
    </div>
</div>

@livewire('physical-planning.projects.uploadboq', ['project' => $project], key($project->id))
@include('livewire.physical-planning.projects.modals.view-boq')
@include('livewire.projects.modals.new-project-user')
