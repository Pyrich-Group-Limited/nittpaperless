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

        .ss-s{
           font-size: 150% !important;
        }
    
    </style>
</head>
<body>
        <div class="card voucher" style="width: auto;" id="printableArea">
                <table class="table-bordered tb2" id="tb2">
                       <tr id="tb2tr1">
                          <td width="10%">
                            <img src="{{  asset('assets/images/logo-dark.png') }}" width="100%" alt="">
                          </td>
                          <td align="center" width="60%">
                            <h3 class="text-info">NIGERIAN INSTITUTE OF TRANSPORT TECHNOLOGY</h3>
                            <h4>P.M.B, 1148, ZARIA-NIGERIA </h4>
                            <h3><span class="text-dark p-0 ss-s">Store Issue Voucher</span></h3>
                          </td>
                          <td width="10%"><img src="{{  asset('assets/images/coa.png') }}" width="100%" alt=""></td>
                       </tr>
                </table>
        
            <div class="card-body">
                <table class="table table-bordered tb1" id="tb1">
                    <tr id="tb1tr1">
                        <td align="left" style="width: 70%;"><b>Station/Unit: </b> </td>
                        <td><h4>No. {{ sprintf('%04d', $requisition->id) }}</h4></td>
                    </tr>
                    <tr id="tb1tr2">
                        <td align="left"><b>Please Issue the following for the job/Folio: </b> </td>
                    </tr>
                </table>
                {{-- <h4 align="right">No. {{ sprintf('%04d', $requisition->id) }}</h4>
                <p><b>Station/Unit: </b></p>
                <p><b>Please Issue the following for the job/Folio:  </b></p> --}}

                <table class="table table-bordered">
                    <tr>
                        <th rowspan="1">Item No.</th>
                        <th rowspan="2">Item Name</th>
                        <th rowspan="2">Description</th>
                        <th rowspan="2">Qunatity</th>
                        <th colspan="2">For Account</th>
                        <th rowspan="2">Ledger Folio</th>
                    </tr>
                    <tr>
                        <th colspan="4"></th>
                        <th>Rates Per Unit</th>
                        <th>₦ Value k</th>
                    </tr>
                    @foreach ($requisition->items->where('acknowledged', true) as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->quantity_requested }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                    
                    <tr style="height: 50px;">
                        <td></td>
                        <td></td>
                        <td style="border: 0px !important"><h2>Total ₦</h2></td>
                        <td style="border: 0px !important"></td>
                        <td style="border: 0px"><b></b></td>
                        <td style="border: 0px "></td>
                    </tr>
                </table>
                <p>Store listed above ISSUED</p>
                <br>

                <table class="table table-bordered" style="max-width: 100% !important;">
                    <tr>
                        <td style="width: 50%;">
                             <b>Signture of Store-keeper: </b>
                        </td>
                        <td style="width: 50%;">
                            <b>Signture of Store Officer: </b>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            <b> Date: </b>
                        </td>
                        <td style="width: 50%;">
                            <b> Signture/Date of Receiving Officer: </b>
                        </td>
                    </tr>
                </table>

                <div class="text-center print-button">
                    <button onclick="printDiv('printableArea')" class="btn btn-primary"><i class="fa fa-print"></i> Print Voucher</button>
                </div>
            </div>
        </div>

        <style>
            @media print {
                body * {
                    visibility: hidden; /* Hide everything by default */
                }
                head * {
                    visibility: hidden;
                }
                #printableArea, #printableArea * {
                    visibility: visible; /* Show only the printable area */
                }

                #printableArea {
                    position: absolute;
                    left: 0;
                    top: 0;
                    height: 100%; /* Adjust to fit the entire printable area */
                    max-height: 29.7cm; /* A4 height in centimeters */
                    width: 100%; /* Full width */
                    max-width: 21cm; /* A4 width in centimeters */
                    margin: auto;
                    overflow: hidden; /* Prevent content overflow */
                }

                table {
                    width: 100%;
                    font-size: 12px; /* Adjust font size to fit */
                    border-collapse: collapse;
                }

                td, th {
                    padding: 4px;
                    /* text-align: center; */
                    border: 1px solid black;
                }

                h3, h4, p {
                    margin: 5px 0;
                    font-size: 14px;
                }
            }
            .print-button {
                margin-top: 20px;
            }
        </style>

        <script>
            function printDiv(divId) {
                window.print();
            }
        </script>
</body>
</html>
