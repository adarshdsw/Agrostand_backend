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
            <h4 class="card-title">Department Tables</h4>
        </div>
        <div class="float-right">
            <a href="{{route('admin.departments.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> Add</a>
        </div>
      </div>
      <div class="card-content">
        <div class="card-body">
          <!-- Table with outer spacing -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>NAME</th>
                  <th>SLUG</th>
                  <th>TOTAL</th>
                  <th>ACTION</th>
                </tr>
              </thead>
              <tbody id="pannel">
                @foreach($departments as $department)
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->slug }}</td>
                        <td>{{ ($department->posts_count) ? $department->posts_count : 0 }}</td>
                        <td><a href="{{ route('admin.departments.edit', [$department->id]) }}" role="button" title="@lang('Edit')"><i class="bx bx-pencil font-medium-1"></i></a>
                            <a class="department-trash" href="{{ route('admin.departments.destroy', [$department->id]) }}" role="button" title="@lang('Destroy')"><i class="bx bx-trash font-medium-1 danger"></i></a>
                        </td>
                    </tr>
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
                $('#pannel').on('click', 'td a.department-trash', function (event) {
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

    </script>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> <link rel="stylesheet" href="node_modules/sweetalert/dist/sweetalert.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script type="text/javascript">
    @if (session('success'))
        toastr.success("{{session('success')}}");
    @endif
    // toastr.success("Have fun storming the castle!", "Miracle Max Says");
  </script>

@endsection