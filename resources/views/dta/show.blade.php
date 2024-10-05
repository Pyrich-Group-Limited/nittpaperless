<div class="modal-body">
    @if(Auth::user()->type=="supervisor")
        {{Form::open(array('route'=>['approve.supervisor',$dta->id],'method'=>'post'))}}
        {!! Form::hidden('type', 0) !!}
        {!! Form::submit('Approve', ['class' => 'btn btn-primary btn-sm']) !!}
        {!! Form::close() !!}
    @elseif(Auth::user()->type=="unit head")
        {{Form::open(array('route'=>['approve.unithead',$dta->id],'method'=>'post'))}}
        {!! Form::hidden('type', 0) !!}
        {!! Form::submit('Approve', ['class' => 'btn btn-primary btn-sm']) !!}
        {!! Form::close() !!}
    @elseif(Auth::user()->type=="liason office head" || auth()->user()->type=='HOD')
        {{Form::open(array('route'=>['approve.hod',$dta->id],'method'=>'post'))}}
        {!! Form::hidden('type', 0) !!}
        {!! Form::submit('Approve', ['class' => 'btn btn-primary btn-sm']) !!}
        {!! Form::close() !!}
    @elseif(Auth::user()->type=="accountant")
        {{Form::open(array('route'=>['approve.accountant',$dta->id],'method'=>'post'))}}
        {!! Form::hidden('type', 0) !!}
        {!! Form::submit('Approve', ['class' => 'btn btn-primary btn-sm']) !!}
        {!! Form::close() !!}
    @endif

    <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">

                            <tbody>
                                <style>
                                    th{
                                        width: 200px !important;
                                    }
                                </style>
                                <tr>
                                    <th scope="row">Emloyee Name</th>
                                    <td>{{ $dta->user->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Destination</th>
                                    <td>{{ $dta->destination}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Purpose</th>
                                    <td style="white-space: pre-wrap">{{ $dta->purpose }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Travel Date</th>
                                    <td>{{ date('d-M-Y', strtotime($dta->travel_date)) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Arrival Date</th>
                                    <td>{{ date('d-M-Y', strtotime($dta->arrival_date)) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Estimated Expenses</th>
                                    <td>₦ {{ number_format($dta->estimated_expense,2)  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date Submitted</th>
                                    <td>{{ $dta->created_at->format('d-M-Y')  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status</th>
                                    <td>
                                        @if($dta->status=="pending")
                                            <p class="text-warning mb-0">{{ $dta->status }} {{ $dta->current_approver.' '.'approval' }}</p>
                                        @elseif($dta->status=="rejected")
                                                <p class="text-danger mb-0">{{ $dtaRequest->status }}</p>
                                        @else
                                            <p class="text-success mb-0">{{ $dta->status }}</p>
                                        @endif

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal-footer">
            <input type="button" value="{{('Cancel')}}" class="btn  btn-light btn-sm" data-bs-dismiss="modal">
            {{-- <input type="submit" value="{{__('Approve')}}" class="btn  btn-primary btn-sm"> --}}
            {{-- <input type="submit" value="{{__('Reject')}}" class="btn  btn-danger btn-sm"> --}}
        </div>
    {{-- </form> --}}
    {{Form::close()}}
    </div>
