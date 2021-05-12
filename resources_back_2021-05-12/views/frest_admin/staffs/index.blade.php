@extends('admin.layout')

@section('css')
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
@endsection

@section('main')
<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div>
            <h4 class="card-title">Staff Tables</h4>
        </div>
        <div class="float-right">
            <a href="{{route('admin.staffs.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> Add</a>
        </div>
      </div>
      <div class="card-content">
        <div class="card-body">
          <!-- Table with outer spacing -->
          <div class="table-responsive">
            <table class="table" id="my_datatable">
              <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Image</th>
                  <th>Staff ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Department</th>
                  <th>Status</th>
                  <th>ACTION</th>
                </tr>
              </thead>
              <tbody id="pannel">
                @php $counter = 1; @endphp
                @foreach($staffs as $staff)
                    <tr>
                        <td>{{ $counter }}</td>
                        <!-- <td><img width="100px" height="100px" src="{{ $staff->profile_image }}" alt="profile image" ></td> -->
                        <td><div class="avatar mr-1 avatar-lg">
                          <img src="{{ ($staff->profile_image) ? asset('user_media').'/'.$staff->profile_image : asset('frest/images/portrait/small/avatar-s-20.jpg')}}" alt="avtar img holder">
                        </div></td>
                        <td>{{ $staff->staff_id }}</td>
                        <td>{{ $staff->first_name }}</td>
                        <td>{{ $staff->last_name }}</td>
                        <td>{{ $staff->email }}</td>
                        <td>{{ $staff->mobile }}</td>
                        <td>{{ $staff->department->name }}</td>
                        <td>
                            <div class="custom-control custom-switch custom-control-inline mb-1">
                              <input type="checkbox" class="custom-control-input change_status" id="customSwitch{{ $staff->id }}" {{ ($staff->status == 1) ? 'checked' : '' }} >
                              <label class="custom-control-label mr-1" for="customSwitch{{ $staff->id }}">
                              </label>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.staffs.show', [$staff->id]) }}" role="button" title="@lang('View')"><i class="bx bx-show-alt font-medium-1 default"></i></a>
                            <a href="{{ route('admin.staffs.edit', [$staff->id]) }}" role="button" title="@lang('Edit')"><i class="bx bx-pencil font-medium-1"></i></a>
                            <a class="staff-trash" href="{{ route('admin.staffs.destroy', [$staff->id]) }}" role="button" title="@lang('Destroy')"><i class="bx bx-trash font-medium-1 danger"></i></a>
                        </td>
                    </tr>
                @php $counter++; @endphp
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- /.row -->

@endsection

    

@section('js')
    <script src="{{ asset('js/back.js') }}"></script>
    <script>

        var department = (function () {

            var onReady = function () {
                $('#pannel').on('click', 'td a.staff-trash', function (event) {
                    var that = $(this)
                    event.preventDefault()

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!",
                        confirmButtonClass: "btn btn-primary",
                        cancelButtonClass: "btn btn-danger ml-1",
                        buttonsStyling: !1,
                    }).then(function (t) {
                      if(t.value){
                        $.ajax({
                          url: that.attr('href'),
                          type: 'DELETE',
                          success : function(res){
                            if(res != 'false'){
                              Swal.fire({ type: "success", title: "Deleted!", text: "Your file has been deleted.", confirmButtonClass: "btn btn-success" });
                              that.parents('tr').remove();
                            }else{
                              Swal.fire({ title: "Error", text: "Something went wrong :)", type: "error", confirmButtonClass: "btn btn-danger" });
                            }
                          },
                          fail : function(error){
                            console.log(error)
                          }
                        })    
                      }else{
                        Swal.fire({ title: "Cancelled", text: "Your imaginary file is safe :)", type: "error", confirmButtonClass: "btn btn-success" });
                      }
                    });
                })
            }

            return {
                onReady: onReady
            }

        })()

        $(document).ready(department.onReady)

      $(document).ready(function () {
        $("#my_datatable").DataTable();
        $(document).on('change', '.change_status', function(){
          var status_val = '';
          if ($(this).is(':checked')) {
            status_val = 1;
          }else{
            status_val = 0;
          }
          var url = "{{ route('admin.staff.status_update', [$staff->id]) }}";
          $.ajax({
            url: that.attr('href'),
            type: 'POST',
            success : function(res){
              toastr.success("Success", "Status Updated successfully!");
            },
            fail : function(error){
              toastr.danger("Failed", "Failed");
            }
          })
        });
      });
    </script>
@endsection