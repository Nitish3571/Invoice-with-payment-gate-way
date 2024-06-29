@extends('layouts/contentNavbarLayout')

@section('title', 'Invoice List')

@section('content')

<div class="card">
<div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Invoice List </h5>
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="mdi mdi-magnify mdi-24px lh-0"></i>
                    <input type="text" id="searchInput" class="form-control border-0 shadow-none bg-body mx-3"
                           placeholder="Search..." aria-label="Search...">
                </div>
            </div>
        </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped" style="text-align: center">
      <thead >
        <tr>
        <th>Sr.no</th>
        <th>Invoice No</th>
        <th>Date</th>
        <th>Name</th>
        <th>Phone No</th>
        <th>Email</th>
        <th>Status</th>
        <th>Total Amount</th>
        <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="customerTable">
        @php $srNo =1; @endphp
        @forEach($invoiceDetails as $invoiceDetail)
                  <tr>
                    <td>{{$srNo++}}</td>
                    {{-- <td>{{ $user->name}}</td> --}}
                    <td>
                      <a href="{{url('invoice/view' , $invoiceDetail->id)}}" target="_blank">
                        INV #00{{ $invoiceDetail->invoice_no}}
                    </a>
                    </td>
                    <td>{{ $invoiceDetail->date}}</td>
                    <td>{{ $invoiceDetail->billName}}</td>
                    <td>{{ $invoiceDetail->billingPhoneNo}}</td>
                    <td>{{ $invoiceDetail->billingEmail}}</td>

                    <td>Unpaid</td>
                    <td>{{ $invoiceDetail->netAmount}}</td>

                  {{-- <td>@if($bookingService->status == 1) <span class="badge rounded-pill bg-label-success me-1">Active</span> @else <span class="badge rounded-pill bg-label-secondary me-1">Inactive</span> @endif</td> --}}
                  <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class='bx bx-dots-vertical-rounded' ></i></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('invoice/view' , $invoiceDetail->id)}}"><i class='bx bx-low-vision'></i></i> View</a>
                            <a class="dropdown-item" href="{{url('invoice/edit' , $invoiceDetail->id)}}"><i class='bx bx-edit-alt'></i> Edit</a>
                            <a class="dropdown-item" href="{{url('invoice/delete' , $invoiceDetail->id)}}"><i class='bx bx-trash' ></i> Delete</a>
                        </div>
                    </div>
                </td>
                </tr>
                  @endforeach


      </tbody>
    </table>
    <div id="noDataMessage" style="display: none; padding: 10px; text-align: center; color: red; font-size:18px">Record not found</div>

  </div>
</div>


@endsection
