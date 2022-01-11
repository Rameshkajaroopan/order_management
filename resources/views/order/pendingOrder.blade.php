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
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <strong>Created Branch</strong>
                        <select id="branch_status" class=" browser-default form-control" onchange="window.location.assign('/pendingOrder?branch_status=' + $('#branch_status').val() + '&&location_status=' + $('#location_status').val())">
                            <option value="" {{$branch_status == "" ? 'selected':''}}>All</option>
                            @foreach($branches as $branch )
                            <option value="{{$branch->id}}" {{$branch_status == "$branch->id" ? 'selected':''}}>{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <strong>Working Status</strong>
                        <select id="location_status" class=" browser-default form-control" onchange="window.location.assign('/pendingOrder?branch_status=' + $('#branch_status').val() + '&&location_status=' + $('#location_status').val())">
                            <option value="" {{$location_status == "" ? 'selected':''}}>All</option>
                            <option value="NotStart" {{$location_status == "NotStart" ? 'selected':''}}>Not Start</option>
                            <option value="InProgress" {{$location_status == "InProgress" ? 'selected':''}}>In Progress</option>
                            <!-- <option value="Stuck" {{$location_status == "Stuck" ? 'selected':''}}>Stuck</option> -->

                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">

                <table id="zero_config" class="table rwd-table table table-striped table table-hover table table-striped table-bordered no-wrap fixed">
                    <tr>
                        <th class="">Order</th>
                        <th class="">Customer</th>
                        <th class="">mobile</th>
                        <th class="">Created Branch</th>
                        <th class="">Paid Amount</th>
                        <th class="">Change Status</th>
                        <th class="">Actions</th>
                    </tr>
                    @foreach($pendingOrders as $pendingOrder)
                    <tr>
                        <td data-th="Order">{{$pendingOrder->serial_number}}</td>
                        <td data-th="Customer">{{$pendingOrder->customer_name}}</td>
                        <td data-th="mobile">{{$pendingOrder->mobile}}</td>
                        <td data-th="Created Branch">{{$pendingOrder->branchName}}</td>
                        <td data-th="Paid Amount">{{$pendingOrder->paid_amount}}</td>
                        <td data-th="Change Status">
                            <select id="working_status" data-id="{{$pendingOrder->Oid}}" class=" browser-default form-control working_status">
                                <option value="NotStart" {{$pendingOrder->working_status == "NotStart" ? 'selected':''}}>Not Start</option>
                                <option value="InProgress" {{$pendingOrder->working_status == "InProgress" ? 'selected':''}}>In Progress</option>
                                <option value="Stuck" {{$pendingOrder->working_status == "Stuck" ? 'selected':''}}>Stuck</option>
                                <option value="Completed" {{$pendingOrder->working_status == "Completed" ? 'selected':''}}>Completed</option>

                            </select>
                        </td>
                        <td data-th="Actions">
                            <button type="button" class="btn btn-primary view_button" data_id="{{$pendingOrder->Oid}}">View</button>
                        </td>
                    </tr>
                    @endforeach
                </table>
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

                            <div class="col-md-4">
                                <label>Approved Branch Name</label>
                                <div class="form-group">
                                    <input id="approved_branch_name" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Location Status</label>
                                <div class="form-group">
                                    <input id="locationStatus" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Request Status</label>
                                <div class="form-group">
                                    <input id="request_status" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                        </div>

                        <div class="row">

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

                            <div class="col-md-3">
                                <label>Request Date</label>
                                <div class="form-group">
                                    <input id="requested_date" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Approved Date</label>
                                <div class="form-group">
                                    <input id="approved_date" type="text" class="form-control modelView" value="" disabled />
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
        console.log('hi');

        $(".view_button").click(function() {

            order_id = $(this).attr('data_id');
            $.ajax({
                method: "get",
                url: "/viewOrder",
                data: {
                    order_id: order_id,
                },
                success: function(result) {
                    var result = $.parseJSON(result);
                    $('#Item').val(result.Item);
                    $('#weight').val(result.weight);
                    $('#total_amount').val(result.total_amount);
                    $('#payment_mode').val(result.payment_mode);
                    $('#created_date').val(result.created_date);
                    $('#due_date').val(result.due_date);
                    $('#created_user_name').val(result.created_user_name);
                    $('#address').val(result.address);
                    $('#approved_branch_name').val(result.approved_branch_name);
                    $('#locationStatus').val(result.location_status);
                    $('#request_status').val(result.request_status);
                    $('#requested_user_name').val(result.requested_user_name);
                    $('#approved_user_name').val(result.approved_user_name);
                    $('#requested_date').val(result.requested_date);
                    $('#approved_date').val(result.approved_date);
                    $('#viewModal').modal('show')
                }
            });
        });

        $(".working_status").on('change', function() {

            var order_id = $(this).attr('data-id');
            var working_status = $(this).val();
            console.log(order_id);
            if (working_status == "Completed" || working_status == "Stuck") {
                var result = confirm("Do you want to change status");

                if (result) {
                    $.ajax({
                        method: "get",
                        url: "/changeWorking",
                        data: {
                            order_id: order_id,
                            working_status: working_status,
                        },
                        success: function(result) {
                            console.log(result);
                            location.reload();
                        }

                    });
                } else {
                    location.reload();
                }
            } else {
                $.ajax({
                    method: "get",
                    url: "/changeWorking",
                    data: {
                        order_id: order_id,
                        working_status: working_status,
                    },
                    success: function(result) {
                        console.log(result);
                        location.reload();
                    }

                });
            }
        });
    });
</script>
@endsection