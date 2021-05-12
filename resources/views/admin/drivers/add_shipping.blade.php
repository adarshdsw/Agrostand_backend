<div class="row">
	<div class="col-12">

		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" method="post" action="{{ route('admin.driver.shipping.store') }}" id="add_new">
			@csrf
			<div class="card-body">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
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