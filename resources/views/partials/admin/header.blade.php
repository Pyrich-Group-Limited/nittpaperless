@php
    $users = \Auth::user();
    //$profile=asset(Storage::url('uploads/avatar/'));
    $profile = \App\Models\Utility::get_file('uploads/');
    $languages = \App\Models\Utility::languages();
    $lang = isset($users->lang) ? $users->lang : 'en';
    if ($lang == null) {
        $lang = 'en';
    }
    $LangName = \App\Models\Language::where('code', $lang)->first();
    $setting = \App\Models\Utility::colorset();
    $mode_setting = \App\Models\Utility::mode_layout();

    $unseenCounter = App\Models\ChMessage::where('to_id', Auth::user()->id)
        ->where('seen', 0)
        ->count();

    $internalNotifications = App\Models\InternalNotification::where('user_id', auth()->id())
        ->where('is_read', false)->orderBy('created_at','desc')->get();

    $unreadCount = $internalNotifications->count();
@endphp

{{-- <header class="dash-header  {{(isset($mode_setting['cust_theme_bg']) && $mode_setting['cust_theme_bg'] == 'on')?'transprent-bg':''}}"> --}}

    <style>
        .notification-dropdown {
            width: 500px;
            max-height: 500px;
            overflow-y: auto;
        }

        .notification-item {
            padding: 10px;
        }

        .notification-item .mark-as-read {
            margin-left: 10px;
        }

    </style>
@if (isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on')
    <header class="dash-header transprent-bg">
    @else
        <header class="dash-header">
@endif

<div class="header-wrapper">
    <div class="me-auto dash-mob-drp">
        <ul class="list-unstyled">
            <li class="dash-h-item mob-hamburger">
                <a href="#!" class="dash-head-link" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
            </li>

            <li class="dropdown dash-h-item drp-company">
                <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="theme-avtar">

                        <img src="{{ !empty(\Auth::user()->avatar) ? asset('storage/' . Auth::user()->avatar) : asset('uploads/user.png') }}"
                            class="img-fluid rounded-circle">
                    </span>
                    <span class="hide-mob ms-2">{{ __('Hi, ') }}{{ \Auth::user()->name }} !</span>
                    <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                </a>
                <div class="dropdown-menu dash-h-dropdown">

                    <!-- <a href="{{ route('change.mode') }}" class="dropdown-item">
                            <i class="ti ti-circle-plus"></i>
                            <span>{{ Auth::user()->mode == 'light' ? __('Dark Mode') : __('Light Mode') }}</span>
                        </a> -->

                    <a href="{{ route('profile') }}" class="dropdown-item">
                        <i class="ti ti-user"></i>
                        <span>{{ __('Profile') }}</span>
                    </a>

                    @canany(['view department documents', 'view unit documents'])
                        <a href="{{ route('file.index') }}" class="dropdown-item">
                            <i class="ti ti-files"></i>
                            <span>{{ __('Documents') }}</span>
                        </a>
                    @endcanany

                    <a href="{{ route('dta.index') }}" class="dropdown-item">
                        <i class="ti ti-cash"></i>
                        <span>{{ __('My DTA') }}</span>
                    </a>

                    <a href="{{ route('memos.index') }}" class="dropdown-item">
                        <i class="ti ti-file"></i>
                        <span>{{ __('Memo') }}</span>
                    </a>

                    <a href="{{ route('myJobApplications.index') }}" class="dropdown-item">
                        <i class="ti ti-list"></i>
                        <span>{{ __('My Job Applications') }}</span>
                    </a>

                    <a href="#" type="button" class="dropdown-item" data-bs-toggle="modal"
                        data-bs-target="#setSecretCodeModal">
                        <i class="ti ti-lock"></i>
                        <span>{{ __('My Secret Code') }}</span>
                    </a>

                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                        class="dropdown-item">
                        <i class="ti ti-power"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                        {{ csrf_field() }}
                    </form>

                </div>
            </li>

        </ul>
    </div>
    <div class="ms-auto">
        <ul class="list-unstyled">
            @if (\Auth::user()->type != 'contractor')
                <li class="dropdown dash-h-item drp-notification">
                    <a class="dash-head-link arrow-none me-0" href="{{ url('chats') }}" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-brand-hipchat"></i>
                        {{-- <span class="bg-danger dash-h-badge message-toggle-msg  message-counter custom_messanger_counter beep">
                            {{ $unseenCounter }}<span class="sr-only"></span>
                        </span> --}}
                    </a>
                </li>
            @endif

            <li class="dropdown dash-h-item drp-notification">
                <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ti ti-bell"></i>
                    <span class="bg-danger dash-h-badge message-toggle-msg message-counter custom_messanger_counter beep">
                        {{ $unreadCount }}
                        {{-- <span class="sr-only"></span> --}}
                    </span>
                    <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                </a>
                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end notification-dropdown">
                    <div class="dropdown-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-dark">Notifications</h6>
                        <button class="btn btn-sm btn-outline-primary" id="mark-all-read">Mark All as Read</button>
                    </div>
                    <hr class="dropdown-divider">

                    @if($internalNotifications->isEmpty())
                        <p class="dropdown-item text-muted text-center">No new notifications</p>
                    @else
                        @foreach ($internalNotifications as $internalNotification)
                            <div class="dropdown-item notification-item d-flex justify-content-between align-items-start">
                                <div class="notification-content">
                                    <a href="{{ $internalNotification->link ?? '#' }}" class="text-primary text-decoration-none">
                                        <strong>{{ $internalNotification->title }}</strong>
                                        <p class="mb-1 text-muted small">{{ $internalNotification->body }}</p>
                                        <p class="mb-0 text-muted small">{{ $internalNotification->created_at->diffForHumans() }}</p>
                                    </a>
                                </div>
                                <button class="btn btn-sm btn-outline-success mark-as-read" data-id="{{ $internalNotification->id }}">
                                    Mark as Read
                                </button>
                            </div>
                            <hr class="dropdown-divider">
                        @endforeach
                    @endif
                </div>
            </li>

        </ul>
    </div>
</div>
</header>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const messageCounter = document.querySelector('.message-counter');
        // Function to update the counter dynamically
        function updateCounter(decrement = 0) {
            let currentCount = parseInt(messageCounter.textContent.trim());
            currentCount = isNaN(currentCount) ? 0 : currentCount - decrement;
            messageCounter.textContent = currentCount > 0 ? currentCount : '';
            if (currentCount <= 0) {
                messageCounter.classList.remove('beep'); // Remove the indicator when count is 0
            }
        }

        // Mark individual notification as read
        document.querySelectorAll('.mark-as-read').forEach(button => {
            button.addEventListener('click', function () {
                const notificationId = this.getAttribute('data-id');

                fetch(`/notifications/mark-as-read/${notificationId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.closest('.notification-item').remove(); // Remove the notification from the dropdown
                        updateCounter(1); // Decrement the counter by 1
                    }
                });
            });
        });

        // Mark all notifications as read
        document.getElementById('mark-all-read').addEventListener('click', function () {
            fetch(`/notifications/mark-all-as-read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelectorAll('.notification-item').forEach(item => item.remove()); // Remove all notifications from the dropdown
                    updateCounter(data.count); // Decrement the counter by the total number of notifications
                }
            });
        });
    });


</script>
<script>
    $('.dropdown-item').on('click', function(e) {
        e.preventDefault();

        const notificationId = $(this).data('id');

        $.post(`/notifications/${notificationId}/mark-as-read`, {
            _token: '{{ csrf_token() }}',
        }).done(function() {
            location.reload(); // Reload to update the counter
        });
    });
</script>
