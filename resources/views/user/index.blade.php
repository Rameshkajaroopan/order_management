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
          <div class="col-sm-12">
            <button type="button" class="btn float-right btn-primary add_button " data_id=""> <i class="fas fa-user mr-2"></i> Add New User</button>

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

        <table id="zero_config" class="table rwd-table table table-striped table table-hover table table-striped table-bordered no-wrap fixed table table-striped table-bordered no-wrap fixed">
          <tr>
            <th>ID</th>

            <th>First Name</th>
            <th>Last Name</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Branch</th>
            <th>Role</th>



            <th>Actions</th>
          </tr>
          @foreach($users as $user)
          <tr id="{{$user->id}}">
            <td data-th="First Name">{{$user->id}}</td>

            <td data-th="First Name">{{$user->first_name}}</td>
            <td data-th="Last Name">{{$user->last_name}}</td>
            <td data-th="User Name">{{$user->user_name}}</td>
            <td data-th="Email">{{$user->email}}</td>
            <td data-th="Phone">{{$user->mobile}}</td>


            <td data-th="Branch">{{$user->name}}</td>
            <td data-th="Role">{{$user->role}}</td>


            <td data-th="Actions">
              <button type="button" class="btn btn-primary view_button" data_id="{{$user->id}}">Edit</button>
              <button type="button" class="btn btn-secondary deletebutton" data-id="{{$user->id}}">Delete</button>

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
      <form id="form" action="{{route('user.update')}}" method="post">
        @csrf
        <span class="close" id="close" align="right" style="cursor:pointer" onclick="$('#viewModal').modal('hide') ;$('.modelView').val('') ">&times;</span>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="row">

                <div class="col-md-3 ids">
                  <label>Id</label>
                  <div class="form-group">
                    <input id="Id" type="text" class="form-control modelView" value="" disabled />
                    <input id="Idvalue" name="id" type="text" class="form-control modelView" value="" hidden />

                  </div>
                </div>

                <div class="col-md-3">
                  <label>User Name</label>
                  <div class="form-group">
                    <input id="user_name" name="user_name" type="text" class="form-control modelView" value="" required />
                  </div>
                </div>

                <div class="col-md-3">
                  <label> First Name</label>
                  <div class="form-group">
                    <input id="first_name" name="first_name" type="text" class="form-control modelView" value="" required />
                  </div>
                </div>

                <div class="col-md-3">
                  <label> Last Name</label>
                  <div class="form-group">
                    <input id="last_name" name="last_name" type="text" class="form-control modelView" value="" required />
                  </div>
                </div>

              </div>

              <div class="row">

                <div class="col-md-3">
                  <label>Email</label>
                  <div class="form-group">
                    <input id="email" name="email" type="text" class="form-control modelView" value="" required />
                  </div>
                </div>

                <div class="col-md-3">
                  <label>Phone</label>
                  <div class="form-group">
                    <input id="phone" name="mobile" type="text" class="form-control modelView" value="" required />
                  </div>
                </div>

                <div class="col-md-3">
                  <label>Role</label>
                  <div class="form-group">
                    <select id="role" name="role" class="form-control modelView checkAdmin" selected="selected" required>
                      <option value="user">User</option>
                      <option value="super_user">Super User</option>
                      <option value="admin">Admin</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <label>Password</label>
                  <div class="form-group">
                    <input id="password" name="password" type="text" class="form-control modelView" required />
                  </div>
                </div>

                <div class="col-md-3 hideBranch">
                  <label>Branch</label>
                  <div class="form-group">
                    <select id="branch" name="branch_id" class="form-control modelView " required>
                    <option value="">Select</option>
                      @foreach($branches as $branch )
                      <option value="{{$branch->id}}" >{{$branch->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

              </div>

              <button id="submit_button" class="btn btn-light update float-right ml-2" type="submit">Update</button>
              <button type="button" class="btn btn-primary float-right view_button" onclick="$('#viewModal').modal('hide') ;$('.modelView').val('') ">Cancel</button>


            </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<script>
  $(document).ready(function() {
    $('#heading').html('Users')
    $(".add_button").click(function() {

      $('#Id').val('Auto')
      $('.update').text("Add User")
      $('#viewModal').modal('show')
      $('.modelView').val('');
      $('#form').attr('action', "/user");

      $('#submit_button').click(function() {
        console.log("submiting");
        $(this).submit();
      });

    });


    $(".view_button").click(function() {
      $('.update').text("Update")

      user_id = $(this).attr('data_id');
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
          $('#Idvalue').val(result.id);
          $('#user_name').val(result.user_name);
          $('#first_name').val(result.first_name);
          $('#email').val(result.email);
          $('#phone').val(result.mobile);
          $('#branch').val(result.branch_id);
          $('#last_name').val(result.last_name);
          $('#password').val(result.password);
          $('#role').val(result.role);

          $('#viewModal').modal('show')
        }
      });
    });


    $('.deletebutton').on('click', function() {

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#202326',
        cancelButtonColor: '#747474',
        confirmButtonText: 'Yes, Delete this User'
      }).then((result) => {
        if (result.isConfirmed) {
          $.post("{{ route('user.destroy') }}", {
            _token: "{{ csrf_token() }}",
            id: $(this).data('id'),
          }).done(function(data) {
            $('#' + data.id).addClass("bg-dark");
            $('#' + data.id).hide(1000, function() {
              this.remove();
            });
          });

        }
      })

    });

    $(".checkAdmin").on('change',function() {
      if($(this).val() == 'admin'){
        $('.hideBranch').val('');
        $('.hideBranch').hide();
        $('#branch').attr('required', false); 
        // $('.branch').removeAttr('required');​​​​​
      }else{
        $('.hideBranch').show();
        $('#branch').attr('required', true); 
      }
    });

  });
</script>
@endsection