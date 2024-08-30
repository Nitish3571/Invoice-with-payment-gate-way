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
              <td><div style="margin-bottom:10px;"> <input type="text" placeholder="items" value="{{$invoiceItem->item}}" name="items[]" onchange="updateAmount(this)" required></div>
                <input style="min-width:300px;height:50px" type="text" placeholder="description" value="{{$invoiceItem->description}}" name="description[]" onchange="updateAmount(this)" required>
              </td>

              <td><input type="number" value="{{$invoiceItem->quantity}}" name="quantities[]" onchange="updateAmount(this)" class="rate" required></td>
              <td><input type="number" value="{{$invoiceItem->unit_rate}}" name="unit_rates[]" onchange="updateAmount(this)" required></td>
              <td><input type="number" value="{{$invoiceItem->cgst}}" name="cgst[]" onchange="updateAmount(this)" class="rate" ></td>
              <td><input type="number" value="{{$invoiceItem->sgst}}" name="sgst[]" onchange="updateAmount(this)" class="rate" ></td>
              <td><input type="number" value="{{$invoiceItem->igst}}" name="igst[]" onchange="updateAmount(this)" class="rate" ></td>
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

  <script>
    function addItemRow() {
     // Get the table body element where rows will be added
     var table = document.getElementById('itemRows');

     // Create a new row
     var row = table.insertRow();

     // Create cells for each input field
     var itemCell = row.insertCell(0);
     var quantityCell = row.insertCell(1);
     var unitRateCell = row.insertCell(2);
     var cgstCell = row.insertCell(3);
     var sgstCell = row.insertCell(4);
     var igstCell = row.insertCell(5);
     var amountCell = row.insertCell(6);

     // Set the inner HTML for each cell with input fields
     itemCell.innerHTML = `
         <input type="text" name="items[]" placeholder="Item" class="form-control" required />
         <textarea class="form-control" placeholder="Description" name="description[]" onchange="updateAmount(this)"></textarea>
     `;
     quantityCell.innerHTML = `
         <input type="number" name="quantities[]" class="form-control" min="1" value="1" onchange="updateAmount(this)" required />
     `;
     unitRateCell.innerHTML = `
         <input type="number" name="unit_rates[]" class="form-control" min="0" value="0" onchange="updateAmount(this)" required />
     `;
     cgstCell.innerHTML = `
         <input type="number" name="cgst[]" class="form-control" min="0" value="0" onchange="updateAmount(this)" required />
     `;
     sgstCell.innerHTML = `
         <input type="number" name="sgst[]" class="form-control" min="0" value="0" onchange="updateAmount(this)" required />
     `;
     igstCell.innerHTML = `
         <input type="number" name="igst[]" class="form-control" min="0" value="0" onchange="updateAmount(this)" required />
     `;
     amountCell.innerHTML = `
         <input type="number" name="amounts[]" class="form-control" min="0" value="0" readonly />
     `;

     // Recalculate totals whenever a new row is added
     calculateTotalAmount();
 }

     // Function to update the amount based on quantity and unit rate
     function updateAmount(element) {
     var row = element.parentElement.parentElement;
     var quantity = parseFloat(row.querySelector('input[name="quantities[]"]').value) || 0;
     var unitRate = parseFloat(row.querySelector('input[name="unit_rates[]"]').value) || 0;
     var cgst = parseFloat(row.querySelector('input[name="cgst[]"]').value) || 0;
     var sgst = parseFloat(row.querySelector('input[name="sgst[]"]').value) || 0;
     var igst = parseFloat(row.querySelector('input[name="igst[]"]').value) || 0;

     // Calculate total amount for the row
     var amount = quantity * unitRate;
     var totalAmt = amount;

     if (cgst > 0) {
       totalAmt += (amount * cgst / 100);
     }

     if (sgst > 0) {
       totalAmt += (amount * sgst / 100);
     }

     if (igst > 0) {
       totalAmt += (amount * igst / 100);
     }

     row.querySelector('input[name="amounts[]"]').value = totalAmt.toFixed(2);

     // Recalculate total amounts
     calculateTotalAmount();
 }


     // Function to calculate the total amount, discount, and net amount
     function calculateTotalAmount() {
     var subTotal = 0;
     var discountPercent = parseFloat(document.getElementById('discountInput').value) || 0;
     var discountValue = 0;

     // Calculate subtotal by summing all amount values
     var amounts = document.querySelectorAll('input[name="amounts[]"]');
     amounts.forEach(function(amount) {
         subTotal += parseFloat(amount.value) || 0;
     });

     // Calculate discount value
     discountValue = subTotal * (discountPercent / 100);

     // Calculate net amount after discount
     var netAmount = subTotal - discountValue;

     // Update the input fields
     document.getElementById('subTotal').value = subTotal.toFixed(2);
     document.getElementById('discount').value = discountValue.toFixed(2);
     document.getElementById('netAmount').value = netAmount.toFixed(2);
 }

     </script>
@endsection
