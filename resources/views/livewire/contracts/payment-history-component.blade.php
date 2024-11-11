<div>
    @section('page-title')
        {{__('Contract Payment History for:')}}  {{ $contract->projects->project_name }}
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
        <li class="breadcrumb-item">{{__('Contract Payment History')}} </li>
    @endsection
    @push('css-page')
        <style>
            @import url({{ asset('css/font-awesome.css') }});
        </style>
    @endpush
    
    @section('action-btn')
        <div class="float-end">
            
            <a href="{{ route('contract.details',$this->contract->id) }}" data-size="lg"
            data-bs-toggle="tooltip" title="{{ __('Back') }}" class="btn btn-sm btn-primary">
            <i class="ti ti-arrow-left text-white"> </i>Back
            </a>
        </div>
    @endsection
    
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                <div class="card-body table-border-style">
                        <div class="table-responsive">
                        <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>{{__('#')}}</th>
                                    <th>{{__('Payment Date')}}</th>
                                    <th>{{__('Amount Paid')}}</th>
                                    <th>{{__('Remaining Balance')}}</th>
                                    <th>{{__('Remarks')}}</th>
                                    {{-- <th width="200px">{{__('Action')}}</th> --}}
                                </tr>
                                </thead>
                                <tbody class="font-style">
                                @if (isset($paymentHistory) && !empty($paymentHistory) && count($paymentHistory) > 0)
                                    @foreach ($paymentHistory as $payment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $payment->payment_date }}</td>
                                            <td> ₦ {{ number_format($payment->amount_paid,2) }}</td>
                                            <td> ₦ {{ number_format($payment->remaining_balance,2) }}</td>
                                            <td>{{ $payment->remarks }}</td>
                                            {{-- <td></td> --}}
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th scope="col" colspan="9">
                                            <h6 class="text-center">{{ __('No Record Found.') }}</h6>
                                        </th>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
        <x-toast-notification />
    </div>
    