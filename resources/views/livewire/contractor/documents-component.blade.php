<div>
    @php
    $profile=\App\Models\Utility::get_file('uploads/avatar');
    @endphp
 @section('page-title')
     {{__('Manage Project Documents')}}
 @endsection

 @push('script-page')
 @endpush
 @section('breadcrumb')
     <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
     <li class="breadcrumb-item">{{__('Project Documents')}}</li>
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
                        <th></th>
                        <th>{{__('Project Name')}}</th>
                        <th>{{__('Document Name')}}</th>
                        <th class="text-end">{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($documents)> 0)
                        @foreach ($documents as $key => $document)
                            <tr>

                                <td class="">
                                    <img src="{{ asset('assets/images/documents.png')}}" width="50" />
                                </td>

                                <td class="">
                                    {{-- {{ $document->projectApplication->project_name }} --}}
                                </td>

                                <td class="">
                                    {{ $document->document_name }}
                                </td>
                                <td class="text-end">
                                    <span>

                                            {{-- <div class="action-btn bg-warning ms-2">
                                                <a href="{{ asset('assets/images/documents.png')}}" target="_blank" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-bs-toggle="tooltip" title="{{__('View Document')}}" data-title="{{__('View Document')}}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div> --}}
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="{{ asset('assets/documents/documents') }}/{{$document->document}}" target="_blank" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-bs-toggle="tooltip" title="{{__('View Document')}}" data-title="{{__('View Document')}}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-warning ms-2">
                                                {{-- <a href="{{ route('download.file', $document->document) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-bs-toggle="tooltip" title="{{__('Download Document')}}" data-title="{{__('Download Document')}}">
                                                    <i class="ti ti-download text-white"></i>
                                                </a> --}}
                                                <a href="#" wire:click="downloadFile('{{ $document->document }}')" class="btn btn-primary btn-sm"><i class="ti ti-download"></i></a>
                                            </div>

                                    </span>
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
