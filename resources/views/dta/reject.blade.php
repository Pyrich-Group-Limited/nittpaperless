<div class="modal-body">
     {{Form::open(array('route'=>['reject.dta',$dtaReject->id],'method'=>'post'))}}
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
                                <td>{{ $dtaReject->user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Destination</th>
                                <td>{{ $dtaReject->destination}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Purpose</th>
                                <td style="white-space: pre-wrap">{{ $dtaReject->purpose }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Travel Date</th>
                                <td>{{ date('d-M-Y', strtotime($dtaReject->travel_date)) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Arrival Date</th>
                                <td>{{ date('d-M-Y', strtotime($dtaReject->arrival_date)) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Estimated Expenses</th>
                                <td>₦ {{ number_format($dtaReject->estimated_expense,2)  }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Date Submitted</th>
                                <td>{{ $dtaReject->created_at->format('d-M-Y')  }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td>
                                    @if($dtaReject->status=="pending")
                                        <p class="text-warning mb-0">{{ $dtaReject->status }} {{ $dtaReject->current_approver.' '.'approval' }}</p>
                                    @elseif($dtaReject->status=="rejected")
                                            <p class="text-danger mb-0">{{ $dtaRequest->status }}</p>
                                    @else
                                        <p class="text-success mb-0">{{ $dtaReject->status }}</p>
                                    @endif

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="form-group col-md-12">
            <label for="" class="form-label">Add Rejection Comment</label>
            <textarea name="comment" id="" cols="30" rows="3" class="form-control" required></textarea>
            @error('comment')
            <small class="invalid-role" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </small>
            @enderror
        </div>

        <div class="modal-footer">
            <input type="button" value="{{('Cancel')}}" class="btn  btn-light btn-sm" data-bs-dismiss="modal">
            <input type="submit" value="{{__('Reject')}}" class="btn  btn-danger btn-sm">
        </div>
    {{Form::close()}}
    </div>
