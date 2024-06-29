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
        <form action="{{url('invoice/store')}}" method="POST">
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


              <p class="mb-2">Invoice :<b><input type=text name="invoice_no" value="{{ $nextInvoiceNumber }}" readonly/></b></p>
              <p>Date :<b><input type="text" value="@php echo date('d-m-Y'); @endphp" name="date" /></b></p>
          </td>
          <td>
              <p>Place Of Supply :
              <select name="placeSupply" required>
                  <option value="">select</option>
                  <option value="Gujarat(24)">Gujarat(24)</option>
                  <option value="Rajasthan(08)">Rajasthan(08)</option>
                  <option value="Himachal Pradesh(02)">Himachal Pradesh(02)</option>
                  <option value="Punjab(03)">Punjab(03)</option>
                  <option value="Chandigarh(04)">Chandigarh(04)</option>
                  <option value="Uttarakhand(05)">Uttarakhand(05)</option>
                  <option value="Haryana(06)">Haryana(06)</option>
                  <option value="Delhi(07)">Delhi(07)</option>

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
              <b>Company Name : <p style="margin-bottom:5px;"><input type="text"  placeholder="Enter Company name" name="billName"/></p></b>
              Address:
              <p style="margin-bottom:5px;"> <textarea name="billingAddress" style="min-width:350px;" placeholder="Enter billing address" required></textarea></p>
              <p>Phone No : <input type="number"  placeholder="Enter phone number" name="billingPhoneNo"/></p>
              <p>Email : <input type="email"  placeholder="Enter email address" name="billingEmail"/></p>
          </td>
          <td>

            <b>Company Name :  <p style="margin-bottom:5px;"><input type="text"  placeholder="Enter Company name" name="shipName"/></p></b>
            Address:
            <p style="margin-bottom:5px;"><textarea name="shipAddress" style="min-width:350px;" placeholder="Enter shipping address" required></textarea></p>
            <p>Phone No : <input type="number"  placeholder="Enter phone number" name="shipPhoneNo"/></p>
            <p>Email : <input type="email"  placeholder="Enter email address" name="shipEmail"/></p>
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
            <!-- Dynamic rows for items will be added here -->
          </tbody>
          <tr>
            <td colspan="7">
              <button type="button" class="btn btn-primary" onclick="addItemRow()">Add Item</button>
            </td>
          </tr>

      </table>

      <table class="table">
          {{-- <tr>
                <td>
                    <select id="select" name="items">
                    <option >select</option>
                    <option value="Design">Design</option>
                    <option value="UV">U.V.</option>
                    <option value="Cutting">Cutting</option>
                    <option value="Creasing">Creasing</option>
                    <option value="Printing">Printing</option>
                    <option value="Lamination">Lamination</option>
                    <option value="Binding">Binding</option>
                    <option value="Papper">Papper</option>
                    <option value="Transport">Transport</option>
                </select>
                </td>
            </tr> --}}
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
            <td><input type="text" style="width:150px"  id="subTotal" name="subTotal" onchange="calculateAmount(this)" readonly /></td>
        </tr>
        <tr>
            <td>Discount(%):<input type="number" style="width:50px" name="discountInput" id="discountInput" onkeyup="calculateTotalAmount()"/> </td>
            <td><input type="text" style="width:150px" id="discount" name="discountValue" onchange="calculateAmount(this)" readonly /></td>
        </tr>
          <tr>
            <td>Net Amount: </td>
            <td><input type="text" style="width:150px;" id="netAmount" name="netAmount" onchange="calculateAmount(this)" readonly /></td>
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
