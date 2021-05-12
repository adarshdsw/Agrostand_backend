<div class="row">
	<div class="col-12">

		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" method="post" action="{{ route('admin.drivers.store') }}" id="add_new">
			@csrf
			<div class="card-body">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
				</div>
				<div class="form-group">
					<label for="mobile">Mobile</label>
					<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Hindi title" value="{{ old('mobile') }}">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}">
				</div>
				<!-- upload the icon -->
				<div class="form-group">
					<label for="profile_image">Profile Image</label><span class="text-danger">&#42;</span>
					<div class="input-group">
						<div class="custom-file">
						<input type="file" class="custom-file-input" id="profile_image" name="profile_image">
							<label class="custom-file-label" for="profile_image">Choose file</label>
						</div>
					</div>
					<p class="text-muted ml-1 mt-50"><small>Allowed JPG, GIF or PNG. Max size of 800kB</small></p>
				</div>
				<div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="status" name="status" value="1">
                      <label class="custom-control-label" for="status">status</label>
                    </div>
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