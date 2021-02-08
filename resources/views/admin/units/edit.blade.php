<div class="row">
    <div class="col-12">

        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('admin.units.update', $unit) }}" id="edit_form">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ ($unit) ? $unit->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="title_hindi">Title Hindi</label>
                    <input type="text" class="form-control" id="title_hindi" name="title_hindi" placeholder="Enter Hindi title" value="{{ ($unit) ? $unit->title_hindi : '' }}">
                </div>
                <div class="form-group">
                    <label for="value">Value</label>
                    <input type="text" class="form-control" id="value" name="value" placeholder="Value" value="{{ ($unit) ? $unit->value : '' }}">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ ($unit->status == 1) ? "checked" : "" }}>
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