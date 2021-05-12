@extends('admin/default')

@section('css')
	<style type="text/css">
		.error{
			color: red;
		}
		.label-container label.label {
		    width: 97%;
		    margin-bottom: 0;
		}
		.label-container button.btn.btn-sm.btn-outline-danger.delete_row {
		    width: 3%;
		    padding: 3px;
		}
		.label-container {
		    margin: 10px 0;
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
					<div class="card card-primary card-outline card-outline-tabs">
							<!-- /.card-header -->
							<!-- form start -->
							<div class="card-body">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<img src="{{ $driver->profile_image }}" alt="{{ $driver->name }}" width="150" height="150" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="name">Name</label>
											<input disabled type="text" class="form-control" id="name" name="name" value="{{ isset($driver) ? $driver->name : '' }}">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="mobile">Mobile</label>
											<input disabled type="text" class="form-control" id="mobile" name="mobile" value="{{ isset($driver) ? $driver->mobile : '' }}">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="password">Password</label>
											<input disabled type="text" class="form-control" id="conf_password" name="conf_password" value="{{ isset($driver) ? $driver->conf_password : '' }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="driver_type">Type</label>
											<input disabled type="text" class="form-control" id="driver_type" name="driver_type" value="{{ ($driver->driver_type == 1) ? 'Non Agro' : 'Agro' }}">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="driver_status">Status</label>
											<input disabled type="text" class="form-control" id="driver_status" name="driver_status" value="{{ ($driver->status == 1) ? 'Non Agro' : 'Agro' }}">
										</div>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
					</div>
					<div class="card card-primary card-outline card-outline-tabs">
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
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="ebill_panel">
								@php
									$counter = 1;
								@endphp
									@foreach($ebill_shippings as $ebill_shipping)
										<tr>
											<td>{{ $counter }}</td>
											<td>{{ $ebill_shipping->ebill->order_id }}</td>
											<td>{{ $ebill_shipping->ebill->bill_number }}</td>
											<td> <?= ($ebill_shipping->payment_mode == '1' ) ? "<span class='badge bg-warning'>Cod</span>" : ( ($ebill_shipping->payment_mode == '2') ? "<span class='badge bg-success'>Paid</span>" : "<span class='badge bg-danger'>AgroPay</span>") ?> </td>
											<td> {{ $ebill_shipping->pickup_address }} </td>
											<td> {{ $ebill_shipping->pickup_date_time }} </td>
											<td> {{ $ebill_shipping->pickup_address }} </td>
											<td> {{ $ebill_shipping->drop_date_time }} </td>
											<td> {{ $ebill_shipping->shipping_distance }} </td>
											<td><?= ($ebill_shipping->shipping_status == 0) ? "<span class='badge bg-warning'>Pending</span>" : ( ($ebill_shipping->shipping_status == 1) ? "<span class='badge bg-success'>Accept</span>" : "<span class='badge bg-danger'>Decline</span>") ; ?></td>
											<td> {{ $ebill_shipping->created_at }} </td>
											<td><a class="btn btn-xs btn-danger ajax-delete" href="{{ route('admin.drivers.delete_ebill', $ebill_shipping) }}" role="button" title="Delete" data-menu_id="{{$ebill_shipping->id}}"><i class="fas fa-trash-alt"></i></a></td>
										</tr>
									@php
										$counter++;
									@endphp
									@endforeach
							</tbody>
						</table>
        			</div>
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
<script type="text/javascript">
	$(function () {
		$('.my-datatable').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"responsive": false,
			"scrollX":true,
		});
	});
	   var menu = (function () {

      var url = ''
      var swalTitle = 'Really destroy this ?';
      var confirmButtonText = 'Yes';
      var cancelButtonText = 'No';
      var errorAjax = "Something went wrong";
      var title = "Add New";

      var onReady = function () {
         $('#driver_panel').on('change', ':checkbox[name="status"]', function () {
            back.status(url, $(this), errorAjax)
         })
         .on('click', 'td a.ajax-edit', function (event) { // when edit buttton click
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Commodity Edit";
            sbm.loadMultiPartForm(url, $(this), errorAjax, title);
         })
         .on('click', 'td a.ajax-view', function (event) {
            event.preventDefault();
            var that  = $(this);
            var url   = that.attr('href');
            var title = "Commodity View";
            sbm.loadMultiPartForm(title, event, $(this), url)
         })
         .on('click', 'td a.ajax-delete', function (event) {
            event.preventDefault();
            var url   = $(this).attr('href');
            sbm.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
         });
         // add new commodity
         $(document).on('click', '.add-driver', function () {
            var url = '{{ route("admin.drivers.create") }}';
            sbm.loadMultiPartForm(url, $(this), errorAjax, title);
         });
      }

      return {
         onReady: onReady
      }

  })()

  $(document).ready(menu.onReady)
</script>
@endsection