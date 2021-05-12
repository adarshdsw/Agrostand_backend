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
		
		body{margin-top:20px;}
		.timeline {
		    border-left: 3px solid #727cf5;
		    border-bottom-right-radius: 4px;
		    border-top-right-radius: 4px;
		    background: rgba(114, 124, 245, 0.09);
		    margin: 0 auto;
		    letter-spacing: 0.2px;
		    position: relative;
		    line-height: 1.4em;
		    font-size: 1.03em;
		    padding: 50px;
		    list-style: none;
		    text-align: left;
		    max-width: 40%;
		}

		@media (max-width: 767px) {
		    .timeline {
		        max-width: 98%;
		        padding: 25px;
		    }
		}

		.timeline h1 {
		    font-weight: 300;
		    font-size: 1.4em;
		}

		.timeline h2,
		.timeline h3 {
		    font-weight: 600;
		    font-size: 1rem;
		    margin-bottom: 10px;
		}

		.timeline .event {
		    border-bottom: 1px dashed #e8ebf1;
		    padding-bottom: 25px;
		    margin-bottom: 25px;
		    position: relative;
		}

		@media (max-width: 767px) {
		    .timeline .event {
		        padding-top: 30px;
		    }
		}

		.timeline .event:last-of-type {
		    padding-bottom: 0;
		    margin-bottom: 0;
		    border: none;
		}

		.timeline .event:before,
		.timeline .event:after {
		    position: absolute;
		    display: block;
		    top: 0;
		}

		.timeline .event:before {
		    left: -207px;
		    content: attr(data-date);
		    text-align: right;
		    font-weight: 100;
		    font-size: 0.9em;
		    min-width: 120px;
		}

		@media (max-width: 767px) {
		    .timeline .event:before {
		        left: 0px;
		        text-align: left;
		    }
		}

		.timeline .event:after {
		    -webkit-box-shadow: 0 0 0 3px #727cf5;
		    box-shadow: 0 0 0 3px #727cf5;
		    left: -55.8px;
		    background: #fff;
		    border-radius: 50%;
		    height: 9px;
		    width: 9px;
		    content: "";
		    top: 5px;
		}

		@media (max-width: 767px) {
		    .timeline .event:after {
		        left: -31.8px;
		    }
		}

		.rtl .timeline {
		    border-left: 0;
		    text-align: right;
		    border-bottom-right-radius: 0;
		    border-top-right-radius: 0;
		    border-bottom-left-radius: 4px;
		    border-top-left-radius: 4px;
		    border-right: 3px solid #727cf5;
		}

		.rtl .timeline .event::before {
		    left: 0;
		    right: -170px;
		}

		.rtl .timeline .event::after {
		    left: 0;
		    right: -55.8px;
		}		
	</style>
@endsection

@section('content')
   <!-- Main content -->
   <section class="content">
	  <div class="container-fluid">
		<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-md-12">
					<div class="invoice p-3 mb-3">
						<!-- title row -->
						<div class="row">
							<div class="col-12">
								<h4>
									<i class="fas fa-globe"></i> AgroStand, Inc.
									<small class="float-right">Date: {{ date('d-m-Y', strtotime($ebill->bill_date)) }}</small>
								</h4>
							</div>
							<!-- /.col -->
						</div>
						<!-- info row -->
						<div class="row invoice-info">
							<div class="col-sm-4 invoice-col">
								From
								<address>
									<strong>{{ $ebill->user->name }}</strong><br>
									{{ $ebill->ship_to }} <br>
									Phone: {{ $ebill->user->mobile }}<br>
									Email: {{ $ebill->user->email }}
								</address>
							</div>
							<!-- /.col -->
							<div class="col-sm-4 invoice-col">
								To
								<address>
									<strong>{{ $ebill->vendor->name }}</strong><br>
									{{ $ebill->bill_to }} <br>
									Phone: {{ $ebill->vendor->mobile }}<br>
									Email: {{ $ebill->vendor->email }}
								</address>
							</div>
							<!-- /.col -->
							<div class="col-sm-4 invoice-col">
								<b>Bill Number #{{ $ebill->bill_number }}</b><br>
								<br>
								<b>Order ID:</b> {{ $ebill->order_id }}<br>
								<b>Due Date:</b> {{ date('d-m-Y', strtotime($ebill->due_date)) }}<br>
								<!-- <b>Account:</b> 968-34567 -->
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
						@if(count($ebill->products) > 0)
						<!-- Table row -->
						<div class="row">
							<div class="col-12 table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Image</th>
											<th>Qty</th>
											<th>Product</th>
											<th>Volume</th>
											<th>Unit</th>
											<th>Rate</th>
											<!-- <th>Description</th> -->
											<th>Tax</th>
											<th>Subtotal</th>
											<th>view</th>
										</tr>
									</thead>
									<tbody>
										@foreach($ebill->products as $product)
											<tr>
												<td><img src="{{ $product->product_image }}" width="50" height="50"></td>
												<td>{{ $product->packet_number }}</td>
												<td>{{ $product->product_name }}</td>
												<td>{{ $product->total_volume }}</td>
												<td>{{ $product->volume_unit }}</td>
												<td>{{ $product->product_rate }}</td>
												<td>{{ $product->product_tax }}</td>
												<td>{{ $product->subtotal }}</td>
												<td><a class="btn btn-xs btn-info" href="javascript:;" role="button" title="View"><i class="fas fa-eye"></i></a></td>
											</tr>
										@endforeach
										<!-- <tr>
											<td>1</td>
											<td>Call of Duty</td>
											<td>455-981-221</td>
											<td>El snort testosterone trophy driving gloves handsome</td>
											<td>$64.50</td>
											<td><a class="btn btn-xs btn-info" href="javascript:;" role="button" title="View"><i class="fas fa-eye"></i></a></td>
										</tr> -->
									</tbody>
								</table>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
						@endif

						<div class="row">
							<div class="col-6">
								<p class="lead">Specification:</p>
								<p>{{ $ebill->specification }}</p>
							</div>
							@if($ebill->shipping)
								<div class="col-6">
									<p class="lead"> Shipping Details:</p>
									<!-- Shipping Details -->
									<div class="row">
										<div class="col-12">
											<!-- Shipping Type Transport -->
											@if($ebill->shipping->shipping_type == '1')
											<div class="form-group row">
												<label for="transport_name" class="col-sm-4 col-form-label">Transport Type : </label>
												<div class="col-sm-8">
													<p>Public Transport</p>
												</div>
											</div>
											<div class="form-group row">
												<label for="transport_name" class="col-sm-4 col-form-label">Transport Name : </label>
												<div class="col-sm-8">
													<p>{{ $ebill->shipping->transport_name }}</p>
												</div>
											</div>
											<div class="form-group row">
												<label for="bill_number" class="col-sm-4 col-form-label">Bill Number : </label>
												<div class="col-sm-8">
													<p>{{ $ebill->shipping->bill_number }}</p>
												</div>
											</div>
											<div class="form-group row">
												<label for="bill_receipt_img" class="col-sm-4 col-form-label">Receipt Image : </label>
												<div class="col-sm-8">
													<img src="{{ $ebill->shipping->bill_receipt_img }}" height="75" width="75">
												</div>
											</div>
											@endif
											<!-- Shipping type courier -->
											@if($ebill->shipping->shipping_type == '2')
												<div class="form-group row">
													<label for="transport_name" class="col-sm-4 col-form-label">Transport Type : </label>
													<div class="col-sm-8">
														<p>Courier</p>
													</div>
												</div>
												<div class="form-group row">
													<label for="courier_name" class="col-sm-4 col-form-label">Courier Name : </label>
													<div class="col-sm-8">
														<p>{{ $ebill->shipping->courier_name }}</p>
													</div>
												</div>
												<div class="form-group row">
													<label for="tracking_number" class="col-sm-4 col-form-label">Tracking Number : </label>
													<div class="col-sm-8">
														<p>{{ $ebill->shipping->tracking_number }}</p>
													</div>
												</div>
												<div class="form-group row">
													<label for="courier_receipt_img" class="col-sm-4 col-form-label">Receipt Image : </label>
													<div class="col-sm-8">
														<img src="{{ $ebill->shipping->courier_receipt_img }}" height="75" width="75">
													</div>
												</div>
											@endif
											<!-- Shipping Type Local Driver -->
											@if($ebill->shipping->shipping_type == '3')
													<div class="form-group row">
														<label for="transport_name" class="col-sm-4 col-form-label">Transport Type : </label>
														<div class="col-sm-8">
															<p>Local Driver</p>
														</div>
													</div>
													<div class="form-group row">
														<label for="lt_driver_name" class="col-sm-4 col-form-label">Driver Name : </label>
														<div class="col-sm-8">
															<p>{{ $ebill->shipping->lt_driver_name }}</p>
														</div>
													</div>
													<div class="form-group row">
														<label for="lt_driver_mobile" class="col-sm-4 col-form-label">Mobile Number : </label>
														<div class="col-sm-8">
															<p>{{ $ebill->shipping->lt_driver_mobile }}</p>
														</div>
													</div>
													<div class="form-group row">
														<label for="lt_driver_img" class="col-sm-4 col-form-label">Driver Image : </label>
														<div class="col-sm-8">
															<img src="{{ $ebill->shipping->lt_driver_img }}" height="75" width="75">
														</div>
													</div>
													<div class="form-group row">
														<label for="lt_loading_vehcile_img" class="col-sm-4 col-form-label">Loading Image : </label>
														<div class="col-sm-8">
															<img src="{{ $ebill->shipping->lt_loading_vehcile_img }}" height="75" width="75">
														</div>
													</div>
													<div class="form-group row">
														<label for="lt_driver_identity" class="col-sm-4 col-form-label">Driver Identity : </label>
														<div class="col-sm-8">
															<p>{{ $ebill->shipping->lt_driver_identity }}</p>
														</div>
													</div>
													<div class="form-group row">
														<label for="lt_driver_identity_img" class="col-sm-4 col-form-label">id Card Image : </label>
														<div class="col-sm-8">
															<img src="{{ $ebill->shipping->lt_driver_identity_img }}" height="75" width="75">
														</div>
													</div>
											@endif
											@if($ebill->shipping->shipping_type == '4')
												<div class="form-group row">
														<label for="transport_name" class="col-sm-4 col-form-label">Transport Type : </label>
														<div class="col-sm-8">
															<p>Agro Service</p>
														</div>
													</div>
													<div class="form-group row">
														<label for="pickup_date_time" class="col-sm-4 col-form-label">Pickup date/time : </label>
														<div class="col-sm-8">
															<p>{{ $ebill->shipping->pickup_date_time }}</p>
														</div>
													</div>
													<div class="form-group row">
														<label for="pickup_address" class="col-sm-4 col-form-label">Pickup Address : </label>
														<div class="col-sm-8">
															<p>{{ $ebill->shipping->pickup_address }}</p>
														</div>
													</div>
													<div class="form-group row">
														<label for="drop_date_time" class="col-sm-4 col-form-label">Drop date/time : </label>
														<div class="col-sm-8">
															<p>{{ $ebill->shipping->drop_date_time }}</p>
														</div>
													</div>
													<div class="form-group row">
														<label for="drop_address" class="col-sm-4 col-form-label">Drop Address : </label>
														<div class="col-sm-8">
															<p>{{ $ebill->shipping->drop_address }}</p>
														</div>
													</div>
											@endif
										</div>
									</div>
								</div>
							@endif
						</div>

						<div class="row">
							<!-- accepted payments column -->
							<div class="col-6">
								<p class="lead">Other Expenses</p>

								<div class="table-responsive">
									<table class="table">
										<tbody><tr>
											<th style="width:50%">Shipping Charge:</th>
											<td>{{ $ebill->expenses->shipping_charge }}</td>
										</tr>
										<tr>
											<th>Bank Charge</th>
											<td>{{ $ebill->expenses->bank_charge }}</td>
										</tr>
										<tr>
											<th>Mandi Tax:</th>
											<td>{{ $ebill->expenses->mandi_tax }}</td>
										</tr>
										<tr>
											<th>Other Expense:</th>
											<td>{{ $ebill->expenses->other_expense }}</td>
										</tr>
									</tbody></table>
								</div>
							</div>
							<!-- /.col -->
							<div class="col-6">
								<!-- <p class="lead">Amount Due {{ $ebill->due_amount }}</p> -->

								<div class="table-responsive">
									<table class="table">
										<tbody>
										<tr>
											<th>Advance Amount</th>
											<td>{{ $ebill->advance_amount }}</td>
										</tr>
										<tr>
											<th>Due Amount:</th>
											<td>{{ $ebill->due_amount }}</td>
										</tr>
										<tr>
											<th>Total:</th>
											<td>{{ $ebill->total_amount }}</td>
										</tr>
									</tbody></table>
								</div>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->

						<!-- this row will not appear when printing -->
						<!-- <div class="row no-print">
							<div class="col-12">
								<a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
								<button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
									Payment
								</button>
								<button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
									<i class="fas fa-download"></i> Generate PDF
								</button>
							</div>
						</div> -->
					</div>
					<!-- /.card -->
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
	CKEDITOR.replace( 'description' );
	CKEDITOR.replace( 'description_hindi' );
	// toastr.success("Have fun storming the castle!", "Miracle Max Says");
</script>
@endsection