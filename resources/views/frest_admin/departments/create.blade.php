@extends('admin.layout')

@section('main')
    	<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-3"></div>
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Add Department</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
    			<form method="post" action="{{ route('admin.departments.store') }}" id="add-department-form">
    				{{ csrf_field() }}
              <div class="form-body">
                <div class="row">
                  <div class="col-md-4">
                    <label>Name</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter Name">
                    @error('name')
				             <p class="text-danger">{{ $message }}</p>
      					    @enderror
                    <p id="name" class="text-danger"></p>
                  </div>
                        <div class="col-md-4">
                            <label>Slug</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <input type="text" id="slug" class="form-control" name="slug" placeholder="type Slug">
                  @error('slug')
        					 <p class="text-danger">{{ $message }}</p>
        					@enderror
                  <p id="slug" class="text-danger"></p>
                  </div>
                  <div class="col-sm-12 d-flex justify-content-end">
                    <input type="submit" name="submit" id="submit" class="btn btn-primary mr-1 mb-1" value="Submit">
                    <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
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
      $('#add-department-form').submit(function(event){
        event.preventDefault();
        var that = $(this)[0];
        var url = "{{ route('admin.departments.store') }}";
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
            $('#submit').attr('disabled', true);
            $('#submit').val('redirecting...');
          },
          success : function(res){
            toastr.success("Success", "Department Added successfully!");
            $('#submit').attr('disabled', false);
            $('#submit').val('Submit');
            setTimeout(function(){
              location.reload();
              // window.location.href = "{{route('admin.departments.index')}}";
            },3000);
          },
          error : function(data){
            if( data.status === 422 ) {
              var obj = $.parseJSON(data.responseText);
              $('#submit').attr('disabled', false);
              $('#submit').val('Submit');
              if(obj.errors.name != undefined){
                toastr.error(obj.errors.name);
                return false;
              }
              if(obj.errors.slug != undefined){
                toastr.error(obj.errors.slug);
                return false;
              }
              toastr.error(obj.message);
            }
            
          }
        });
      });
    });
</script>
@endsection