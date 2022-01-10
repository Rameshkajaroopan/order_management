@extends('layouts.app')

@section('content')

<style>
  .rwd-table {
    margin: auto;
    min-width: 300px;
    max-width: 100%;
    border-collapse: collapse;
  }

  .custom-txt-right {
    text-align: right !important;
  }

  .rwd-table tr:first-child {
    border-top: none;
    color: #495057;

  }

  .rwd-table td {
    border-top: 0 !important;

  }

  .rwd-table th {
    display: none;
  }

  .rwd-table td {
    display: block;
  }

  .rwd-table td:first-child {
    margin-top: .5em;
  }

  .rwd-table td:last-child {
    margin-bottom: .5em;
  }

  .rwd-table td:before {
    content: attr(data-th) "";
    font-weight: bold;
    width: 120px;
    display: inline-block;
    color: #495057;
  }


  .rwd-table th,
  .rwd-table td {
    text-align: left;
  }

  .rwd-table {
    color: #333;
    border-radius: .4em;
    overflow: hidden;
  }

  .rwd-table tr {
    border-color: #bfbfbf;
  }

  .rwd-table th,
  .rwd-table td {
    padding: .5em 1em;
  }

  @media screen and (max-width: 601px) {
    .rwd-table tr:nth-child(2) {
      border-top: none;
    }

    .rwd-table td:nth-of-type(1) {
      background-color: #495057;
      color: white;
      display: grid;
    }

    .rwd-table td:nth-of-type(1):before {
      content: "" !important;
    }

    .custom-txt-right {
      text-align: left !important;
    }



  }

  @media screen and (min-width: 600px) {
    .rwd-table tr:hover:not(:first-child) {
      background-color: #d8e7f3;
    }

    .rwd-table td:before {
      display: none;
    }

    .rwd-table th,
    .rwd-table td {
      display: table-cell;
      padding: .25em .5em;
    }

    .rwd-table th:first-child,
    .rwd-table td:first-child {
      padding-left: 0;
    }

    .rwd-table th:last-child,
    .rwd-table td:last-child {
      padding-right: 0;
    }

    .rwd-table th,
    .rwd-table td {
      padding: 1em !important;
    }


  }
</style>

<!-- Main content -->
<section class="content mt-5">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row ">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">In Progress </span>
            <span class="info-box-number"> {{$allorders->where('working_status','InProgress')->count()}}</span>

          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Stuck Orders</span>
            <span class="info-box-number">
              {{$allorders->where('working_status','Stuck')->count()}}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Completed Orders</span>
            <span class="info-box-number"> {{$allorders->where('working_status','Completed')->count()}}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Not Start</span>
            <span class="info-box-number">{{$allorders->where('working_status','NotStart')->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->


    <!-- TABLE: LATEST ORDERS -->
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Recent Orders</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>

        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0 table rwd-table table table-striped table table-hover">
              <tr>
                
                <th>Order </th>
                <th>Customer</th>
                <th>Mobile</th>
                <th>Total Amount</th>

                <th>Paid Amount</th>
                <th>Balance Amount</th>

                <th>Created Branch</th>
                <th>Status</th>


              </tr>
           
              @foreach($orders as $order)
              <tr>
                
                <td data-th="Order">{{$order->serial_number}}</td>
                <td data-th="Customer">{{$order->customer_name}}</td>
                <td data-th="Mobile">{{$order->mobile}}</td>

                <td data-th="Total Amount">{{$order->total_amount}}</td>
                <td data-th="Paid Amount">{{$order->paid_amount}}</td>
                <td data-th="Balance Amount">{{$order->total_amount - $order->paid_amount}}</td>
                <td data-th="Created Branch">{{$order->branch->name}}</td>
                @if($order->working_status == 'NotStart')
                <td data-th="Status"><span class="badge badge-warning">Not Start</span></td>
                @elseif($order->working_status == 'InProgress')
                <td data-th="Status"><span class="badge badge-info">In Progress</span></td>
                @elseif($order->working_status == 'Stuck')
                <td data-th="Status"><span class="badge badge-danger">Stuck</span></td>

                @else
                <td data-th="Status"><span class="badge badge-success">Completed</span></td>

                @endif



              </tr>
              @endforeach

          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <div class="row">
          <div class="col-6">
        <a  href="/completedOrder" class="btn btn-sm btn-info ">View Completed Orders</a>
        </div>
        <div class="col-6">
 
        <a  href="/pendingOrder" class="btn btn-sm btn-secondary mr-2 float-right">View Pending Orders</a>
        </div>
 
      </div>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->

  <section class="content ">
  <div class="card-header border-transparent">
        <h3 class="card-title">Tody's Payment Summary</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>

        </div>
      </div>
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-money-bill-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Amount </span>
              <span class="info-box-number"> {{$total}} INR</span>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-money-check-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Paid Amount </span>
              <span class="info-box-number">
                {{$paid}} INR
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-money-bill"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Payable Amount </span>
              <span class="info-box-number"> {{$total-$paid}} INR
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <!-- /.col -->
      </div>
      <!-- /.row -->


      @endsection