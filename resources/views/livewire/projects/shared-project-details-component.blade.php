<div>
    {{-- @extends('layouts.admin') --}}
@section('page-title')
    {{ __('Shared Project Detail') }}
@endsection
@push('script-page')
    
    <script>
        // @can('manage contract')
        $('.summernote-simple').on('summernote.blur', function () {

            $.ajax({
                url: "{{route('contract.contract_description.store',$project->id)}}",
                data: {_token: $('meta[name="csrf-token"]').attr('content'), contract_description: $(this).val()},
                type: 'POST',
                success: function (response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success,'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function (response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
        // @else
        // $('.summernote-simple').summernote('disable');
        // @endcan
    </script>
    {{-- <script>
        
        $(document).on('click', '#comment_submit', function (e) {
            var curr = $(this);

            var comment = $.trim($("#form-comment textarea[name='comment']").val());
            if (comment != '') {
                $.ajax({
                    url: $("#form-comment").data('action'),
                    data: {comment: comment, "_token": "{{ csrf_token() }}"},
                    type: 'POST',
                    success: function (data) {
                        show_toastr('{{__("success")}}', 'Comment Create Successfully!', 'success');
                        setTimeout(function () {
                            location.reload();
                        }, 500)
                        data = JSON.parse(data);
                        console.log(data);
                        var html = "<div class='list-group-item px-0'>" +
                            "                    <div class='row align-items-center'>" +
                            "                        <div class='col-auto'>" +
                            "                            <a href='#' class='avatar avatar-sm rounded-circle ms-2'>" +
                            "                                <img src="+data.default_img+" alt='' class='avatar-sm rounded-circle'>" +
                            "                            </a>" +
                            "                        </div>" +
                            "                        <div class='col ml-n2'>" +
                            "                            <p class='d-block h6 text-sm font-weight-light mb-0 text-break'>" + data.comment + "</p>" +
                            "                            <small class='d-block'>"+data.current_time+"</small>" +
                            "                        </div>" +
                            "                        <div class='action-btn bg-danger me-4'><div class='col-auto'><a href='#' class='mx-3 btn btn-sm  align-items-center delete-comment' data-url='" + data.deleteUrl + "'><i class='ti ti-trash text-white'></i></a></div></div>" +
                            "                    </div>" +
                            "                </div>";

                        $("#comments").prepend(html);
                        $("#form-comment textarea[name='comment']").val('');
                        load_task(curr.closest('.task-id').attr('id'));
                        show_toastr('{{__('success')}}', '{{ __("Comment Added Successfully!")}}');
                    },
                    error: function (data) {
                        show_toastr('error', '{{ __("Some Thing Is Wrong!")}}');
                    }
                });
            } else {
                show_toastr('error', '{{ __("Please write comment!")}}');
            }
        });

        $(document).on("click", ".delete-comment", function () {
            var btn = $(this);

            $.ajax({
                url: $(this).attr('data-url'),
                type: 'DELETE',
                dataType: 'JSON',
                data: {"_token": "{{ csrf_token() }}"},
                success: function (data) {
                    load_task(btn.closest('.task-id').attr('id'));
                    show_toastr('{{__('success')}}', '{{ __("Comment Deleted Successfully!")}}');
                    btn.closest('.list-group-item').remove();
                },
                error: function (data) {
                    data = data.responseJSON;
                    if (data.message) {
                        show_toastr('error', data.message);
                    } else {
                        show_toastr('error', '{{ __("Some Thing Is Wrong!")}}');
                    }
                }
            });
        });


    </script> --}}


    {{-- <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        $(".list-group-item").click(function(){
            $('.list-group-item').filter(function(){
                return this.href == id;
            }).parent().removeClass('text-primary');
        });
    </script> --}}
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $project->projectId }}</li>
@endsection

{{-- @section('action-btn')
    <div class="float-end d-flex align-items-center">
        <a href="{{route('contract.download.pdf',\Crypt::encrypt($project->id))}}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Download')}}" target="_blanks">
            <i class="ti ti-download"></i>
        </a>
        <a href="{{ route('get.contract',$project->id) }}"  target="_blank" class="btn btn-sm btn-primary btn-icon m-1" >
            <i class="ti ti-eye text-white" data-bs-toggle="tooltip" data-bs-original-title="{{ __('PreView') }}"> </i>
        </a>
    </div>
@endsection --}}

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
                            <div class="col-12 d-flex">
                                <div class="form-group mb-0 w-100">
                                    <form wire:submit.prevent="addComment">
                                        <textarea rows="1" class="form-control" wire:model="commentText" placeholder="{{__('Add a comment...')}}"></textarea>
                                        @error('commentText') <span class="text-danger">{{ $message }}</span> @enderror
                                    </form>
                                </div>
                                <div wire:loading wire:target="addComment"><x-g-loader /></div>
                                <button type="submit" wire:click="addComment" class="btn btn-primary btn-sm">Comment</button>
                                {{-- <button type="submit" wire:click="addComment" class="btn btn-send mt-2"><i class="f-2 text-primary ti ti-brand-telegram"></i></button> --}}
                            </div>
                        <div class="list-group list-group-flush mb-0" id="comments">
                            @foreach($project->comments as $comment)
                                @php
                                    $user = \App\Models\User::find($comment->user_id);
                                    $logo=\App\Models\Utility::get_file('uploads/avatar/');
                                @endphp
                                <div class="list-group-item ">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <a href="{{ !empty($user->avatar) ? $logo . '/' . $user->avatar : $logo . '/user.png' }}" target="_blank">
                                                {{-- <img @if ($user->avatar) src="{{ asset('/storage/uploads/avatar/' . $user->avatar) }}" @else src="{{ asset('uploads/user.png') }}" @endif
                                                    alt="image" class="wid-40 rounded-circle ml-3" > --}}
                                                {{-- <img class="rounded-circle"  width="40" height="40" src="{{ !empty($user->avatar) ? $logo . '/' . $user->avatar : $logo . '/avatar.png' }}"> --}}
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
                                        @if ($comment->user_id===Auth::user()->id)
                                            <div class="col-auto actions">
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['comment_store.destroy',  $comment->id]]) !!}
                                                    <a href="#!" class="mx-3 btn btn-sm  align-items-center bs-pass-para">
                                                        <i class="ti ti-trash text-white" data-bs-toggle="tooltip" data-bs-original-title="{{__('Delete')}}"></i>
                                                    </a>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        @endif
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
