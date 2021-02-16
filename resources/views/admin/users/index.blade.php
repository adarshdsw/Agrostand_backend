@extends('admin/default')

@section('button')
<!-- <a type="button" href="{{ route('admin.banner.create') }}" class="btn btn-sm btn-outline-primary ml-3 pr-3 pl-3 add-programme">Add Banner</a> -->
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
										<th>Role</th>
										<th>Verified</th>
										<th>Assured</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="banner_panel">

									@php
									$counter = 1;
									@endphp
									@foreach($users as $user)
									<tr>
										<td>{{ $counter }}</td>
										<td><img src="{{ $user->user_image }}" alt="{{ $user->name }}" width="75" height="75"></td>
										<td>{{ $user->category_id }}</td>
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->mobile }}</td>
										<td><?= ($user->role_id == 1) ? "<span class='badge bg-success'>Former</span>" : ( ($user->role_id == 2) ? "<span class='badge bg-default'>Business</span>" : "<span class='badge bg-info'>Agronomist</span>") ; ?></td>
										<td><input type="checkbox" name="is_verified" id="is_verified" value="1" onchange="changeUserVerification(this)" data-user_id="{{ $user->id }}" {{ ($user->is_verified == 1) ? "checked" : "" }}  ></td>
										<td>
											<select name="assured_id" id="assured_id" onchange="changeUserAssures(this)" data-user_id="{{ $user->id }}">
												<option {{ ($user->assured_id == 1) ? "selected" : "" }} value="1">Bronze</option>
												<option {{ ($user->assured_id == 2) ? "selected" : "" }} value="2">Sliver</option>
												<option {{ ($user->assured_id == 3) ? "selected" : "" }} value="3">Gold</option>
												<option {{ ($user->assured_id == 4) ? "selected" : "" }} value="4">Platinum</option>
											</select>
										</td>
										<td><?= ($user->status == 0) ? "<span class='badge bg-danger'>Inactive</span>" : "<span class='badge bg-success'>Active</span>"; ?></td>
										<td>
											<a class="btn btn-xs btn-info" href="{{ route('admin.users.show', $user) }}" role="button" title="View"><i class="fas fa-eye"></i></a>
											<!-- <a class="btn btn-xs btn-success" href="{{ route('admin.users.edit', $user) }}" role="button" title="Edit"><i class="fas fa-pencil-alt"></i></a> -->
											<!-- <a class="btn btn-xs btn-danger ajax-delete" href="{{ route('admin.users.destroy', $user) }}" role="button" title="Danger" data-user_id="{{$user->id}}" ><i class="fas fa-trash"></i></a> -->
										</td>
									</tr>
									@php
									$counter++;
									@endphp
									@endforeach
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
	       $('.my-datatable').DataTable({
	               "paging": true,
	               "lengthChange": false,
	               "searching": false,
	               "ordering": true,
	               "info": true,
	               "autoWidth": true,
	               "scrollX": true,
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

</script>
	@endsection