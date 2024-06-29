@extends('layouts/blankLayout')

@section('title', 'Invoice create')


@section('content')

  <div class="row mt-0 px-md-5" >
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
            <div class="mb-3">
            <!--<div class="text-center fs-2 fw-bold">JobPrint Navigator Invoice-->
              <!--<label class="form-label text-center" for="basic-icon-default-email">JobPrint Navigator Invoice</label>-->
            <!--  </div>-->
    {{-- <div class="table-responsive text-nowrap"> --}}
        <h3 class="text-center fs-2">Invoice</h3>

    <table class="border" class="table">
      <table class="table">
        <tr>
          <td>
              <img src="{{ asset('assets/img/avatars/1.png') }}" height="80" width="auto"/>
          </td>
          <td>
              <b style="font-size: 20px; font-weight:bold">CodeRunner</b>
              <p>I/105, HariVilla , Chandlodiya
              Ahmedabad, Gujarat - 382470, India</p>
              <p>GSTN: 24AHAPC8112A1ZC</p>
              <p>IEC: AHAPC8112A</p>

          </td>
      </tr>
      <tr>
          <td>


              <p class="mb-2">Invoice :<b>INV #00 {{$invoiceDetails->invoice_no}}</b></p>
              <p>Date :<b>{{$invoiceDetails->date}}</b></p>
          </td>
          <td>
              <p>Place Of Supply : {{$invoiceDetails->placeSupply}}</p>
          </td>
          </tr>
      <tr>
          <th>Bill To</th>
          <th>Ship To</th>
      </tr>
      <tr>
          <td>
              <b><p>{{$invoiceDetails->billName}}</p></b>
              <p style="margin-bottom:5px;"> {{$invoiceDetails->billingAddress}}</p>
              <p>Phone No : {{$invoiceDetails->billingPhoneNo}}</p>
              <p>Email : {{$invoiceDetails->billingEmail}}</p>
          </td>
          <td>

            <b><p>{{$invoiceDetails->shipName}}</p></b>
            <p style="margin-bottom:5px;"> {{$invoiceDetails->shipAddress}}</p>
            <p>Phone No : {{$invoiceDetails->shipPhoneNo}}</p>
            <p>Email : {{$invoiceDetails->shipEmail}}</p>
          </td>
      </tr>
      </table>
      <table class="table" id="myTable">
          <tr>
            <th  style="min-width: 200px">Items</th>
            <th class="rate text-center" >Qty</th>
            <th class="rate text-center">U.RATE</th>
            <th class="rate text-center">CGST(%)</th>
            <th class="rate text-center">SGST(%)</th>
            <th class="rate text-center">IGST(%)</th>
            <th class="text-center">Amount</th>

          </tr>
            @foreach ($invoiceItems as $invoiceItem)
            <td >
              <div style="font-weight: bold" style="min-width: 200px ">{{$invoiceItem->item}}</div>
              {{$invoiceItem->description}}

            </td>
            <td class="rate text-center" class="rate">{{$invoiceItem->quantity}}</td>
            <td class="rate text-center">{{$invoiceItem->unit_rate}}</td>
            <td class="rate text-center">{{$invoiceItem->cgst}}</td>
            <td class="rate text-center">{{$invoiceItem->sgst}}</td>
            <td class="rate text-center">{{$invoiceItem->igst}}</td>
            <td class="text-center">{{$invoiceItem->amount}}</td>

          </tr>
          @endforeach

      </table>

      <table class="table">
          <tr>
            <td colspan="3" rowspan="3">
                <div class="border p-2 ">
                <h4>Payment Details</h4>
                <p>Bank Name : State Bank Of India</p>
                <p>Account Name : Rana Jee</p>
                <p>Account No : 4425814552240</p>
                <p>IFSC Code : 4425814552240</p>
                </div>
            </td>
            <td>Sub Total: </td>
            <td>{{$invoiceDetails->subTotal}}</td>
        </tr>
        <tr>
            <td>Discount(:{{$invoiceDetails->discountInput}} %)</td>
            <td>{{$invoiceDetails->discountValue}}</td>
        </tr>
          <tr>
            <td style="font-size: 20px; font-weight:bold">Net Amount: </td>
            <td style="font-size: 20px; font-weight:bold">{{$invoiceDetails->netAmount}}</td>
        </tr>
        <tr id="printTr">
            <td colspan="2" class="d-inline-flex text-white ">
                <div><button class="btn btn-primary m-3" id="printButton" name="save" >Print</button></div>
                <div class="card-body text-center">
                  <form action="/payment" method="POST" >
                     @csrf
                     <script src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="rzp_test_KPvuflmxXQPkmk"
                        data-amount="{{($invoiceDetails->netAmount)*100}}"
                        data-currency="INR"
                        data-buttontext="Pay {{$invoiceDetails->netAmount}} INR"
                        data-name="CodeRunner"
                        data-description="Payment Test"
                        data-image="{{ asset('img/logo.png') }}"
                        data-prefill.name="Rana Jee"
                        data-prefill.email="nitishkumar4042004@gmail.com"
                        data-theme.color="#F37254"></script>
                  </form>
               </div>
                <div><button class="btn btn-primary m-3" id="downloadButton" name="save" >Download</button></div>
                <div><a class="btn btn-primary m-3" href="{{route('invoice-list')}}" >Cancel</a></div>
            </td>
        </tr>
      </table>

      </table>
              </div>
            {{-- </div> --}}

        </div>
      </div>
    </div>
  </div>


@endsection
