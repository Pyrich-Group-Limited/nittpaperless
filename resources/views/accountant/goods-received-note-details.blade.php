<!DOCTYPE html>
<html lang="en">
<?php
    $total = 0;
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Goods Recieve Note</title>
  <link rel="stylesheet" href="{{ asset('style.css')}}" type="text/css" media="all" />
</head>

<body>
  <div>
    <div class="py-4">
      <div class="px-14 py-6">
        <table class="w-full border-collapse border-spacing-0">
          <tbody>
            <tr>
              <td class="w-full align-top">
                <div>
                  <img src="{{ asset('assets/images/nitt-logo.png')}}" class="h-12" />
                </div>
              </td>

              <td class="align-top">
                <div class="text-sm">
                  <table class="border-collapse border-spacing-0">
                    <tbody>
                      <tr>
                        <td class="border-r pr-4">
                          <div>
                            <p class="whitespace-nowrap text-slate-400 text-right">Date</p>
                            <p class="whitespace-nowrap font-bold text-main text-right">{{ $good->created_at->format('d M Y')}}</p>
                          </div>
                        </td>
                        <td class="pl-4">
                          <div>
                            <p class="whitespace-nowrap text-slate-400 text-right">Invoice #</p>
                            <p class="whitespace-nowrap font-bold text-main text-right">{{ $good->invoice_no}}</p>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="bg-slate-100 px-14 py-6 text-sm">
        <table class="w-full border-collapse border-spacing-0">
          <tbody>
            <tr>
              <td class="w-1/2 align-top">
                <div class="text-sm text-neutral-600">
                    <p class="font-bold">Customer Company</p>
                    <p>Number: 123456789</p><br>
                    <p>The following goods have been received in <br> good order and condition</p>
                    <p>1. SUPPLIER: {{ $good->supplier_name }}</p>
                  <p>2. LPT No.: {{ $good->supplier_name }}</p>
                </div>
              </td>

            </tr>
          </tbody>
        </table>
      </div>

      <div class="px-14 py-10 text-sm text-neutral-700">
        <table class="w-full border-collapse border-spacing-0">
          <thead>
            <tr>
              <td class="border-b-2 border-main pb-3 pl-3 font-bold text-main">#</td>
              <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Description</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Quantity</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-center font-bold text-main">Unit Price</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Subtotal</td>
            </tr>
          </thead>
          <tbody>
            @foreach($good->items as $item)
            @php
                $total = $total + ($item->item->unit_price * $item->item->quantity);
            @endphp
            <tr>
              <td class="border-b py-3 pl-3">{{ $loop->iteration }}</td>
              <td class="border-b py-3 pl-2">{{ $item->item->item }}</td>
              <td class="border-b py-3 pl-2 text-right">{{ $item->quantity }}</td>
              <td class="border-b py-3 pl-2 text-center">{{ number_format($item->item->unit_price) }}</td>
              <td class="border-b py-3 pl-2 text-right">{{  number_format($item->item->unit_price * $item->item->quantity) }}</td>
            </tr>
            @endforeach
            <tr>
              <td colspan="7">
                <table class="w-full border-collapse border-spacing-0">
                  <tbody>
                    <tr>
                      <td class="w-full"></td>
                      <td>
                        <table class="w-full border-collapse border-spacing-0">
                          <tbody>
                            <tr>
                              <td class="bg-main p-3">
                                <div class="whitespace-nowrap font-bold text-white">Total:</div>
                              </td>
                              <td class="bg-main p-3 text-right">
                                <div class="whitespace-nowrap font-bold text-white">{{ number_format($total) }}</div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
{{--
      <div class="px-14 text-sm text-neutral-700">
        <p class="text-main font-bold">PAYMENT DETAILS</p>
        <p>Banks of Banks</p>
        <p>Bank/Sort Code: 1234567</p>
        <p>Account Number: 123456678</p>
        <p>Payment Reference: BRA-00335</p>
      </div>

      <div class="px-14 py-10 text-sm text-neutral-700">
        <p class="text-main font-bold">Notes</p>
        <p class="italic">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries
          for previewing layouts and visual mockups.</p>
        </dvi> --}}

        <footer class="fixed bottom-0 left-0 bg-slate-100 w-full text-neutral-600 text-center text-xs py-3">
          NIIT
          <span class="text-slate-300 px-2">|</span>
          info@nitt.com
        </footer>
      </div>
    </div>
</body>

</html>
