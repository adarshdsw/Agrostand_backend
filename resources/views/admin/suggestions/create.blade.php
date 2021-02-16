<div class="row">
	<div class="col-12">

		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" method="post" action="{{ route('admin.suggestions.store') }}" id="add_new">
			@csrf
			<div class="card-body">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}">
				</div>
				<div class="form-group">
					<label for="title_hindi">Title Hindi</label>
					<input type="text" class="form-control" id="title_hindi" name="title_hindi" placeholder="Enter Hindi title" value="{{ old('title_hindi') }}">
				</div>
				<div class="form-group">
					<label for="type">Type</label>
					<select class="form-control" id="type" name="type">
						<option value=""> --select type-- </option>
						<option value="1"> Sell </option>
						<option value="2"> Buy </option>
						<option value="3"> Other </option>
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