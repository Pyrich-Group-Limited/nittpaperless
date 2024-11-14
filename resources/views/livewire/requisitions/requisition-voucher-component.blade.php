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
                        <td style="width: 70%;"><b>Name of Payee:</b> {{ $requisition->staff->name }}</td>
                        <td><h4>No. {{ sprintf('%04d', $requisition->id) }}</h4></td>
                    </tr>
                    <tr id="tb1tr2">
                        <td><b>Account to be charged:</b></td>
                        <td>Expenditure Control No.</td>
                    </tr>
                </table>
    
                <table class="table table-bordered">
                    <tr>
                        <th>FINANCIAL YEAR</th>
                        <th>MONTH OF ACCOUNT</th>
                        <th></th>
                        <th rowspan="2">Date: {{ $requisition->created_at->format('d-M-Y') }}</th>
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
                            <strong>{{ $requisition->purpose }}</strong>. <br>
                            {{ $requisition->requisition_type }} <br>
                            {{ $requisition->description }}
                        </td>
                        <td></td>
                        <td>₦ {{ number_format($requisition->amount, 2) }}</td>
                        <td style="white-space: normal;">
                            Payment Schedule No. <br>
                            Bank: 
                        </td>
                    </tr>
                    <tr style="height: 50px;">
                        <td style="border: 0px !important">Total Amount in words:</td>
                        <td style="border: 0px !important"></td>
                        <td style="border: 0px"><b>₦ {{ number_format($requisition->amount, 2) }}</b></td>
                        <td style="border: 0px "></td>
                    </tr>
                </table>
                
                <table class="table table-bordered">
                    {{-- {{ dd($requisition->approvalRecords) }} --}}
                    @foreach ($requisition->approvalRecords as $approval)
                        <tr>
                            
                            <td style=""><p class=""><b>Approved by:</b> {{ $approval->staff->name }}</p></td>
                            <td style="white-space: normal;"><p class=""><strong>Signature:</strong> <strike>{{ $approval->staff->name }}</strike> </p></td>
                            <td style=""><p class=""><b>Date:</b> {{ $approval->created_at->format('d-M-Y') }}</p></td>
                        </tr>
                        {{-- <tr>
                        </tr>
                        <tr> --}}
                        </tr>
                    @endforeach
                </table>
                
                {{-- <table class="table table-bordered">
                    <tr>
                        <th>Officer Controlling Expenditure</th>
                        <th>Officer Authorizing Expenditure</th>
                        <th>Audit Post-payment Stamp</th>
                    </tr>
                    <tr>
                        <td><p class="text-with-line-5">Name: </p></td>
                        <td><p class="text-with-line-5">Name: </p></td>
                        <td><p class="text-with-line-5">Name: </p></td>
                    </tr>
                    <tr>
                        <td><p class="text-with-line-6">Designation: </p></td>
                        <td><p class="text-with-line-6">Designation: </p></td>
                        <td><p class="text-with-line-6">Designation: </p></td>
                    </tr>
                    <tr>
                        <td><p class="text-with-line-7">Signature: </p></td>
                        <td><p class="text-with-line-7">Signature: </p></td>
                        <td><p class="text-with-line-7">Signature: </p></td>
                    </tr>
                    <tr>
                        <td><p class="text-with-line-5">Date: </p></td>
                        <td><p class="text-with-line-5">Date: </p></td>
                        <td><p class="text-with-line-5">Date: </p></td>
                    </tr>
                </table> --}}
    
                <table class="table table-bordered">
                    <tr>
                        <td style="border: 0px !important"><h4>RECEIPT</h4></td>
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
                {{-- <p><strong>Contract ID:</strong> {{ $requisition->contract->id }}</p> --}}
                {{-- <p><strong>Project Name:</strong> {{ $requisition->contract->subject }}</p> --}}
                {{-- <p><strong>Contractor:</strong> {{ $requisition->contract->clients->name }}</p> --}}
                {{-- <p><strong>Voucher ID:</strong> {{ $requisition->id }}</p> --}}
                {{-- <p><strong>Amount:</strong> ₦{{ number_format($requisition->recommended_amount, 2) }}</p> --}}
                {{-- <p><strong>Recommended By:</strong> {{ $requisition->recommendedBy->name }}</p> --}}
                {{-- <p><strong>Approved By DG:</strong> {{ $requisition->approvedBy->name }}</p>
                <p><strong>Signed By Bursar:</strong> {{ $requisition->signedBy->name }}</p>
                <p><strong>Payment Date:</strong> {{ $requisition->created_at->format('Y-m-d') }}</p> --}}
            
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
