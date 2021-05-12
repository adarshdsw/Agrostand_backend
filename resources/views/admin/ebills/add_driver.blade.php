<div class="row">
	<div class="col-12">

		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" method="post" action="{{ route('admin.shipping.driver.store') }}" id="add_new">
			@csrf
			<input type="hidden" name="ebill_id" value="{{ $ebill_shipping->ebill_id }}">
			<input type="hidden" name="shipping_id" value="{{ $ebill_shipping->id }}">
			<div class="card-body">
				<div class="form-group">
	                <label>Drivers</label>
	                <select class="form-control" id="driver_id" name="driver_id">
	                	<option value="">--select driver--</option>
	                	@foreach($drivers as $driver)
	                		<option {{ ($driver->id == $driver_id) ? "selected" : "" }} value="{{$driver->id}}">{{$driver->name}} ({{$driver->mobile}})</option>
	                	@endforeach
	                </select>
                </div>
			</div>
			<!-- /.card-body -->
		</form>
	</div>
</div>
@section('js')
<script src="{{ asset('plugins/voca/voca.min.js') }}"></script>
<script>

    $('#slug').keyup(function () {
        $(this).val(v.slugify($(this).val()))
    })

    $('#title').keyup(function () {
        $('#slug').val(v.slugify($(this).val()))
    })

</script>
@endsection