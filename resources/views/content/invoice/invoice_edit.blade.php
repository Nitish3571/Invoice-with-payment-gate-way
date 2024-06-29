@extends('layouts/contentNavbarLayout')

@section('title', 'Invoice create')


@section('content')

  <div class="row mt-0">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
            <div class="mb-3">
            <!--<div class="text-center fs-2 fw-bold">JobPrint Navigator Invoice-->
              <!--<label class="form-label text-center" for="basic-icon-default-email">JobPrint Navigator Invoice</label>-->
            <!--  </div>-->

    <div class="table-responsive text-nowrap">
        <h3 class="text-center fs-2">Invoice</h3>
        <form action="{{url('invoice/update', $invoiceDetails->id)}}" method="POST">
          @csrf
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


              <p class="mb-2">Invoice :<b><input type=text name="invoice_no" value="{{ $invoiceDetails->invoice_no }}" readonly/></b></p>
              <p>Date :<b><input type="text" value="{{ $invoiceDetails->date }}" name="date" /></b></p>
          </td>
          <td>
              <p>Place Of Supply :
              <select name="placeSupply" required>
                  <option value="">select</option>
                  <option value="Gujarat(24)" {{ $invoiceDetails->placeSupply == 'Gujarat(24)' ? 'selected' : '' }}>Gujarat(24)</option>
                  <option value="Rajasthan(08)" {{ $invoiceDetails->placeSupply == 'Rajasthan(08)' ? 'selected' : '' }}>Rajasthan(08)</option>
                  <option value="Himachal Pradesh(02)" {{ $invoiceDetails->placeSupply == 'Himachal Pradesh(02)' ? 'selected' : '' }}>Himachal Pradesh(02)</option>
                  <option value="Punjab(03)" {{ $invoiceDetails->placeSupply == 'Punjab(03)' ? 'selected' : '' }}>Punjab(03)</option>
                  <option value="Chandigarh(04)" {{ $invoiceDetails->placeSupply == 'Chandigarh(04)' ? 'selected' : '' }}>Chandigarh(04)</option>
                  <option value="Uttarakhand(05)" {{ $invoiceDetails->placeSupply == 'Uttarakhand(05)' ? 'selected' : '' }}>Uttarakhand(05)</option>
                  <option value="Haryana(06)" {{ $invoiceDetails->placeSupply == 'Haryana(06)' ? 'selected' : '' }}>Haryana(06)</option>
                  <option value="Delhi(07)" {{ $invoiceDetails->placeSupply == 'Delhi(07)' ? 'selected' : '' }}>Delhi(07)</option>

              </select>
              </p>
          </td>
          </tr>
      <tr>
          <th>Bill To</th>
          <th>Ship To</th>
      </tr>
      <tr>
          <td>
              <b>Company Name : <p style="margin-bottom:5px;"><input type="text" value="{{ $invoiceDetails->billName }}"  placeholder="Enter Company name" name="billName"/></p></b>
              Address:
              <p style="margin-bottom:5px;"> <textarea name="billingAddress" style="min-width:350px;" placeholder="Enter billing address" required>{{ $invoiceDetails->billingAddress }}</textarea></p>
              <p>Phone No : <input type="number"  placeholder="Enter phone number" name="billingPhoneNo" value="{{ $invoiceDetails->billingPhoneNo }}"/></p>
              <p>Email : <input type="email"  placeholder="Enter email address" name="billingEmail" value="{{ $invoiceDetails->billingEmail }}"/></p>
          </td>
          <td>

            <b>Company Name :  <p style="margin-bottom:5px;"><input type="text"  placeholder="Enter Company name" value="{{ $invoiceDetails->shipName }}" name="shipName"/></p></b>
            Address:
            <p style="margin-bottom:5px;"><textarea name="shipAddress" style="min-width:350px;" placeholder="Enter shipping address" required> {{ $invoiceDetails->shipAddress }}</textarea></p>
            <p>Phone No : <input type="number"  placeholder="Enter phone number" value="{{ $invoiceDetails->shipPhoneNo }}" name="shipPhoneNo"/></p>
            <p>Email : <input type="email"  placeholder="Enter email address" value="{{ $invoiceDetails->shipEmail }}" name="shipEmail"/></p>
          </td>
      </tr>
      </table>
      <table class="table" id="myTable">
          <tr>
            <th>Items</th>
            <th>Quantity</th>
            <th>UNIT RATE</th>
            <th>CGST(%)</th>
            <th>SGST(%)</th>
            <th>IGST(%)</th>
            <th>Amount</th>

          </tr>

          <tbody id="itemRows">
            @foreach ($invoiceItems as $invoiceItem)
            {{ $invoiceItem->item}}
            <tr>
              <td><div style="margin-bottom:10px;"> <input type="text" placeholder="items" value="{{$invoiceItem->item}}" name="items[]" onchange="calculateRowAmount(this)" required></div>
                <input style="min-width:300px;height:50px" type="text" placeholder="description" value="{{$invoiceItem->description}}" name="description[]" onchange="calculateRowAmount(this)" required>
              </td>

              <td><input type="number" value="{{$invoiceItem->quantity}}" name="quantities[]" onchange="calculateRowAmount(this)" class="rate" required></td>
              <td><input type="number" value="{{$invoiceItem->unit_rate}}" name="unit_rates[]" onchange="calculateRowAmount(this)" required></td>
              <td><input type="number" value="{{$invoiceItem->cgst}}" name="cgst[]" onchange="calculateRowAmount(this)" class="rate" ></td>
              <td><input type="number" value="{{$invoiceItem->sgst}}" name="sgst[]" onchange="calculateRowAmount(this)" class="rate" ></td>
              <td><input type="number" value="{{$invoiceItem->igst}}" name="igst[]" onchange="calculateRowAmount(this)" class="rate" ></td>
              <td><input type="number" value="{{$invoiceItem->amount}}" name="amounts[]" readonly></td>
            </tr>
              @endforeach
          </tbody>
          <tr>
            <td colspan="7">
              <button type="button" class="btn btn-primary" onclick="addItemRow()">Add Item</button>
            </td>
          </tr>

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
            <td><input type="text" style="width:150px"  id="subTotal" value="{{$invoiceDetails->subTotal}}" name="subTotal" onchange="calculateAmount(this)" readonly /></td>
        </tr>
        <tr>
            <td>Discount(%):<input type="number" style="width:50px" value="{{$invoiceDetails->discountInput}}" name="discountInput" id="discountInput" onkeyup="calculateTotalAmount()"/> </td>
            <td><input type="text" style="width:150px" id="discount" value="{{$invoiceDetails->discountValue}}" name="discountValue" onchange="calculateAmount(this)" readonly /></td>
        </tr>
          <tr>
            <td>Net Amount: </td>
            <td><input type="text" style="width:150px;" id="netAmount" value="{{$invoiceDetails->netAmount}}" name="netAmount" onchange="calculateAmount(this)" readonly /></td>
        </tr>
        <tr>
            <td colspan="2" class="d-inline-flex text-white ">
                <div><button class="btn btn-primary m-3" type="submit" name="save" >Save</button></div>
                <div><a class="btn btn-primary m-3" href="{{route('invoice-list')}}">Cancel</a></div>
            </td>
        </tr>
      </table>

      </table>
      </form>
              </div>
            </div>

        </div>
      </div>
    </div>
  </div>


@endsection
