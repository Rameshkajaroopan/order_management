@extends('layouts.app')

@section('content')

<style>

.rwd-table {
    margin: auto;
    min-width: 300px;
    max-width: 100%;
    border-collapse: collapse;
  }

  .custom-txt-right{
      text-align: right !important;
  }
  
  .rwd-table tr:first-child {
    border-top: none;
    color: #495057;
    
  }

  .rwd-table td{
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

    .rwd-table td:nth-of-type(1){
        background-color:#495057 ;
        color:white;
        display: grid;
    }

    .rwd-table td:nth-of-type(1):before { content: "" !important;}

    .custom-txt-right{
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

                <table id="zero_config" class="table rwd-table table table-striped table table-hover table table-striped table-bordered no-wrap fixed table table-striped table-bordered no-wrap fixed">
                    <tr>
                    <th >ID</th>

                        <th >First Name</th>
                        <th >Last Name</th>
                        <th >User Name</th>
                        <th >Email</th>
                        <th >Phone</th>
                        <th >Branch</th>



                        <th >Actions</th>
                    </tr>
                    @foreach($users as $user)
                    <tr>
                    <td data-th="First Name">{{$user->id}}</td>

                    <td data-th="First Name">{{$user->first_name}}</td>
                        <td data-th="Last Name">{{$user->last_name}}</td>
                        <td data-th="User Name">{{$user->user_name}}</td>
                        <td data-th="Email">{{$user->email}}</td>
                        <td data-th="Phone">{{$user->mobile}}</td>

                       
                        <td data-th="Branch">{{$user->branch->name}}</td>

                        <td data-th="Actions"><button  type="button" class="btn btn-primary view_button" data_id="{{$user->id}}" >View</button>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
</div>

<!-- create modal  -->
<div id="viewModal" class="modal  fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
        <form action="{{route('user.update')}}" method="post" >
            @csrf
            <span class="close" id="close" align="right" style="cursor:pointer" onclick="$('#viewModal').modal('hide') ;$('.modelView').val('') ">&times;</span>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">

                            <div class="col-md-3">
                                <label>Id</label>
                                <div class="form-group">
                                    <input id="Id" type="text" class="form-control modelView" value="" disabled />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>User Name</label>
                                <div class="form-group">
                                    <input id="user_name" type="text" class="form-control modelView" value=""  />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label> First Name</label>
                                <div class="form-group">
                                    <input id="first_name" type="text" class="form-control modelView" value=""  />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label> Last Name</label>
                                <div class="form-group">
                                    <input id="last_name"  type="text" class="form-control modelView" value=""  />
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                <label>Email</label>
                                <div class="form-group">
                                    <input id="email" type="text" class="form-control modelView" value=""  />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Phone</label>
                                <div class="form-group">
                                    <input id="phone" type="text" class="form-control modelView" value=""  />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Branch</label>
                                <div class="form-group">
                              <select id="branch" class="form-control modelView">
                            @foreach($branches as $branch )
                            <option value="{{$branch->id}}" {{$branch->id == "$user->branch->id" ? 'selected':''}}>{{$branch->name}}</option>
                            @endforeach
                        </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Password</label>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control modelView" />
                                </div>
                            </div>

                        </div>

                        <button  class="btn btn-light float-right ml-2" type="submit">Update</button>
                        <button  type="button" class="btn btn-primary float-right view_button" onclick="$('#viewModal').modal('hide') ;$('.modelView').val('') ">Cancel</button>


                    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    
        $(".view_button").click(function() {
           
            user_id =  $(this).attr('data_id');
            $.ajax({
                method: "get",
                url: "/viewUser",
                data: {
                    id: user_id,
                },
                success: function(result) {
                    var result = $.parseJSON(result);
                    console.log(result);
                    $('#Id').val(result.id);
                    $('#user_name').val(result.user_name);
                    $('#first_name').val(result.first_name);
                    $('#email').val(result.email);
                    $('#phone').val(result.mobile);
                    $('#branch').val(result.branch_id);
                    $('#last_name').val(result.last_name);
                    $('#password').val("password");
                    $('#viewModal').modal('show')
                }
            });
        });
    });
</script>
@endsection