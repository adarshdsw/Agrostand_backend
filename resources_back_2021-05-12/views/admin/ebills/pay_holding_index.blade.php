@extends('admin/default')

@section('css')
<style type="text/css">
	table th {
    	width: auto !important;
	}
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
        					<!-- search by bill number -->
        					<div class="col-md-4">
        						<div class="form-group d-flex align-items-center">
        							<label for="sender_name" class="col-form-label mr-3">Sender Name</label>
        							<input type="text" class="form-control" id="sender_name" name="sender_name" placeholder="Search Sender Name">
        						</div>
        					</div>
        					<!-- search by sender name -->
        					<div class="col-md-4">
        						<div class="form-group d-flex align-items-center">
        							<label for="receiver_name" class="col-form-label mr-3">Receiver Name</label>
        							<input type="text" class="form-control" id="receiver_name" name="receiver_name" placeholder="Search Receiver Name">
        						</div>
        					</div>
        					<!-- Filter by is verfied or not -->
        					<div class="col-md-4">
        						<div class="form-group">
        							<label class="col-form-label mr-3">RFP Status</label>
        							<select class="form-control" id="rfp_status">
        								<option value="">Select Any</option>
        								<option value="0">Pending</option>
        								<option value="1">Accept</option>
        								<option value="2">Decline</option>
        							</select>
        						</div>
        					</div>
        					<div class="col-md-4">
        						<div class="form-group">
        							<label class="col-form-label mr-3">Shipping Status</label>
        							<select class="form-control" id="shipping_status">
        								<option value="">Select Any</option>
        								<option value="0">Pending</option>
        								<option value="1">Accept</option>
        								<option value="2">Decline</option>
        							</select>
        						</div>
        					</div>

        					<div class="col-md-4">
        						<div class="form-group">
        							<label class="col-form-label mr-3">Payment Status</label>
        							<select class="form-control" id="payment_status">
        								<option value="">Select Any</option>
        								@foreach($payment_status as $pstatus)
        									<option value="{{ $pstatus['key'] }}">{{ $pstatus['value'] }}</option>
        								@endforeach
        							</select>
        						</div>
        					</div>
        					<div class="col-md-4">
        						<div class="form-group">
        							<label class="col-form-label mr-3">Is Delivered</label>
        							<select class="form-control" id="is_delivered">
        								<option value="">Select Any</option>
        								<option value="0">No</option>
        								<option value="1">Yes</option>
        							</select>
        						</div>
        					</div>

        					<!-- /.card-body -->
        					<div class="col-md-2">
        						<div class="card-footer p-0 mt-3">
        							<button type="submit" class="btn btn-info w-100 mt-3">Search</button>
        						</div>
        					</div>

        					<!-- /.card-footer -->
        				</form>
        			</div>
        		</div>
        		<!-- filter form end -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Holding payment by Admin</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table class="table table-hover text-nowrap my-datatable" id="pay_holding-table">
							<thead>
								<tr>
									<th style="width: 10px">#</th>
									<th>Order Id</th>
									<th>Bill Number</th>
									<th>Sender</th>
									<th>Receiver</th>
									<th>Bill Date</th>
									<th>Due Date</th>
									<th>Total Amount</th>
									<th>RFP Status</th>
									<th>Shipping Status</th>
									<th>Payment Status</th>
									<th>is delivered</th>
									<th>Created At</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="ebill_panel">
								
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
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

				var table = $('#pay_holding-table').DataTable({
					processing	: true,
					serverSide	: true,
					scrollX		: true,
					ajax: {
						url: base_url+'/admin/pay_holding-data',
						method: 'POST',
						data: function (d) {
							d.order_id  		= $('input[name=order_id]').val();
							d.bill_number  		= $('input[name=bill_number]').val();
							d.sender_name  		= $('input[name=sender_name]').val();
							d.receiver_name		= $('input[name=receiver_name]').val();
							d.rfp_status 		= $('#rfp_status :selected').val();
							d.shipping_status 	= $('#shipping_status :selected').val();
							d.payment_status 	= $('#payment_status :selected').val();
							d.is_delivered 		= $('#is_delivered :selected').val();
						}
					},
					columns: [
						{data: 'id', 				name: 'id'},
						{data: 'order_id', 			name: 'order_id'},
						{data: 'bill_number', 		name: 'bill_number', width:'10%'},
						{data: 'user.name', 		name: 'user.name'},
						{data: 'vendor.name', 		name: 'vendor.name'},
						{data: 'bill_date', 		name: 'bill_date'},
						{data: 'due_date', 			name: 'due_date'},
						{data: 'total_amount', 		name: 'total_amount'},
						{data: 'rfp_status', 		name: 'rfp_status'},
						{data: 'shipping_status', 	name: 'shipping_status'},
						{data: 'payment_status', 	name: 'payment_status'},
						{data: 'is_delivered', 		name: 'is_delivered'},
						{data: 'created_at', 		name: 'created_at'},
						{data: 'action', 			name: 'action', orderable: false, searchable: false}
					]
				});

				$('#search-form').on('submit', function(e) {
					table.draw();
					e.preventDefault();
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
						sbm.decline(event, $(this), url, swalTitleDecline, confirmButtonText, cancelButtonText, errorAjax)
					})
					.on('click', 'td a.ajax-accept', function (event) {
						event.preventDefault();
						var url   = $(this).attr('href');
						sbm.accept(event, $(this), url, swalTitleAccept, confirmButtonText, cancelButtonText, errorAjax)
					});



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