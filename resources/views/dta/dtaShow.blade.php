<div class="modal-body">
    <div class="row">
            @foreach($dtas as $dta)
                <div class="col text-center">
                    <div class="card p-4 mb-4">
                        <h7 class="report-text gray-text mb-0">{{$dta->status}} :</h7>
                        <h6 class="report-text mb-0">{{$dta->total}}</h6>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row mt-2">
            <table class="table datatable">
                <thead>
                <tr>
                    <th>{{__('Destination')}}</th>
                    <th>{{__('DTA Date')}}</th>
                    <th>{{__('DTA Days')}}</th>
                    <th>{{__('Estimated cost')}}</th>
                    <th>{{__('DTA Purpose')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($dtaData as $dta)
                    <tr>
                        {{-- <td>{{!empty($dta->leaveType)?$leave->leaveType->title:''}}</td> --}}
                        <td>{{$dta->destination}}</td>
                        <td>
                            {{ date('d-M-Y', strtotime($dta->travel_date)). 'to '.date('d-M-Y', strtotime($dta->arrival_date)) }}
                        </td>
                        <td>
                            {{ round(strtotime($dta->arrival_date) - strtotime($dta->travel_date))/ 86400 }} Days
                        </td>
                        <td>₦ {{ number_format($dta->estimated_expense,2)  }}</td>
                        <td style="white-space: pre-wrap">{{$dta->purpose}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">{{__('No Data Found.!')}}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
