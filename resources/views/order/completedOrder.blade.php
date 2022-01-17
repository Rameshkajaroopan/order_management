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
        color: #3f6791;
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
<!-- <div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <strong>Created Branch</strong>
                        <select id="branch_status" class=" browser-default form-control" onchange="window.location.assign('/completedOrder?branch_status=' + $('#branch_status').val())">
                            <option value="" {{$branch_status == "" ? 'selected':''}}>All</option>
                            @foreach($branches as $branch )
                            <option value="{{$branch->id}}" {{$branch_status == "$branch->id" ? 'selected':''}}>{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>

                  
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <form action="/completedOrder" method="GET" class="row m-0">

                    <div class="col-md-2.5">
                        <div class="form-group">
                            <strong>From</strong>
                            <input type="date" name="from" id="from" value="{{$from}}" class="form-control" required>
                        </div>
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <div class="col-md-2.5">
                        <div class="form-group">
                            <strong>To</strong>
                            <input type="date" name="to" id="to" value="{{$to}}" class="form-control">
                        </div>
                    </div>
                    &nbsp;
                    <div class="col-md-3">
                        <div class="form-group ">
                            <strong>Working Status</strong>
                            <select id="working_status" class=" browser-default form-control" name="working_status">
                                <option value="" {{$working_status == "" ? 'selected':''}}>All</option>
                                <option value="Stuck" {{$working_status == "Stuck" ? 'selected':''}}>Stuck</option>
                                <option value="Cancel" {{$working_status == "Cancel" ? 'selected':''}}>Cancel</option>
                                <option value="Completed" {{$working_status == "Completed" ? 'selected':''}}>Completed</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group ">
                            <strong>Created Branch</strong>
                            <select id="branch_status" name="branch_status" class=" browser-default form-control">
                                <option value="" {{$branch_status == "" ? 'selected':''}}>All</option>
                                @foreach($branches as $branch )
                                <option value="{{$branch->id}}" {{$branch_status == "$branch->id" ? 'selected':''}}>{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group ">
                            <br>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>


    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">

                <table id="zero_config" class="table rwd-table table table-striped table table-hover table table-striped table-bordered no-wrap fixed table table-striped table-bordered no-wrap fixed">
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>mobile</th>
                        <th>Created Branch</th>
                        <th>Paid Amount</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($completedOrders as $completedOrder)
                    <tr>
                        <td data-th="Order">{{$completedOrder->serial_number}}</td>
                        <td data-th="Customer">{{$completedOrder->customer_name}}</td>
                        <td data-th="mobile">{{$completedOrder->mobile}}</td>
                        <td data-th="Created Branch">{{$completedOrder->branchName}}</td>
                        <td data-th="Paid Amount">{{$completedOrder->paid_amount}}</td>
                        <td data-th="Actions"><button type="button" class="btn btn-primary view_button" data_id="{{$completedOrder->Oid}}">View</button>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <br>
                <div class="float-right">{!!$completedOrders->appends(request()->query()) !!}</div>
            </div>
        </div>
    </div>
</div>

<!-- create modal  -->
<div id="viewModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <span class="close" id="close" align="right" style="cursor:pointer" onclick="$('#viewModal').modal('hide') ;$('.modelView').val('') ">&times;</span>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">

                            <div class="col-md-3">
                                <label>Item</label>
                                <div class="form-group">
                                    <input id="Item" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Weight</label>
                                <div class="form-group">
                                    <input id="weight" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label> Total Amount</label>
                                <div class="form-group">
                                    <input id="total_amount" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label> Created User</label>
                                <div class="form-group">
                                    <input id="created_user_name" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                <label>Payment Mode</label>
                                <div class="form-group">
                                    <input id="payment_mode" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Created Date</label>
                                <div class="form-group">
                                    <input id="created_date" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Due Date</label>
                                <div class="form-group">
                                    <input id="due_date" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>address</label>
                                <div class="form-group">
                                    <input id="address" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                <label>Request Branch Name</label>
                                <div class="form-group">
                                    <input id="request_branch_name" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Approved Branch Name</label>
                                <div class="form-group">
                                    <input id="approved_branch_name" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Requested User</label>
                                <div class="form-group">
                                    <input id="requested_user_name" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Approved User</label>
                                <div class="form-group">
                                    <input id="approved_user_name" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <label>Request Date</label>
                                <div class="form-group">
                                    <input id="requested_date" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Approved Date</label>
                                <div class="form-group">
                                    <input id="approved_date" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Completed Date</label>
                                <div class="form-group">
                                    <input id="completed_date" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#heading').html('Completed Orders')
        $(".view_button").click(function() {

            order_id = $(this).attr('data_id');
            $.ajax({
                method: "get",
                url: "/viewOrder",
                data: {
                    order_id: order_id,
                },
                success: function(result) {
                    $('#viewModal').modal('show')
                    var result = $.parseJSON(result);
                    $('#Item').val(result.Item);
                    $('#weight').val(result.weight);
                    $('#total_amount').val(result.total_amount);
                    $('#payment_mode').val(result.payment_mode);
                    $('#created_date').val(result.created_date);
                    $('#due_date').val(result.due_date);
                    $('#created_user_name').val(result.created_user_name);
                    $('#address').val(result.address);
                    $('#request_branch_name').val(result.requested_branch_name);
                    $('#approved_branch_name').val(result.approved_branch_name);
                    $('#locationStatus').val(result.location_status);
                    $('#completed_date').val(result.updated_at);
                    $('#requested_user_name').val(result.requested_user_name);
                    $('#approved_user_name').val(result.approved_user_name);
                    $('#requested_date').val(result.requested_date);
                    $('#approved_date').val(result.approved_date);

                }
            });
        });
    });
</script>
@endsection