@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}} <br>
    <i class="ti ti-user"></i> ({{ Ucfirst(Auth::user()->designation) }})<br>
        <i class="ti ti-location"></i> {{ Ucfirst(Auth::user()->location)}}  
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><b>Welcome </b>{{ Ucfirst(Auth::user()->name). "(" .Auth::user()->department->name. ")" }}</li>
@endsection
@section('content')
    <div class="row">
            {{-- @if (auth()->user()->unreadNotifications->count() > 0)
                <div class="notification-popup">
                    <h4>New Project Shared</h4>
                    <ul>
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <li>
                                {{ $notification->data['message'] }}: 
                                <a href="{{ route('project.shared', $notification->data['project_id']) }}">
                                    {{ $notification->data['project_title'] }}
                                </a>
                                <button wire:click="markAsRead('{{ $notification->id }}')">Mark as Read</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            @if ($projectsWithoutComments->isEmpty())
                <p class="">No projects pending your comment.</p>
            @else
                <div class="row">
                    <h4 class="text-danger">Projects awaiting your comment.</h4>
                    @foreach ($projectsWithoutComments as $project)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body bg-warning">
                                    <h5 class="card-title">{{ $project->project_name }}</h5>
                                    {{-- <p class="card-text">{{ Str::limit($project->description, 100) }}</p> --}}
                                    <a href="{{ route('project.shared', $project->id) }}" class="btn btn-primary btn-sm">
                                        View Project
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        <div class="col-sm-12">
            <div class="row">
                <div class="col-xxl-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center justify-content-between">
                                                <div class="col-auto mb-3 mb-sm-0">
                                                    <a href="#">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-primary">
                                                                <i class="ti ti-cast"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                {{-- <small class="text-muted">{{__('Total')}}</small> --}}
                                                                <h6 class="m-0">{{__('Purchase Requisition')}}</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                {{-- <div class="col-auto text-end">
                                                    <h3 class="m-0">0</h3>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center justify-content-between">
                                                <div class="col-auto mb-3 mb-sm-0">
                                                    <a href="#">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-primary">
                                                                <i class="ti ti-cast"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                <h6 class="m-0">{{__('Store Requisition Note')}}</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                {{-- <div class="col-auto text-end">
                                                    <h3 class="m-0">0</h3>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center justify-content-between">
                                                <div class="col-auto mb-3 mb-sm-0">
                                                    <a href="#">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-primary">
                                                                <i class="ti ti-cast"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                <h6 class="m-0">{{__('Goods Recieved')}}</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                {{-- <div class="col-auto text-end">
                                                    <h3 class="m-0">0</h3>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center justify-content-between">
                                                <div class="col-auto mb-3 mb-sm-0">
                                                    <a href="#">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-primary">
                                                                <i class="ti ti-cast"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                <h6 class="m-0">{{__('Inventory/Assets')}}</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                {{-- <div class="col-auto text-end">
                                                    <h3 class="m-0">0</h3>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0">{{__('Latest Income')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>{{__('Date')}}</th>
                                                <th>{{__('Customer')}}</th>
                                                <th>{{__('Amount Due')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="text-center">
                                                            <h6>{{__('there is no latest income')}}</h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
