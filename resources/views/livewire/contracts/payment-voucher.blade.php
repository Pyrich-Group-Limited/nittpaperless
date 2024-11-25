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
        /* Set page size to A4 */
        /* @page {
            size: A4;
            margin: 10mm; /* Adjust margin if needed */
        } */



        /* Ensure body content fits the page */
        /* body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            height: 100% !important;
        } */

        /* Hide elements you don't want in the print view */
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
                        <td style="width: 70%;"><b>Name of Payee:</b> {{ $paymentRequest->contract->clients->name }}</td>
                        <td><h4>No. {{ sprintf('%04d', $paymentRequest->id) }}</h4></td>
                    </tr>
                    <tr id="tb1tr2">
                        <td><b>Account to be charged:</b> {{ $paymentRequest->account->name ?? '' }} </td>
                        <td>Expenditure Control No.</td>
                    </tr>
                </table>

                <table class="table table-bordered">
                    <tr>
                        <th>FINANCIAL YEAR</th>
                        <th>MONTH OF ACCOUNT</th>
                        <th></th>
                        <th rowspan="2">Date: {{ $paymentRequest->created_at->format('d-M-Y') }}</th>
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
                            <strong>{{ $paymentRequest->contract->subject }}</strong>. <br>
                            {{ $paymentRequest->contract->description }}
                        </td>
                        <td>{{ $paymentRequest->account->code ?? '' }}</td>
                        <td>₦ {{ number_format($paymentRequest->recommended_amount, 2) }}</td>
                        <td style="white-space: normal;">
                            Payment Schedule No. <br>
                            Bank:
                        </td>
                    </tr>
                    <tr style="height: 50px;">
                        <td style="border: 0px !important">Total Amount in words:</td>
                        <td style="border: 0px !important"></td>
                        <td style="border: 0px"><b>₦ {{ number_format($paymentRequest->recommended_amount, 2) }}</b></td>
                        <td style="border: 0px "></td>
                    </tr>
                </table>

                {{-- <table class="table table-bordered">
                    @foreach ($paymentRequest->approvalRecords as $approval)
                        <tr>
                            <td><b>Approved by:</b> {{ $approval->staff->name }}</td>
                            <td style="white-space: normal;"><strong>Signature:</strong>  <strike>{{ $approval->staff->name }}</strike>
                            </td>
                            <td style=""><b>Date:</b> {{ $approval->created_at->format('d-M-Y') }}</td>
                        </tr>
                    @endforeach
                </table> --}}

                <table class="table table-bordered">
                    <tr>

                        <td style="white-space: normal;"><p class=""><strong>Voucher Prepared by:</strong> <strike>{{ $paymentRequest->recommendedBy->name ?? '' }}</strike> </p></td>
                        <td style="white-space: normal;"><p class=""><b>Voucher Checked, Committed & Passed by:</b> <strike>{{ $paymentRequest->approvedBy->name ?? '' }}</strike></p></td>
                    </tr>
                    <tr>
                        <td style=""><p class=""><b>Name:</b> {{ $paymentRequest->recommendedBy->name ?? '' }}</p></td>
                        <td style=""><p class=""><b>Name:</b> {{ $paymentRequest->approvedBy->name ?? ''}}</p></td>
                    </tr>
                    <tr>
                        <td style=""><p class=""><b>Date:</b> {{ $paymentRequest->created_at->format('d-M-Y') }}</p></td>
                        <td style=""><p class=""><b>Date:</b> {{ $paymentRequest->created_at->format('d-M-Y') }}</p></td>
                    </tr>
                </table>

                <table class="table table-bordered">
                    <tr>
                        <td><h4>RECEIPT :
                            @if($paymentRequest->status=='paid')
                                <span class="text-success">Paid</span>
                            @else
                                <span class="text-warning">Pending</span>
                            @endif

                            @if($paymentRequest->status=='audited' || $paymentRequest->status=='paid')
                                <span align="right">
                                    {!! QrCode::size(80)->generate( sprintf('%04d', $paymentRequest->id).' - '.$paymentRequest->contract->clients->name.' - '.number_format($paymentRequest->recommended_amount,2).
                                    " ".$paymentRequest->contract->subject." - ".$paymentRequest->contract->description."  ".
                                    $paymentRequest->status.' - '.$paymentRequest->created_at->format('d-M-Y') ) !!}
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
