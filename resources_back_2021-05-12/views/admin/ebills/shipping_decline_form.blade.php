<div class="row">
	<div class="col-12">
		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" method="post" action="{{ route('admin.ebill.shipping.decline_save') }}" id="add_new">
			@csrf
			<input type="hidden" name="ebill_id" value="{{ $ebill_shipping->ebill_id }}">
			<input type="hidden" name="shipping_id" value="{{ $ebill_shipping->id }}">
			<div class="card-body">
				<div class="form-group">
	                <label>Decline Reason</label>
	                <input class="form-control" type="text" name="decline_reason" id="decline_reason" value="" placeholder="type decline reason" required >
                </div>
			</div>
			<!-- /.card-body -->
		</form>
	</div>
</div>