<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Voucher</title>
    <style>
        table, th, td {
            border: 1px solid !important;
        }
        .solid{
            border-top: 2px solid black !important;
        }
    
        .text-with-line::after {
            content: "";
            display: inline-block;
            width: 100px; /* Length of the line */
            height: 2px; /* Thickness of the line */
            background-color: black; /* Color of the line */
            margin-right: 10px; /* Space between the line and text */
            vertical-align: bottom; /* Align line with the middle of the text */
        }
        .text-with-line-2::after {
            content: "";
            display: inline-block;
            width: 300px; /* Length of the line */
            height: 2px; /* Thickness of the line */
            background-color: black; /* Color of the line */
            margin-right: 10px; /* Space between the line and text */
            vertical-align: bottom; /* Align line with the middle of the text */
        }
        .text-with-line-3::after {
            content: "";
            display: inline-block;
            width: 83%; /* Length of the line */
            height: 2px; /* Thickness of the line */
            background-color: black; /* Color of the line */
            margin-right: 10px; /* Space between the line and text */
            vertical-align: bottom; /* Align line with the middle of the text */
        }
        .text-with-line-32::after {
            content: "";
            display: inline-block;
            width: 88%; /* Length of the line */
            height: 2px; /* Thickness of the line */
            background-color: black; /* Color of the line */
            margin-right: 10px; /* Space between the line and text */
            vertical-align: bottom; /* Align line with the middle of the text */
        }

        .text-with-line-4::after {
            content: "";
            display: inline-block;
            width: 90%; /* Length of the line */
            height: 2px; /* Thickness of the line */
            background-color: black; /* Color of the line */
            margin-right: 10px; /* Space between the line and text */
            vertical-align: bottom; /* Align line with the middle of the text */
        }
        .text-with-line-5::after {
            content: "";
            display: inline-block;
            width: 85%; /* Length of the line */
            height: 2px; /* Thickness of the line */
            background-color: black; /* Color of the line */
            margin-right: 10px; /* Space between the line and text */
            vertical-align: bottom; /* Align line with the middle of the text */
        }
        .text-with-line-6::after {
            content: "";
            display: inline-block;
            width: 72%; /* Length of the line */
            height: 2px; /* Thickness of the line */
            background-color: black; /* Color of the line */
            margin-right: 10px; /* Space between the line and text */
            vertical-align: bottom; /* Align line with the middle of the text */
        }
        .text-with-line-7::after {
            content: "";
            display: inline-block;
            width: 77%; /* Length of the line */
            height: 2px; /* Thickness of the line */
            background-color: black; /* Color of the line */
            margin-right: 10px; /* Space between the line and text */
            vertical-align: bottom; /* Align line with the middle of the text */
        }

        @media print and (orientation: portrait) {
            img {
                max-width: 100% !important;  /* Ensure images are smaller in portrait */
                height: auto;
                display: block;  /* Ensure images aren't hidden */
            }
        }

        @media print {
            @page {
                margin: 10mm;  /* Set suitable margins */
            }
            img {
                display: block !important; /* Ensure images are shown in print */
                max-width: 100%; /* Ensure images don't overflow */
                height: auto;
                page-break-inside: avoid;
            }
            body {
                -webkit-print-color-adjust: exact; /* For WebKit browsers (Chrome, Safari) */
                print-color-adjust: exact; /* For other browsers */
            }
        } */

        .no-print {
            display: none !important;
        }

        .voucher{
            padding: 15px;
            border: 1px solid;
            border-color: blue;
        }

        #tb1{
            margin-top: -4%;
        }

        .tb1{
            border: none !important;
            border-collapse: collapse !important;
        }

        .tb1 td {
            border: none !important;
            padding: 10px !important;
        }

        #tb1tr1, #tb1tr2{
            border: none !important;
        }

        .tb2{
            border: none !important;
            border-collapse: collapse !important;
        }

        .tb2 td {
            border: none !important;
            padding: 10px !important;
        }

        #tb2tr1{
            border: none !important;
        }
    
    </style>
</head>
<body>
        <div class="card voucher" style="width: auto;">
                <table class="table-bordered tb2" id="tb2">
                       <tr id="tb2tr1">
                          <td width="10%">
                            <img src="{{  asset('assets/images/logo-dark.png') }}" width="100%" alt="">
                          </td>
                          <td align="center" width="60%">
                            <h3 class="text-info">NIGERIAN INSTITUTE OF TRANSPORT TECHNOLOGY</h3>
                            <h4>(NITT), P.M.B, 1148, ZARIA-NIGERIA </h4>
                            <h3><span class="bg-info text-white p-0">PAYMENT VOUCHER</span></h3>
                          </td>
                          <td width="10%"><img src="{{  asset('assets/images/coa.png') }}" width="100%" alt=""></td>
                       </tr>
                </table>
        
            <div class="card-body">
                <table class="table table-bordered tb1" id="tb1">
                    <tr id="tb1tr1">
                        <td style="width: 70%;"><b>Name of Payee:</b> {{ $dtaRequest->user->name }}</td>
                        <td><h4>No. {{ sprintf('%04d', $dtaRequest->id) }}</h4></td>
                    </tr>
                    <tr id="tb1tr2">
                        <td><b>Account to be charged:</b> {{ $dtaRequest->account->name ?? '' }}</td>
                        <td>Expenditure Control No.</td>
                    </tr>
                </table>
    
                <table class="table table-bordered">
                    <tr>
                        <th>FINANCIAL YEAR</th>
                        <th>MONTH OF ACCOUNT</th>
                        <th></th>
                        <th rowspan="2">Date: {{ $dtaRequest->created_at->format('d-M-Y') }}</th>
                    </tr>
                    <tr>
                        <td>{{ date('Y') }}</td>
                        <td>{{ date('M') }}</td>
                        <td></td>
                    </tr>
                    
                </table>
                <br>
                <table class="table table-bordered">
                    <tr>
                        <th style="">DETAILS</th>
                        <th style="">ACCOUNT CODES</th>
                        <th style="">AMOUNT</th>
                        <th style=""></th>
                    </tr>
                    <tr style="height: 150px;">
                        <td style="white-space: normal;">
                            <strong>{{ $dtaRequest->purpose }}</strong>. <br>
                            {{ $dtaRequest->destination }} <br>
                            {{ $dtaRequest->travel_date }} - {{ $dtaRequest->arrival_date }}
                        </td>
                        <td>{{ $dtaRequest->account->code ?? '' }}</td>
                        <td>₦ {{ number_format($dtaRequest->estimated_expense, 2) }}</td>
                        <td style="white-space: normal;">
                            Payment Schedule No. <br>
                            Bank: 
                        </td>
                    </tr>
                    <tr style="height: 50px;">
                        <td style="border: 0px !important">Total Amount in words:</td>
                        <td style="border: 0px !important"></td>
                        <td style="border: 0px"><b>₦ {{ number_format($dtaRequest->estimated_expense, 2) }}</b></td>
                        <td style="border: 0px "></td>
                    </tr>
                </table>
                
                <table class="table table-bordered">
                    @foreach ($dtaRequest->approvalRecords as $approval)
                        <tr>
                            @switch($loop->index)
                                @case(0)
                                    <td><b>Prepared by:</b> {{ $approval->user->name }}</td>
                                    @break
                                @case(1)
                                    <td><b>Checked by:</b> {{ $approval->user->name }}</td>
                                    @break
                                @case(2)
                                    <td><b>Verified by:</b> {{ $approval->user->name }}</td>
                                    @break
                                @case(3)
                                    <td><b>Approved by:</b> {{ $approval->user->name }}</td>
                                    @break
                                @case(4)
                                    <td><b>Authorized by:</b> {{ $approval->user->name }}</td>
                                    @break
                                @case(6)
                                    <td><b>Paid by:</b> {{ $approval->user->name }}</td>
                                    @break
                                @default
                                    <td><b>Reviewed by:</b> {{ $approval->user->name }}</td> <!-- for any additional cases beyond 6 -->
                            @endswitch

                            <td style="white-space: normal;">
                                @if ($approval->user->signature)
                                <strong>Signature:</strong> <img src="{{ asset('storage/' . $approval->user->signature->signature_path) }}" alt="Signature" width="80">
                                @else
                                    <strong>Signature:</strong>  <strike>{{ $approval->user->name }}</strike>
                                @endif
                            </td>

                            <td style=""><b>Date:</b> {{ $approval->created_at->format('d-M-Y') }}</td>
                        </tr>
                    @endforeach
                </table>
    
                <table class="table table-bordered">
                    <tr>
                        <td><h4>RECEIPT : 
                            @if($dtaRequest->status=='approved')
                                <span class="text-success">Paid</span>
                            @else
                                <span class="text-warning">Pending</span>
                            @endif

                            @if($dtaRequest->status=='audit_approved' || $dtaRequest->status=='approved')
                                <span align="right">
                                    {!! QrCode::size(80)->generate( sprintf('%04d', $dtaRequest->id).' - '.$dtaRequest->user->name.' - '.number_format($dtaRequest->estimated_expense,2).
                                    " ".$dtaRequest->purpose." - ".$dtaRequest->destination." - ".$dtaRequest->travel_date.", ".
                                    $dtaRequest->status.' - '.$dtaRequest->created_at->format('d-M-Y') ) !!}
                                </span>
                            @endif
                        </h4></td>
                    </tr>
                    <tr>
                        <td>
                            I certify the receipt of the sum of:<hr class="solid">
                            Amount in words:
                        </td>
                    </tr>
                </table>
    
                <table class="table table-bordered" style="max-width: 100% !important;">
                    <tr>
                        <td colspan="2" style="width: 20%;"><h4>From NITT</h4></td>
                        <td style="width: 80%;">
                            <p class=""> Name: <span class=""></span> 
                                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                <span class=""> ₦ </span> 
                                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                &nbsp; &nbsp; 

                                <span class=""> K </span> 
                                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                &nbsp; &nbsp;
                                
                                Only</p>
                            <p class=""> Signture: <span class=""></span>  </p>
                            <p class=""> Date:<span class=""></span>  </p>
                        </td>
                    </tr>
                </table>
                <div class="text-center print-button">
                    <button onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Print Voucher</button>
                </div>
            </div>
        </div>
    
    <style>
        .print-button {
            margin-top: 20px;
        }
    </style>
</body>
</html>
