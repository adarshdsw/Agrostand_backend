<div class="row">
	<div class="col-12">
		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" method="post" action="{{ route('admin.ebill.shipping.accept_save') }}" id="add_new">
			@csrf
			<input type="hidden" name="ebill_id" value="{{ $ebill_shipping->ebill_id }}">
			<input type="hidden" name="shipping_id" value="{{ $ebill_shipping->id }}">
			<div class="card-body">
				<div class="form-group">
	                <label>Shipping Charge</label>
	                <input class="form-control" type="number" name="shipping_charge" id="shipping_charge" value="" placeholder="Please Enter Shipping Charge" required >
                </div>
				<div class="form-group">
	                <label>Shipping Description</label>
	                <textarea class="form-control" id="shipping_description" name="shipping_description" placeholder="type shipping description"></textarea>
                </div>
			</div>
			<!-- /.card-body -->
		</form>
	</div>
</div>