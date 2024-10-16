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
                 <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#uplodDocumentModal"   data-bs-toggle="tooltip" title="{{__('Upload Bill of Quantity')}}"  class="btn btn-sm btn-primary">
                    <i class="ti ti-upload"></i>
                </a>
     </div>
 @endsection


<div class="col-xl-12">

    <div class="card mt-4">
        <div class="card-body table-border-style">
            <div class="table-responsive">

                <table class="table">
                    <thead>
                    <tr>
                        <th>{{__('Project Name')}}</th>
                        <th>{{__('Status')}}</th>
                        {{-- <th class="text-end">{{__('Action')}}</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($applications)> 0)
                        @foreach ($applications as $key => $application)
                            <tr>
                                <td class="">
                                    {{ $application->project->project_name }}
                                </td>
                                <td class="">
                                    {{ $application->application_status }}
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th scope="col" colspan="7"><h6 class="text-center">{{__('No Dcoument Upload Yet.')}}</h6></th>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('livewire.contractor.modals.upload-document')

<div>
