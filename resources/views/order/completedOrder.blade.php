@extends('layouts.app')

@section('content')
<!-- <div class="row">
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

                <div class="col-md-3">
                    <div class="form-group">
                        <strong>From</strong>
                        <input type="date" name="from" id="from" value="{{$from}}" class="form-control" required >
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>To</strong>
                        <input type="date" name="to" id="to" value="{{$to}}" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group ">
                    <strong>Created Branch</strong>
                        <select id="branch_status"  name="branch_status"  class=" browser-default form-control" >
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

                <table id="zero_config" class="table table-striped table-bordered no-wrap fixed">
                    <tr>
                        <th width="100px">Order</th>
                        <th width="100px">Customer</th>
                        <th width="100px">mobile</th>
                        <th width="100px">Created Branch</th>
                        <th width="100px">Paid Amount</th>
                        <th width="100px">Actions</th>
                    </tr>
                    @foreach($pendingOrders as $pendingOrder)
                    <tr>
                        <td>{{$pendingOrder->serial_number}}</td>
                        <td>{{$pendingOrder->customer_name}}</td>
                        <td>{{$pendingOrder->mobile}}</td>
                        <td>{{$pendingOrder->branchName}}</td>
                        <td>{{$pendingOrder->paid_amount}}</td>
                        <td><button  type="button" class="btn btn-primary view_button" data_id="{{$pendingOrder->Oid}}" >View</button>
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
                                <label> Created  User</label>
                                <div class="form-group">
                                    <input id="created_user_name"  type="text" class="form-control modelView" value="" disabled />
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
    
        $(".view_button").click(function() {
           
            order_id =  $(this).attr('data_id');
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
    });
</script>
@endsection