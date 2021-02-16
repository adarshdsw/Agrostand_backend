<div class="row">
    <div class="col-12">

        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('admin.commodity.update', $commodity) }}" id="edit_form">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label>Sub Category</label>
                    <select class="form-control" id="subcategory_id" name="subcategory_id" required>
                        <option value=""> --Select Sub Category-- </option>
                        @foreach($subcategories as $subcategory)
                            <option {{ ($subcategory->id == $commodity->subcategory_id ) ? 'selected' : '' }} value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ ($commodity) ? $commodity->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="title_hindi">Title Hindi</label>
                    <input type="text" class="form-control" id="title_hindi" name="title_hindi" placeholder="Enter Hindi title" value="{{ ($commodity) ? $commodity->title_hindi : '' }}">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ ($commodity) ? $commodity->slug : '' }}">
                </div>
                <!-- display the icon -->
                <img id="upload_image_preview" src="{{ ($commodity) ?$commodity->icon : ''}}" class="rounded mr-75" alt="profile image" height="64" width="64">
                <!-- upload the icon -->
                <div class="form-group">
                    <label for="icon">Icon Image</label><span class="text-danger">&#42;</span>
                    <div class="input-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="icon" name="icon">
                            <label class="custom-file-label" for="icon">Choose file</label>
                        </div>
                    </div>
                    <p class="text-muted ml-1 mt-50"><small>Allowed JPG, GIF or PNG. Max size of 800kB</small></p>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ ($commodity->status == 1) ? "checked" : "" }}>
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