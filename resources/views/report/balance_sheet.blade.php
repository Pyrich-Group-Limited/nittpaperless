@extends('layouts.admin')
@section('page-title')
    {{ __('Balance Sheet') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Balance Sheet') }}</li>
@endsection
@push('script-page')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 4,
                    dpi: 72,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A2'
                }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#filter").click(function() {
                $("#show_filter").toggle();
            });
        });
    </script>
        <script>
            $(document).ready(function () {
                callback();
                function callback() {
                    var start_date = $(".startDate").val();
                    var end_date = $(".endDate").val();

                    $('.start_date').val(start_date);
                    $('.end_date').val(end_date);

                }
                });

        </script>


@endpush

@section('action-btn')

    <div class="float-end">
        {{ Form::open(['route' => ['balance.sheet.print']]) }}
        <input type="hidden" name="start_date" class="start_date">
        <input type="hidden" name="end_date" class="end_date">
        <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{ __('Print') }}"
            data-original-title="{{ __('Print') }}"><i class="ti ti-printer"></i></button>
        {{ Form::close() }}
    </div>

    <div class="float-end me-2">
        {{ Form::open(['route' => ['balance.sheet.export']]) }}
        <input type="hidden" name="start_date" class="start_date">
        <input type="hidden" name="end_date" class="end_date">
        <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{ __('Export') }}"
            data-original-title="{{ __('Export') }}"><i class="ti ti-file-export"></i></button>
        {{ Form::close() }}
    </div>



    <div class="float-end me-2" id="filter">
        <button id="filter" class="btn btn-sm btn-primary"><i class="ti ti-filter"></i></button>
    </div>
@endsection


@section('content')
    <div class="mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-2" id="multiCollapseExample1">
                    <div class="card" id="show_filter" style="display:none;">
                        <div class="card-body">
                            {{ Form::open(['route' => ['report.balance.sheet'], 'method' => 'GET', 'id' => 'report_bill_summary']) }}
                            <div class="row align-items-center justify-content-end">
                                <div class="col-xl-10">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                            </div>
                                        </div>
                                        {{-- <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                                {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                                {{ Form::date('start_date', $filter['startDateRange'], ['class' => 'startDate form-control']) }}
                                            </div>
                                        </div> --}}
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                                {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                                {{ Form::date('start_date', $filter['startDateRange'], ['class' => 'startDate form-control']) }}
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                                {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                                                {{ Form::date('end_date', $filter['endDateRange'], ['class' => 'endDate form-control']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto mt-4">
                                    <div class="row">
                                        <div class="col-auto">
                                            <a href="#" class="btn btn-sm btn-primary"
                                                onclick="document.getElementById('report_bill_summary').submit(); return false;"
                                                data-bs-toggle="tooltip" title="{{ __('Apply') }}"
                                                data-original-title="{{ __('apply') }}">
                                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                            </a>

                                            <a href="{{ route('report.balance.sheet') }}" class="btn btn-sm btn-danger "
                                                data-bs-toggle="tooltip" title="{{ __('Reset') }}"
                                                data-original-title="{{ __('Reset') }}">
                                                <span class="btn-inner--icon"><i
                                                        class="ti ti-trash-off text-white-off "></i></span>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row mb-4">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-flush">
                                <thead>
                                    <tr>
                                        <th width="50%"> {{ __('Account Name') }}</th>
                                        <th width="25%"> {{ __('Account Code') }}</th>
                                        <th width="25%"> {{ __('Total') }}</th>
                                    </tr>
                                </thead>
                            </table>
                            @foreach ($chartAccounts as $type => $accounts)
                                <p class="font-bold ms-3 mt-2 fs-4">{{ $type }}</p><hr>
                                @foreach ($accounts as $account)
                                    <p class="text-primary ms-3 mt-2 fs-5">{{ $account['subType'] }}</p>
                                    <table class="table">
                                        <tbody>
                                            @foreach ($account['account'] as $record)
                                                @php
                                                    $totalCredit = 0;
                                                    $totalDebit = 0;
                                                    $totalBalance = 0;

                                                    $totalCredit += $record['totalCredit'];
                                                    $totalDebit += $record['totalDebit'];
                                                    $getAccount = \App\Models\ChartOfAccount::where('name', $record['account_name'])->first();
                                                    $Balance = App\Models\Utility::getAccountBalance($getAccount->id, $filter['startDateRange'], $filter['endDateRange']);
                                                    $totalBalance += $Balance;
                                                @endphp
                                                <tr>
                                                        <td width="50%">{{ $record['account_name'] }} </td>
                                                        <td width="25%">{{ $record['account_code'] }} </td>
                                                        <td width="25%">{{ $record['netAmount'] + $totalBalance  }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        @php
            $authUser = \Auth::user()->creatorId();
            $user = App\Models\User::find($authUser);
        @endphp
        <div class="row justify-content-center" id="printableArea">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="account-main-title mb-5">
                            {{-- <h5>{{ 'Balance Sheet of ' . $user->name . ' as of ' . $filter['startDateRange'] . ' to ' . $filter['endDateRange'] }}
                                </h5> --}}
                                <h5>{{ 'Balance Sheet of ' . ($user->name ?? 'Unknown User') . ' as of ' . ($filter['startDateRange'] ?? 'N/A') . ' to ' . ($filter['endDateRange'] ?? 'N/A') }}</h5>

                        </div>
                        <div
                            class="aacount-title d-flex align-items-center justify-content-between border-top border-bottom py-2">
                            <h6 class="mb-0">{{ __('Account') }}</h6>
                            <h6 class="mb-0 text-center">{{ _('Account Code') }}</h6>
                            <h6 class="mb-0 text-end">{{ __('Total') }}</h6>
                        </div>

                        @php
                            $totalAmount = 0;
                        @endphp
                        @foreach ($chartAccounts as $type => $accounts)
                            @if ($accounts != [])
                                <div class="account-main-inner py-2">
                                    @if ($type == 'Liabilities')
                                        <p class="fw-bold mb-3"> {{ __('Liabilities & Equity') }}</p>
                                    @endif
                                    <p class="fw-bold ps-2 mb-2">{{ $type }}</p>

                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($accounts as $account)
                                        <div class="border-bottom py-2">
                                            <p class="fw-bold ps-4 mb-2">
                                                {{ $account['subType'] == true ? $account['subType'] : '' }}</p>
                                            @foreach ($account['account'] as $key => $record)
                                                @if ($key < count($account['account']) - 1)
                                                    @if (!preg_match('/\btotal\b/i', $record['account_name']))
                                                        <div
                                                            class="account-inner d-flex align-items-center justify-content-between ps-5">
                                                            <p class="mb-2"><a
                                                                    href="{{ route('chart-of-account.show', $record['account_id']) }}?account={{ $record['account_id'] }}"
                                                                    class="text-primary">{{ $record['account_name'] }}</a>
                                                            </p>
                                                            <p class="mb-2 text-center">{{ $record['account_code'] }}</p>
                                                            <p class="text-primary mb-2 float-end text-end">
                                                                {{ $record['netAmount'] }}</p>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                            <div
                                                class="account-inner d-flex align-items-center justify-content-between ps-4">
                                                <p class="fw-bold mb-2">
                                                    {{ end($account['account']) == true ? end($account['account'])['account_name'] : 0 }}
                                                </p>
                                                <p class="fw-bold mb-2 text-end">
                                                    {{ end($account['account']) == true ? end($account['account'])['netAmount'] : 0 }}
                                                </p>
                                            </div>
                                        </div>

                                        @php
                                            $total += end($account['account']) == true ? end($account['account'])['netAmount'] : 0;
                                        @endphp
                                    @endforeach
                                    <div
                                        class="aacount-title d-flex align-items-center justify-content-between border-top border-bottom py-2 px-2 pe-0">
                                        <h6 class="fw-bold mb-0">{{ 'Total for ' . $type }}</h6>
                                        <h6 class="fw-bold mb-0 text-end">{{ $total }}</h6>
                                    </div>
                                    @php
                                        if ($type != 'Assets') {
                                            $totalAmount += $total;
                                        }
                                    @endphp
                                </div>
                            @endif
                        @endforeach

                        @foreach ($chartAccounts as $type => $accounts)
                            @php
                                if ($type == 'Assets') {
                                    continue;
                                }
                            @endphp

                            @if ($accounts != [])
                                <div
                                    class="aacount-title d-flex align-items-center justify-content-between border-bottom py-2 px-0">
                                    <h6 class="fw-bold mb-0">{{ 'Total for Liabilities & Equity' }}</h6>
                                    <h6 class="fw-bold mb-0 text-end">{{ $totalAmount }}</h6>
                                </div>
                            @endif

                            @php
                                if ($type == 'Liabilities' || $type == 'Equity') {
                                    break;
                                }
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

