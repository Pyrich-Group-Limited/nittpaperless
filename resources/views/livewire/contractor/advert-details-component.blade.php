@section('page-title')
   Contractor Dashbaord
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
    <li class="breadcrumb-item"><a href="{{route('projects.index')}}">{{__('Contractor')}}</a></li>
    <li class="breadcrumb-item">Dashboard</li>
@endsection

    <div class="row">
        @if(count(Auth::user()->projectApplications($advert->project_id))<=0)
        <div class="col-md-6 ">
            <div class="card emp_details">
                <div class="card-header"><h6 class="mb-0">{{ $advert->project->project_name }}</h6></div>
                <div class="card-body employee-detail-edit-body">
                    <img src="@if($advert->image){{ asset('guest/images/uploads/'.$advert->image) }} @else {{ asset('uploads/procurement.png')}} @endif" class="img-fluid thumb w-100" width="768" height="456" alt="{{ $advert->project->project_title }}">
                </div><hr>
                <p style="padding: 20px; font-weight:500">{!! $advert->description !!}</p>
                <div class="col-md-6" style="padding-left: 20px; padding-bottom: 20px">
                    <a href="#"><input type="button"  data-bs-toggle="tooltip" title="{{__('Bid for contract')}}"  value="{{ __('BID') }}" class="btn  btn-primary confirm-application"></a>

                    <div wire:loading wire:target="applyContract"><x-g-loader /></div>
                </div>
            </div>
        </div>
        @else
            <div class="alert alert-success">You have successfully applied for this project, <a href=""> here</a> to view application status</div>
        @endif

    </div>
