@extends('admin/default')

@section('css')
<style type="text/css">
	.form-inline .form-control {
	    width: 100%;
	}
</style>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				@if (session('success'))
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-check"></i> Success!</h5>
					<p> {{ session('success') }} </p>
				</div>
				@endif
				@if (session('fail'))
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-check"></i> Danger!</h5>
					<p> {{ session('fail') }} </p>
				</div>
				@endif
				<!-- filter form start -->
        		<div class="card card-info">
        			<div class="card-header">
        				<h3 class="card-title">Filter Form</h3>
        			</div>
        			<!-- /.card-header -->
        			<!-- form start -->
        			<div class="card-body">
        				<form method="POST" id="search-form" class="form-inline" role="form">
        					<!-- Category id -->
        					<div class="col-md-4">
        						<div class="form-group d-flex align-items-center">
        							<label class="mr-3">Category</label>
        							<select class="form-control" id="category_id">
        								<option value="">Select Any</option>
        								@foreach($categories as $category)
        									<option value="{{ $category->id }}">{{ $category->title }}</option>
        								@endforeach
        							</select>
        						</div>
        					</div>
        					<!-- Assured id -->
        					<div class="col-md-4">
        						<div class="form-group d-flex align-items-center">
        							<label class="mr-3">Assured</label>
        							<select class="form-control" id="assured_id">
        								<option value="">Select Any</option>
        								@foreach($assures as $assure)
        									<option value="{{ $assure->id }}">{{ $assure->title }}</option>
        								@endforeach
        							</select>
        						</div>
        					</div>
        					<!-- Role id -->
        					<div class="col-md-4">
        						<div class="form-group d-flex align-items-center">
        							<label class="mr-3">Role</label>
        							<select class="form-control" id="role_id">
        								<option value="">Select Any</option>
        								@foreach($roles as $role)
        									<option value="{{ $role->id }}">{{ $role->title }}</option>
        								@endforeach
        							</select>
        						</div>
        					</div>
        					<!-- search by name -->
        					<div class="col-md-4">
        						<div class="form-group d-flex align-items-center">
        							<label for="name" class="col-form-label mr-3">User Name</label>
        							<input type="text" class="form-control" id="name" name="name" placeholder="Search Title">
        						</div>
        					</div>
        					<!-- search by mobile -->
        					<div class="col-md-4">
        						<div class="form-group d-flex align-items-center">
        							<label for="mobile" class="col-form-label mr-3">User Mobile</label>
        							<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Search Mobile">
        						</div>
        					</div>
        					<!-- Filter by is verfied or not -->
        					<div class="col-md-4">
        						<div class="form-group">
        							<label class="mr-3">Is Verified</label>
        							<select class="form-control" id="is_verified">
        								<option value="">Select Any</option>
        								<option value="1">Yes</option>
        								<option value="0">No</option>
        							</select>
        						</div>
        					</div>
        					<div class="col-md-4">
        						<div class="form-group">
        							<label class="mr-3">Status</label>
        							<select class="form-control" id="status">
        								<option value="">Select Any</option>
        								<option value="1">Active</option>
        								<option value="0">Inactive</option>
        							</select>
        						</div>
        					</div>

        					<!-- /.card-body -->
        					<div class="col-md-2">
        						<div class="card-footer p-0">
        							<button type="submit" class="btn btn-info w-100">Search</button>
        						</div>
        					</div>

        					<!-- /.card-footer -->
        				</form>
        			</div>
        		</div>
        		<!-- filter form end -->
				<div class="card card-primary card-outline card-outline-tabs">
					<div class="card-body">
						<table class="table table-hover text-nowrap my-datatable" id="users-table">
								<thead>
									<tr>
										<th>ID</th>
										<th>Image</th>
										<th>Category</th>
										<th>Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Unique ID</th>
										<th>Role</th>
										<th>Verified</th>
										<th>Assured</th>
										<th>Total Reffered</th>
										<th>Status</th>
										<th>Created At</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="banner_panel">

								</tbody>
							</table>
						</div>
						<!-- /.card -->
					</div>
				</div>            
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
	@endsection

	@section('js')
<script>

	$(function () {

		var table = $('#users-table').DataTable({
			            processing	: true,
			            serverSide	: true,
						scrollX		: true,
			            ajax: {
				            url: base_url+'/admin/users-data',
				            method: 'POST',
				            data: function (d) {
				                d.category_id 	= $('#category_id :selected').val();
				                d.assured_id 	= $('#assured_id :selected').val();
				                d.role_id 		= $('#role_id :selected').val();
				                d.name  		= $('input[name=name]').val();
				                d.mobile  		= $('input[name=mobile]').val();
				                d.status 		= $('#status :selected').val();
				                d.is_verified 	= $('#is_verified :selected').val();
				            }
				        },
				        columns: [
						    {data: 'id', 				name: 'users.id'},
						    {data: 'user_image', 		name: 'users.user_image'},
						    {data: 'category.title', 	name: 'category.title'},
						    {data: 'name', 				name: 'users.name'},
						    {data: 'email', 			name: 'users.email'},
						    {data: 'mobile', 			name: 'users.mobile'},
						    {data: 'user_code', 		name: 'users.user_code'},
						    {data: 'role.title', 		name: 'role.title'},
						    {data: 'verify', 			name: 'users.verify'},
						    {data: 'select_assured', 	name: 'select_assured'},
						    {data: 'total_referred', 	name: 'total_referred'},
						    {data: 'status', 			name: 'users.status'},
						    {data: 'created_at', 		name: 'users.created_at'},
						    {data: 'action', 			name: 'action', orderable: false, searchable: false}
						]
			        });

        $('#search-form').on('submit', function(e) {
	        table.draw();
	        e.preventDefault();
	    });

	       $(document).on('change', '.update_status', function(){
	       		if ($(this).prop('checked')==true){
					var data = {"user_id" : $(this).data('user_id'), 'user_status':'1' };
			    }else{
					var data = {"user_id" : $(this).data('user_id'), 'user_status':'0' };
			    }
			    // console.log(data); return false;
				var url = "{{ route('admin.user.status_update_new') }}";
				$.ajax({
					url : url,
					type : 'GET',
					data : data,
					success: function(result){
						console.log(result);
						alert('User status update Successfully');
						
					}
				});
	       });
	 });

	var slider = (function () {

       var url = "{{url('/')}}"+"/admin/sliders/";

       var swalTitle = 'Really destroy this ?';
       var confirmButtonText = 'Yes';
       var cancelButtonText = 'No';
       var errorAjax = "Something went wrong";
       var title = "Add New";
       var onReady = function () {
               $('#banner_panel').on('click', 'td a.ajax-edit', function (event) {
                       event.preventDefault();
                       var that  = $(this);
                       var url   = that.attr('href');
                       var title = "Programme Edit";
                       sbm.loadMultiPartForm(url, $(this), errorAjax, title);
               })
               .on('click', 'td a.ajax-view', function (event) {
                       event.preventDefault();
                       var that  = $(this);
                       // console.log(that); return false;

                       var url   = that.attr('href');
                       var title = "Programme View";
                       sbm.loadView(title, event, $(this), url)
               })
               .on('click', 'td a.ajax-delete', function (event) {
                       event.preventDefault();
                       var url   = $(this).attr('href');
                       // console.log(url); return false;
                       sbm.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
               });
       

               // add new Slider
               $(document).on('click', '.add-slider', function () {
                       var my_url = url + 'create';
                       sbm.loadMultiPartForm(my_url, $(this), errorAjax, title);
               });
       }

		return {
		    onReady: onReady
		}

	})()

	$(document).ready(slider.onReady)

function changeUserAssures(obj){
	var assure = $(obj);
	var optionSelected = $("option:selected", assure);
	var data = {"user_id" : assure.data('user_id'), 'assured_id':optionSelected.val() };
	var url = "{{ route('admin.user.assure') }}";
	$.ajax({
		url : url,
		type : 'GET',
		data : data,
		success: function(result){
			console.log(result);
			alert('User Assurity Change Successfully');
			
		}
	});
}
function changeUserVerification(obj){
	var verify = $(obj);
	var $boxes = $('input[name=is_verified]:checked');
	if($boxes.length > 0){
		var data = {"user_id" : verify.data('user_id'), 'verify_value':1 };
	}else{
		var data = {"user_id" : verify.data('user_id'), 'verify_value':0 };
	}
	var url = "{{ route('admin.user.verify') }}";
	$.ajax({
		url : url,
		type : 'GET',
		data : data,
		success: function(result){
			console.log(result);
			alert('User verification update Successfully');
			
		}
	});
}
// change User Status
function changeUserStatus(obj){
	var user_status = $(obj);
	console.log(user_status); return false;
	var $boxes = $('input[name=is_active]:checked');
	console.log($boxes); return false;
	if($boxes.length > 0){
		var data = {"user_id" : user_status.data('user_id'), 'user_status':'1' };
	}else{
		var data = {"user_id" : user_status.data('user_id'), 'user_status':'0' };
	}
	var url = "{{ route('admin.user.status_update_new') }}";
	$.ajax({
		url : url,
		type : 'GET',
		data : data,
		success: function(result){
			console.log(result);
			alert('User status update Successfully');
			
		}
	});
}

</script>
	@endsection