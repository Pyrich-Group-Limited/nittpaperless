<div class="modal-body">
    {{-- {{Form::open(array('route'=>['reject.dta',$dtaReject->id],'method'=>'post'))}} --}}
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
                               <td>{{ $rejectedDta->user->name }}</td>
                           </tr>
                           <tr>
                               <th scope="row">Destination</th>
                               <td>{{ $rejectedDta->destination}}</td>
                           </tr>
                           <tr>
                               <th scope="row">Purpose</th>
                               <td style="white-space: pre-wrap">{{ $rejectedDta->purpose }}</td>
                           </tr>
                           <tr>
                               <th scope="row">Travel Date</th>
                               <td>{{ date('d-M-Y', strtotime($rejectedDta->travel_date)) }}</td>
                           </tr>
                           <tr>
                               <th scope="row">Arrival Date</th>
                               <td>{{ date('d-M-Y', strtotime($rejectedDta->arrival_date)) }}</td>
                           </tr>
                           <tr>
                               <th scope="row">Estimated Expenses</th>
                               <td>₦ {{ number_format($rejectedDta->estimated_expense,2)  }}</td>
                           </tr>
                           <tr>
                               <th scope="row">Date Submitted</th>
                               <td>{{ $rejectedDta->created_at->format('d-M-Y')  }}</td>
                           </tr>
                           <tr>
                               <th scope="row">Status</th>
                               <td>
                                    <p class="text-danger mb-0">{{ $rejectedDta->status }}</p>
                               </td>
                           </tr>

                           <tr>
                            <th scope="row">Rejection Comment</th>
                            <td style="white-space: pre-wrap">{{ $rejectedDta->rejectionComment->comment }}</td>
                        </tr>
                       </tbody>
                   </table>
               </div>
           </div>

       </div>

       <div class="modal-footer">
           <input type="button" value="{{('Close')}}" class="btn  btn-light btn-sm" data-bs-dismiss="modal">
       </div>
    </div>
