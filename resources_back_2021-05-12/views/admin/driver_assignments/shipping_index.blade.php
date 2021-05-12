@extends('admin/default')

@section('css')
<style type="text/css">
	
	.form-inline .form-control {
	    width: 100%;
	}
</style>
@endsection

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
				<!-- Alert Box Start -->
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
				<!-- Alert Box End -->
				<!-- filter form start -->
        		<div class="card card-info">
        			<!-- /.card-header -->
        			<!-- form start -->
        			<div class="card-body">
        				<form method="POST" action="{{ route('admin.driver_shipping-store') }}" id="driver_shipping-form" class="form-inline" role="form">
	        					<div class="col-md-4">
	        						<div class="form-group">
	        							<label class="col-form-label mr-3">Select Driver</label>
	        							<select class="form-control" id="driver_id" name="driver_id" required>
	        								<option value="">Select Any</option>
	        								@foreach($drivers as $driver)
		        								<option value="{{ $driver->id }}">{{ $driver->name }}</option>
	        								@endforeach
	        							</select>
	        						</div>
	        					</div>
        					<!-- /.card-body -->
        					<div class="col-md-2">
        						<div class="card-footer p-0 mt-3">
        							<button type="submit" class="btn btn-info w-100">Assign</button>
        						</div>
        					</div>

        					<!-- /.card-footer -->
        				</form>
        			</div>
        		</div>
        		<!-- filter form end -->
				<!-- filter form start -->
        		<div class="card card-info">
        			<!-- /.card-header -->
        			<!-- form start -->
        			<div class="card-body">
        				<form method="POST" id="search-form" class="form-inline" role="form">
        					<!-- search by order id -->
        					<div class="col-md-4">
        						<div class="form-group d-flex align-items-center">
        							<label for="order_id" class="col-form-label mr-3">Order Id</label>
        							<input type="text" class="form-control" id="order_id" name="order_id" placeholder="Search Order">
        						</div>
        					</div>
        					<!-- search by receiver name -->
        					<div class="col-md-4">
        						<div class="form-group d-flex align-items-center">
        							<label for="bill_number" class="col-form-label mr-3">Bill Number</label>
        							<input type="text" class="form-control" id="bill_number" name="bill_number" placeholder="Search Bill Number">
        						</div>
        					</div>

        					<div class="col-md-4">
        						<div class="form-group">
        							<label class="col-form-label mr-3">Payment Mode</label>
        							<select class="form-control" id="payment_mode">
        								<option value="">Select Any</option>
        								<option value="1">COD</option>
        								<option value="2">Pre Paid</option>
        								<option value="3">AgroPay</option>
        							</select>
        						</div>
        					</div>

        					<div class="col-md-4">
	        					<div class="form-group">
	        						<label class="col-form-label mr-3">Date</label>
	        						<div class="input-group date" id="reservationdate" data-target-input="nearest">
	        							<input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="pickup_date_time">
	        							<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
	        								<div class="input-group-text"><i class="fa fa-calendar"></i></div>
	        							</div>
	        						</div>
	        					</div>
        					</div>

        					<!-- /.card-body -->
        					<div class="col-md-2">
        						<div class="card-footer p-0 mt-3">
        							<button type="submit" class="btn btn-info w-100">Search</button>
        						</div>
        					</div>

        					<!-- /.card-footer -->
        				</form>
        			</div>
        			<div class="card-body">
        				<table class="table table-hover text-nowrap my-datatable" id="ebill_shipping-table">
							<thead>
								<tr>
									<th style="width: 10px">#</th>
									<th>Order Id</th>
									<th>Bill Number</th>
									<th>Payment Mode</th>
									<th>PickUp Address</th>
									<th>PickUp Date</th>
									<th>Drop Address</th>
									<th>PickUp Date</th>
									<th>Shipping Distance</th>
									<th>Shipping Status</th>
									<th>Created At</th>
									<th><input type="checkbox" id="all_shipping" name="all_shipping" value="" onclick="checkedAllCheckboxVerticale('all_shipping', 'view_')"> </th>
								</tr>
							</thead>
							<tbody id="ebill_panel">
								
							</tbody>
						</table>
        			</div>
        		</div>
        		<!-- filter form end -->
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

				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });

				var table = $('#ebill_shipping-table').DataTable({
					processing	: true,
					serverSide	: true,
					scrollX		: true,
					autoWidth	: false,
					searching	: false,
					ajax: {
						url: base_url+'/admin/driver_shipping-data',
						method: 'POST',
						data: function (d) {
							d.order_id  		= $('input[name=order_id]').val();
							d.bill_number  		= $('input[name=bill_number]').val();
							d.pickup_date_time  		= $('input[name=pickup_date_time]').val();
							d.payment_mode 		= $('#payment_mode :selected').val();
						}
					},
					columns: [
						{data: 'id', 				name: 'id'},
						{data: 'ebill.order_id', 	name: 'ebill.order_id'},
						{data: 'ebill.bill_number', name: 'ebill.bill_number', width:'10%'},
						{data: 'payment_mode', 		name: 'payment_mode'},
						{data: 'pickup_address', 	name: 'pickup_address'},
						{data: 'pickup_date_time', 	name: 'pickup_date_time'},
						{data: 'drop_address', 		name: 'drop_address'},
						{data: 'drop_date_time', 	name: 'drop_date_time'},
						{data: 'shipping_distance', name: 'shipping_distance'},
						{data: 'shipping_status', 	name: 'shipping_status'},
						{data: 'created_at', 		name: 'created_at'},
						{data: 'action', 			name: 'action', orderable: false, searchable: false}
					]
				});

				$('#search-form').on('submit', function(e) {
					table.draw();
					e.preventDefault();
				});

				// Select Date picker
			    $('#reservationdate').datetimepicker({
			        format: 'YYYY-MM-DD'
			    });

			    $('#driver_shipping-form').on('submit', function(e){
			    	e.preventDefault();
			   		var url = $(this).attr('action');
			   		var driver_id 	= $('#driver_id :selected').val();
			   		var shipping_data = [];
			   		$('.shipping_checkbox').each(function(){
			   			if ($(this).is(':checked')) {
			   				shipping_data.push($(this).val());
			   			}
			   		});
			        $.ajax({
			        	type:'POST',
			        	url:url,
			        	data:{driver_id:driver_id, shipping_ides:shipping_data},
			        	success:function(data){
			        		data.forEach(function(index, value){
			        			if(value.status == true){
			        				toastr.success("Success", 'Driver Assignment has been complete for a shipping');
			        				location.reload();
			        			}else{
			        				toastr.danger('Driver Assignment has been failed');
			        				location.reload();
			        			}
			        		});
			        	}
			        });
			    });

			});

			var slider = (function () {

				var url = "{{url('/')}}"+"/admin/sliders/";

				var swalTitleDecline = 'Really Decline this ?';
				var swalTitleAccept = 'Really Accept this ?';
				var confirmButtonText = 'Yes';
				var cancelButtonText = 'No';
				var errorAjax = "Something went wrong";
				var title = "Add New";
				var onReady = function () {
					$('#ebill_panel').on('click', 'td a.ajax-edit', function (event) {
						event.preventDefault();
						var that  = $(this);
						var url   = that.attr('href');
						var title = "Programme Edit";
						sbm.loadMultiPartForm(url, $(this), errorAjax, title);
					})
					.on('click', 'td a.ajax-view', function (event) {
						event.preventDefault();
						var that  = $(this);

						var url   = that.attr('href');
						var title = "Programme View";
						sbm.loadView(title, event, $(this), url)
					})
					.on('click', 'td a.ajax-decline', function (event) {
						event.preventDefault();
						var url   = $(this).attr('href');
						// sbm.decline(event, $(this), url, swalTitleDecline, confirmButtonText, cancelButtonText, errorAjax)
						sbm.loadHtml(url, $(this), errorAjax, 'Decline this Shipping?');
					})
					.on('click', 'td a.ajax-accept', function (event) {
						event.preventDefault();
						var url   = $(this).attr('href');
						// sbm.accept(event, $(this), url, swalTitleAccept, confirmButtonText, cancelButtonText, errorAjax)
						sbm.loadHtml(url, $(this), errorAjax, 'Accept this shipping?');
					});

					$(document).on('click', '.add-driver', function (event) {
						event.preventDefault();
						var url   = $(this).attr('href');
						sbm.loadHtml(url, $(this), errorAjax, title);
					});
				}

				return {
					onReady: onReady
				}

			})()

			$(document).ready(slider.onReady)

			function checkedAllCheckboxVerticale(main_tab, sub_tab)
			{
				if(document.getElementById(main_tab).checked)
				{
					$(".shipping_checkbox").each(function($e) {
						var obj = $(this);
						console.log($(this).attr('id'));
						document.getElementById($(this).attr('id')).checked = true;
					});
				}
				else
				{
					$(".shipping_checkbox").each(function($e) {
						var obj = $(this);
						console.log($(this).attr('id'));
						document.getElementById($(this).attr('id')).checked = false;
					});
				}
			}

		</script>
	@endsection