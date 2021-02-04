@extends('admin.layout')

@section('main')
<section id="basic-input">
  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div><h4 class="card-title">Add Staff</h4></div>
                <div class="float-right">
                  <a href="{{route('admin.staffs.index')}}" class="btn btn-sm btn-primary">Back</a>
                </div>
            </div>
            <div class="card-content">
              <form method="post" action="{{ route('admin.staffs.store') }}" id="add-staff-form">
                <div class="card-body">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Departments</h6>
                        <fieldset class="form-group">
                          <select class="form-control" id="department_id" name="department_id">
                            <option value=""> Select Any Option </option>
                            @if($departments)
                              @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                              @endforeach
                            @endif
                          </select>
                        </fieldset>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-6">
                            <fieldset class="form-group">
                              <label for="profile_image">Profile Image</label>
                              <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                            </fieldset>
                          </div>
                          <div class="col-md-6">
                            <div class="avatar mr-1 avatar-xl">
                              <img id="user_profile_preview" src="{{ asset('frest/images/portrait/small/avatar-s-20.jpg')}}" alt="avtar img holder">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="first_name">First Name</label><span class="text-error">&#42;</span>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="last_name">Last Name</label><span class="text-error">&#42;</span>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="email">Email</label><span class="text-error">&#42;</span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="mobile">Mobile</label><span class="text-error">&#42;</span>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile">
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="password">Password</label><span class="text-error">&#42;</span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="conf_password">Confirm Password</label><span class="text-error">&#42;</span>
                                <input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="Enter Confirm Password">
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset class="form-group">
                                <label for="address">Address</label><span class="text-error">&#42;</span>
                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Type Address" style="margin-top: 0px; margin-bottom: 0px; height: 92px;"></textarea>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Status</h6>
                        <fieldset class="form-group">
                          <select class="form-control" id="status" name="status">
                            <option value="1"> Active </option>
                            <option value="0"> Inactive </option>
                          </select>
                        </fieldset>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="d-flex p-2 float-right">
                          <button class="btn btn-primary" type="submit" id="submit" name="submit" value="add" >Add</button>&nbsp;
                          <button class="btn btn-danger" type="reset">Reset</button>
                        </div>
                      </div>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
  </div>
</section>
@endsection

@section('js')
<script src="{{ asset('js/back.js') }}"></script>
<script>
    $(document).ready(function(){
      /*$.each($('.text-danger'), function(error_value){
        console.log($(this).prev().val()); return false;
      });*/
      $('#add-staff-form').submit(function(event){
        event.preventDefault();
        var that = $(this)[0];
        var url = "{{ route('admin.staffs.store') }}";
        var formData = new FormData(that);
        $.ajax({
          url: url,
          type: 'POST',
          dataType: 'JSON',
          cache: false,
          processData: false,
          contentType: false,
          data: formData,
          beforeSend: function() {
            // $('#submit').attr('disabled', true);
            // $('#submit').text('redirecting...');
          },
          success : function(res){
            toastr.success("Success", "Staff Added successfully!");
            // $('#submit').attr('disabled', false);
            // $('#submit').text('Submit');
            setTimeout(function(){
              location.reload();
              // window.location.href = "{{route('admin.departments.index')}}";
            },3000);
          },
          error : function(data){
            if( data.status === 422 ) {
              var obj = $.parseJSON(data.responseText);
              // $('#submit').attr('disabled', false);
              // $('#submit').text('Submit');
              $.each(obj.errors, function( index, value ) {
                console.log( index + ": " + value );
                if(index){
                  toastr.error(value);
                  return false;
                }
              });
            }
          }
        });
      });
    });
</script>
<script type="text/javascript">
  $("#profile_image").change(function() {
    readURL(this);
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#user_profile_preview').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  // toastr.success("Have fun storming the castle!", "Miracle Max Says");
</script>
@endsection