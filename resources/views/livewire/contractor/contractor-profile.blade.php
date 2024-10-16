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
    <div class="col-md-6 ">
        <div class="card emp_details">
            <div class="card-header"><h6 class="mb-0">{{__('Company Detail')}}</h6></div>
            <div class="card-body employee-detail-edit-body">

                <div class="row">
                    <div class="form-group col-md-12">
                        {!! Form::label('name', __('Company Name'),['class'=>'form-label']) !!}<span class="text-danger pl-1">*</span>
                       <input type="text" wire:model="company_name" class="form-control" />
                       @error('company_name')
                       <small class="invalid-type_of_leave" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                       </small>
                   @enderror
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::label('name', __('Year of Incoperation'),['class'=>'form-label']) !!}<span class="text-danger pl-1">*</span>
                       <input type="text" wire:model="year" class="form-control" />
                       @error('year')
                            <small class="invalid-type_of_leave" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::label('name', __('Tin'),['class'=>'form-label']) !!}<span class="text-danger pl-1">*</span>
                       <input type="text" wire:model="tin" class="form-control" />
                       @error('tin')
                            <small class="invalid-type_of_leave" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('address', __('Company Address'),['class'=>'form-label']) !!}<span class="text-danger pl-1">*</span>
                    <textarea class="form-control" wire:model="address"></textarea>
                    @error('address')
                        <small class="invalid-type_of_leave" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        {!! Form::label('name', __('Email'),['class'=>'form-label']) !!}<span class="text-danger pl-1">*</span>
                       <input type="text" wire:model="email" class="form-control" />
                       @error('email')
                        <small class="invalid-type_of_leave" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </small>
                    @enderror
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::label('name', __('Phone Number'),['class'=>'form-label']) !!}<span class="text-danger pl-1">*</span>
                       <input type="text" wire:model="phoneno" class="form-control" />
                       @error('phoneno')
                       <small class="invalid-type_of_leave" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                       </small>
                   @enderror
                    </div>
                </div>
                <div align="center" wire:loading wire:target="updateProfile"><x-g-loader /></div>
                <input type="button"  wire:click="updateProfile" value="{{ __('Update') }}" class="btn  btn-primary">
            </div>
        </div>
    </div>

</div>
