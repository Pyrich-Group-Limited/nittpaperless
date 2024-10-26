<div>
@section('page-title')
    {{ __('Shared Project Comments') }}
@endsection
@push('script-page')
    
    
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $project->projectId }}</li>
@endsection

@section('action-btn')
    <div class="float-end d-flex align-items-center">
        {{-- <a href="{{route('contract.download.pdf',\Crypt::encrypt($project->id))}}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Download')}}" target="_blanks">
            <i class="ti ti-download"></i>
        </a> --}}
        <a href="{{ route('dg.projectApplicants',$project->id) }}"  target="_blank" class="btn btn-sm btn-primary btn-icon m-1" >
            <i class="ti ti-arrow-left text-white" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Back') }}"> </i> Back
        </a>
    </div>
@endsection

{{-- @section('content') --}}
    <div class="row">
        
        <div class="col-xl-12">
            <div id="useradd-1">
                <div class="row">
                    <div class="col-xxl-5">
                        <div class="card report_card total_amount_card">
                            <div class="card-body pt-0" style="margin-bottom: -30px; margin-top: -10px;">
                                <address class="mb-0 text-sm">
                                    <dl class="row mt-4 align-items-center">
                                        <h5>{{ __('Shared Project Detail') }} ({{ $project->projectId }})</h5>
                                        <br>
                                        <dt class="col-sm-4 h6 text-sm">{{ __('Project Title') }}</dt>
                                        <dd class="col-sm-8 text-sm">{{ $project->project_name}}</dd>
                                        <dt class="col-sm-4 h6 text-sm">{{ __('Description') }}</dt>
                                        <dd class="col-sm-8 text-sm">{{ $project->description }}</dd>
                                        <dt class="col-sm-4 h6 text-sm">{{ __('Value') }}</dt>
                                        <dd class="col-sm-8 text-sm"> {{ \Auth::user()->priceFormat($project->budget) }}</dd>
                                        <dt class="col-sm-4 h6 text-sm">{{__('Project Category')}}</dt>
                                        <dd class="col-sm-8 text-sm">{{ $project->category->category_name }}</dd>
                                        <dt class="col-sm-4 h6 text-sm">{{__('Status')}}</dt>
                                        <dd class="col-sm-8 text-sm">{{$project->status }}</dd>
                                        <dt class="col-sm-4 h6 text-sm">{{__('Start Date')}}</dt>
                                        <dd class="col-sm-8 text-sm">{{ Auth::user()->dateFormat($project->start_date) }}</dd>
                                        <dt class="col-sm-4 h6 text-sm">{{__('End Date')}}</dt>
                                        <dd class="col-sm-8 text-sm">{{ Auth::user()->dateFormat($project->end_date) }}</dd>
                                    </dl>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id ="useradd-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Comments') }}</h5>
                    </div>
                    <div class="card-body">
                            {{-- <div class="col-12 d-flex">
                                <div class="form-group mb-0 w-100">
                                    <form wire:submit.prevent="addComment">
                                        <textarea rows="1" class="form-control" wire:model="commentText" placeholder="{{__('Add a comment...')}}"></textarea>
                                        @error('commentText') <span class="text-danger">{{ $message }}</span> @enderror
                                    </form>
                                </div>
                                <div wire:loading wire:target="addComment"><x-g-loader /></div>
                                <button type="submit" wire:click="addComment" class="btn btn-primary btn-sm">Comment</button>
                            </div> --}}
                        <div class="list-group list-group-flush mb-0" id="comments">
                            @foreach($comments as $comment)
                                @php
                                    $logo=\App\Models\Utility::get_file('uploads/avatar/');
                                @endphp
                                <div class="list-group-item ">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <a href="{{ !empty($user->avatar) ? $logo . '/' . $user->avatar : $logo . '/user.png' }}" target="_blank">
                                                <img class="rounded-circle"  width="40" height="40" src="{{ asset('uploads/user.png') }}">
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                        </div>
                                        <div class="col ml-n2">
                                            <p class="d-block h4 text-sm font-weight-light mb-0 text-break">{{ $comment->user->name }} ({{ $comment->user->type .' - '. $comment->user->department->name }})</p>
                                            <p class="d-block text-sm mb-0 text-break">{{ $comment->content }}</p>
                                            <small class="d-block">{{$comment->created_at->diffForHumans()}}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
{{-- @endsection --}}

</div>
