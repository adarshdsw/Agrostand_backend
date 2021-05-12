<div class="row">
    <div class="col-12">

        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('admin.drivers.update', $driver) }}" id="edit_form">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ ($driver) ? $driver->name : '' }}">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile" value="{{ ($driver) ? $driver->mobile : '' }}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="{{ ($driver) ? $driver->conf_password : '' }}">
                </div>
                <!-- display the icon -->
                <img id="upload_image_preview" src="{{ ($driver) ?$driver->profile_image  : ''}}" class="rounded mr-75" alt="profile image" height="64" width="64">
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
                      <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ ($driver->status == 1) ? "checked" : "" }}>
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