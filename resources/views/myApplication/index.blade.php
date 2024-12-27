@extends('layouts.admin')
@section('page-title')
    {{__('My Job Applications')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('My Job Applications')}}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('#')}}</th>
                                <th>{{__('Job Title')}}</th>
                                <th>{{__('Job Description')}}</th>
                                <th>{{__('Application Date')}}</th>
                                {{-- <th>{{__('Status')}}</th> --}}
                                <th width="200px">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($myjobs as $myjob)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$myjob->jobs->title}}</td>
                                    <td>{!! Str::limit($myjob->jobs->description, 50) !!}</td>
                                    <td>{{\Auth::user()->dateFormat($myjob->created_at)}}</td>
                                    {{-- <td>
                                        @if($myjob->status=='active')
                                            <span class="status_badge badge bg-success p-2 px-3 rounded">{{App\Models\Job::$status[$myjob->status]}}</span>
                                        @else
                                            <span class="status_badge badge bg-danger p-2 px-3 rounded">{{App\Models\Job::$status[$myjob->status]}}</span>
                                        @endif
                                    </td> --}}
                                    <td>
                                        <div class="action-btn bg-info ms-2">
                                            <a href="{{ route('myJobApplication.stage',$myjob->id) }}" data-title="{{__('Track Application Stage')}}" title="{{__('Track Application Stage')}}"
                                                class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" data-original-title="{{__('Track Application Stage')}}">
                                                <i class="ti ti-eye text-white"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
