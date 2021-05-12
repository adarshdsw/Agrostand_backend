<div class="row">
    <div class="col-12">

        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('admin.suggestions.update', $suggestion) }}" id="edit_form">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ ($suggestion) ? $suggestion->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="title_hindi">Title Hindi</label>
                    <input type="text" class="form-control" id="title_hindi" name="title_hindi" placeholder="Enter Hindi title" value="{{ ($suggestion) ? $suggestion->title_hindi : '' }}">
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" id="type" name="type">
                        <option value=""> --select type-- </option>
                        <option value="1" {{ ($suggestion->type == '1') ? "selected" : "" }}> Sell </option>
                        <option value="2" {{ ($suggestion->type == '2') ? "selected" : "" }}> Buy </option>
                        <option value="3" {{ ($suggestion->type == '3') ? "selected" : "" }}> Other </option>
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