@extends('admin/default')

@section('button')
   <a type="button" href="{{ route('admin.scheme.create') }}" class="btn btn-sm btn-outline-primary ml-3 pr-3 pl-3 add-scheme">Add Scheme</a>
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

        					<div class="col-md-5">
        						<div class="form-group d-flex align-items-center">
        							<label for="title" class="col-form-label mr-3">Title</label>
        							<input type="text" class="form-control" id="title" name="title" placeholder="Search Title">
        						</div>
        					</div>
        					<div class="col-md-5">
        						<div class="form-group d-flex align-items-center">
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
					<table class="table table-hover text-nowrap my-datatable" id="scheme-table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Image</th>
								<th>Title</th>
								<th>Title Hindi</th>
								<th>Scheme date</th>
								<th>Status</th>
								<th>Created At</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="scheme_panel">

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

@section('js')>
<script>

	$(function() {
        var table = $('#scheme-table').DataTable({
			            processing	: true,
			            serverSide	: true,
						scrollX		: true,
						autoWidth	: false,
			            ajax: {
				            url: base_url+'/admin/scheme-data',
				            method: 'POST',
				            data: function (d) {
				                d.title  = $('input[name=title]').val();
				                d.status = $('#status :selected').val();
				            }
				        },
				        columns: [
				            {data: 'id', 			name: 'id'},
				            {data: 'feature_img', 	name: 'feature_img'},
				            {data: 'title', 		name: 'title'},
				            {data: 'title_hindi', 	name: 'title_hindi'},
				            {data: 'scheme_date', 	name: 'scheme_date'},
				            {data: 'status', 		name: 'status'},
				            {data: 'created_at', 	name: 'created_at'},
				            {data: 'action', 		name: 'action', orderable: false, searchable: false}
				        ]
			        });

        $('#search-form').on('submit', function(e) {
	        table.draw();
	        e.preventDefault();
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
		$('#scheme_panel').on('click', 'td a.ajax-edit', function (event) {
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

</script>
@endsection