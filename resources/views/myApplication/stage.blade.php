@extends('layouts.admin')
@section('page-title')
    {{ __('My Application Stage') }}
@endsection
@php
    $logo = \App\Models\Utility::get_file('uploads/avatar/');
    $profile = \App\Models\Utility::get_file('uploads/job/profile/');
@endphp
@push('css-page')
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dragula.min.css') }}" id="main-style-link">
@endpush
@push('script-page')
    <script src="{{ asset('assets/js/plugins/dragula.min.js') }}"></script>
    <script>
        $(document).on('change', '#jobs', function() {

            var id = $(this).val();

            $.ajax({
                url: "{{ route('get.job.application') }}",
                type: 'POST',
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    var job = JSON.parse(data);
                    // console.log(job)
                    var applicant = job.applicant;
                    var visibility = job.visibility;
                    var question = job.custom_question;

                    (applicant.indexOf("gender") != -1) ? $('.gender').removeClass('d-none'): $(
                        '.gender').addClass('d-none');
                    (applicant.indexOf("dob") != -1) ? $('.dob').removeClass('d-none'): $('.dob')
                        .addClass('d-none');
                    (applicant.indexOf("country") != -1) ? $('.country').removeClass('d-none'): $(
                        '.country').addClass('d-none');

                    (visibility.indexOf("profile") != -1) ? $('.profile').removeClass('d-none'): $(
                        '.profile').addClass('d-none');
                    (visibility.indexOf("resume") != -1) ? $('.resume').removeClass('d-none'): $(
                        '.resume').addClass('d-none');
                    (visibility.indexOf("letter") != -1) ? $('.letter').removeClass('d-none'): $(
                        '.letter').addClass('d-none');

                    $('.question').addClass('d-none');
                    // $('.question').removeAttr('required');

                    if (question.length > 0) {
                        question.forEach(function(id) {
                            $('.question_' + id + '').removeClass('d-none');
                        });
                    }


                }
            });
        });

        @can('move job application')
            ! function(a) {
                "use strict";

                var t = function() {
                    this.$body = a("body")
                };
                t.prototype.init = function() {
                    // console.log(t);
                    a('[data-plugin="dragula"]').each(function() {

                        //   console.log(t);
                        var t = a(this).data("containers"),

                            n = [];
                        if (t)
                            for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]);
                        else n = [a(this)[0]];
                        var r = a(this).data("handleclass");
                        r ? dragula(n, {
                            moves: function(a, t, n) {
                                return n.classList.contains(r)
                            }
                        }) : dragula(n).on('drop', function(el, target, source, sibling) {
                            var order = [];
                            $("#" + target.id + " > div").each(function() {
                                order[$(this).index()] = $(this).attr('data-id');
                            });

                            var id = $(el).attr('data-id');

                            var old_status = $("#" + source.id).data('status');
                            var new_status = $("#" + target.id).data('status');
                            var stage_id = $(target).attr('data-id');


                            $("#" + source.id).parent().find('.count').text($("#" + source.id +
                                " > div").length);
                            $("#" + target.id).parent().find('.count').text($("#" + target.id +
                                " > div").length);
                            $.ajax({
                                url: '{{ route('job.application.order') }}',
                                type: 'POST',
                                data: {
                                    application_id: id,
                                    stage_id: stage_id,
                                    order: order,
                                    new_status: new_status,
                                    old_status: old_status,
                                    "_token": $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(data) {
                                    show_toastr('success',
                                        'Job-application successfully updated',
                                        'success');
                                },
                                error: function(data) {
                                    data = data.responseJSON;
                                    show_toastr('error', data.error, 'error')
                                }
                            });
                        });
                    })
                }, a.Dragula = new t, a.Dragula.Constructor = t
            }(window.jQuery),
            function(a) {
                "use strict";

                a.Dragula.init()

            }(window.jQuery);
        @endcan
    </script>
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Job Application') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " id="multiCollapseExample1">

            </div>
        </div>
    </div>

    <div class="card overflow-hidden mt-0">
        <div class="container-kanban">
            @php

                $json = [];
                foreach ($stages as $stage) {
                    $json[] = 'task-list-' . $stage->id;
                }
            @endphp
            <div class="row kanban-wrapper horizontal-scroll-cards" data-plugin="dragula"
                data-containers='{!! json_encode($json) !!}'>
                @foreach ($stages as $stage)
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-end">
                                    <span class="btn btn-sm btn-primary btn-icon count">
                                        {{ isset($applicationsByStage[$stage->id]) ? count($applicationsByStage[$stage->id]) : 0 }}
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $stage->title }}</h4>
                            </div>

                            <div class="card-body kanban-box" id="task-list-{{ $stage->id }}"
                                data-id="{{ $stage->id }}">
                                @if (isset($applicationsByStage[$stage->id]))
                                    @foreach ($applicationsByStage[$stage->id] as $application)
                                        <div class="card" data-id="{{ $application->id }}">
                                            <div class="pt-3 ps-3"></div>
                                            <div class="card-header border-0 pb-0 position-relative">
                                                <h5>{{ $application->name }}</h5>
                                                <div class="card-header-right">
                                                    {{ $stage->id }}
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <ul class="list-inline mb-0 mt-0">
                                                        <small class="text-md">
                                                            {{ !empty($application->jobs) ? $application->jobs->title : '' }}
                                                        </small><br>
                                                        <li class="list-inline-item d-inline-flex align-items-center"
                                                            data-bs-toggle="tooltip" title="{{ __('Applied at') }}">
                                                            <i class="ti ti-clock me-1" data-ajax-popup="true"
                                                                data-title="{{ __('Applied at') }}"></i>
                                                            {{ \Auth::user()->dateFormat($application->created_at) }}
                                                        </li>
                                                    </ul>
                                                    <div class="user-group">
                                                        <img src="{{ !empty($application->profile) ? $profile . $application->profile : $logo . 'avatar.png' }}"
                                                            class="hweb">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <span class="empty-container" data-placeholder="Empty"></span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
