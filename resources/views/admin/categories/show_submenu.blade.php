<div class="row">
	<div class="col-12">

		<!-- /.card-header -->
		<!-- form start -->
		<form role="form" method="post" id="add_new">
			@csrf
			<div class="card-body">
				<div class="form-group">
                    <label>Main Menus</label>
                    <select disabled class="form-control" id="parent" name="parent" required>
                    	<option value=""> --Select Main Menus-- </option>
                    	@foreach($main_menus as $menu)
                    		<option {{ ($menu->id == $submenu->parent ) ? 'selected' : '' }} value="{{ $menu->id }}">{{ $menu->title }}</option>
                    	@endforeach
                    </select>
                </div>
				<div class="form-group">
					<label for="title">Title</label>
					<input disabled type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ ($menu) ? $menu->title : '' }}">
				</div>
				<div class="form-group">
					<label for="slug">Slug</label>
					<input disabled type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ ($menu) ? $menu->slug : '' }}">
				</div>
				<div class="form-group">
					<label for="route">Route</label>
					<input disabled type="text" class="form-control" id="route" name="route" placeholder="Enter Route" value="{{ ($menu) ? $menu->route : '' }}">
				</div>
				<div class="form-group">
                    <label>Select Sort</label>
                    <select disabled class="form-control" id="sort" name="sort" required>
                    	<option value="0" {{ ($menu->sort == '0') ? 'selected' : '' }} >start</option>
                    	<option value="1" {{ ($menu->sort == '1') ? 'selected' : '' }} >1</option>
                    	<option value="2" {{ ($menu->sort == '2') ? 'selected' : '' }} >2</option>
                    	<option value="3" {{ ($menu->sort == '3') ? 'selected' : '' }} >3</option>
                    	<option value="4" {{ ($menu->sort == '4') ? 'selected' : '' }} >4</option>
                    	<option value="5" {{ ($menu->sort == '5') ? 'selected' : '' }} >5</option>
                    	<option value="6" {{ ($menu->sort == '6') ? 'selected' : '' }} >6</option>
                    	<option value="7" {{ ($menu->sort == '7') ? 'selected' : '' }} >7</option>
                    	<option value="8" {{ ($menu->sort == '8') ? 'selected' : '' }} >8</option>
                    	<option value="9" {{ ($menu->sort == '9') ? 'selected' : '' }} >9</option>
                    	<option value="10" {{ ($menu->sort == '10') ? 'selected' : '' }} >End</option>
                    </select>
                </div>
				<div class="form-check">
					<input disabled type="checkbox" class="form-check-input" id="quick_links" name="quick_links" value="1" {{ ($menu->quick_links == '1') ? 'checked' : '' }}>
					<label class="form-check-label" for="quick_links">Is Quick Links</label>
				</div>
				<div class="form-group">
                    <div class="custom-control custom-switch">
                      <input disabled type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ ($menu->status == '1') ? 'checked' : '' }}>
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