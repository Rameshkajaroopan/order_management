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
                    <button type="button" class="btn float-right btn-primary add_button " data_id=""> <i class="fas fa-clone mr-2"></i> Add New Branch</button>

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

            <th>Branch Name</th>
            



            <th>Actions</th>
          </tr>
          @foreach($branches as $branch)
          <tr id="{{$branch->id}}">
            <td data-th="First Name">{{$branch->id}}</td>

            <td data-th="First Name">{{$branch->name}}</td>
        
            <td data-th="Actions">
              <button type="button" class="btn btn-primary view_button" data_id="{{$branch->id}}">Edit</button>
              <button type="button" class="btn btn-secondary deletebutton" data-id="{{$branch->id}}">Delete</button>

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
      <form id="form" action="{{route('branch.update')}}" method="post">
        @csrf
        <span class="close" id="close" align="right" style="cursor:pointer" onclick="$('#viewModal').modal('hide') ;$('.modelView').val('') ">&times;</span>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="row">

                <div class="col-md-6 ids">
                  <label>Id</label>
                  <div class="form-group">
                    <input id="Id" type="text" class="form-control modelView" value="" disabled />
                    <input id="Idvalue" name="id" type="text" class="form-control modelView" value="" hidden  />

                  </div>
                </div>

                <div class="col-md-6">
                  <label>Branch Name</label>
                  <div class="form-group">
                    <input id="branch_name" name="name" type="text" class="form-control modelView" value="" required />
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

    $(".add_button").click(function() {

      $('#Id').val('Auto')
      $('.update').text("Add branch")
      $('#viewModal').modal('show')

      $('#form').attr('action', "/branch");

      $('#submit_button').click(function() {
        console.log("submiting");
$(this).submit();
      });

    });


    $(".view_button").click(function() {
        $('.update').text("Update")

      branch_id = $(this).attr('data_id');
      $.ajax({
        method: "get",
        url: "/viewBranch",
        data: {
          id: branch_id,
        },
        success: function(result) {
          var result = $.parseJSON(result);
          console.log(result);
          $('#Id').val(result.id);
          $('#branch_name').val(result.name);
          $('#Idvalue').val(result.id);
          
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
        confirmButtonText: 'Yes, Delete this branch'
      }).then((result) => {
        if (result.isConfirmed) {
          $.post("{{ route('branch.destroy') }}", {
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



  });
</script>
@endsection