@extends('admin/default')

@section('css')
    <style type="text/css">
        .error{
            color: red;
        }
        .label-container label.label {
            width: 97%;
            margin-bottom: 0;
        }
        .label-container button.btn.btn-sm.btn-outline-danger.delete_row {
            width: 3%;
            padding: 3px;
        }
        .label-container {
            margin: 10px 0;
        }       
    </style>
@endsection

@section('content')
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-body">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="POST" action="{{ route('admin.villages.update', $village) }}" enctype="multipart/form-data" id="update_village">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state_id">State</label><span class="text-danger">&#42;</span>
                                                <select class="form-control" id="state_id" name="state_id">
                                                    <option value="">--select any state--</option>
                                                    @foreach($states as $state)
                                                        <option {{ ($state->state_id == $village->state_id) ? "selected" : "" }} value="{{ $state->state_id }}">{{ $state->state_name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('state_id'))
                                                    <p class="text-danger" role="alert">
                                                        <strong>{{ $errors->first('state_id') }}</strong>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="district_id">District</label><span class="text-danger">&#42;</span>
                                                <select class="form-control" id="district_id" name="district_id">
                                                    <option value="">--select any district--</option>
                                                    @foreach($districts as $district)
                                                        <option {{ ($district->district_id == $village->district_id) ? "selected" : "" }} value="{{ $district->district_id }}">{{ $district->district_name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('district_id'))
                                                    <p class="text-danger" role="alert">
                                                        <strong>{{ $errors->first('district_id') }}</strong>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city_id">City</label><span class="text-danger">&#42;</span>
                                                <select class="form-control" id="city_id" name="city_id">
                                                    <option value="">--select any city--</option>
                                                    @foreach($cities as $city)
                                                        <option {{ ($city->city_id == $village->city_id) ? "selected" : "" }} value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('city_id'))
                                                    <p class="text-danger" role="alert">
                                                        <strong>{{ $errors->first('city_id') }}</strong>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="village_name">Village Name</label><span class="text-danger">&#42;</span>
                                                <input type="text" class="form-control" id="village_name" name="village_name" placeholder="Enter village name" value="{{ isset($village) ? $village->village_name : old('village_name') }}">
                                                @if ($errors->has('village_name'))
                                                    <p class="text-danger" role="alert">
                                                        <strong>{{ $errors->first('village_name') }}</strong>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="village_name_hindi">Village Name Hindi</label><span class="text-danger">&#42;</span>
                                                <input type="text" class="form-control" id="village_name_hindi" name="village_name_hindi" placeholder="Enter village name hindi" value="{{ isset($village) ? $village->village_name_hindi : old('village_name_hindi') }}">
                                                @if ($errors->has('village_name_hindi'))
                                                    <p class="text-danger" role="alert">
                                                        <strong>{{ $errors->first('village_name_hindi') }}</strong>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="1"> Active </option>
                                                    <option value="0"> Inactive </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Links -->
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>


   <!-- /.content -->
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#state_id').change(function(){
            $('#district_id').html('');
            $('#city_id').html('');
            var data = {'state_id':$(this).val()};
            // console.log(data); return false;
            var url = "{{ route('admin.state.districts') }}";
            $.ajax({
                url  : url,
                type : 'GET',
                data : data,
                success: function(result){
                    $('#district_id').html(result);
                }
            });
        });
        $('#district_id').change(function(){
            $('#city_id').html('');
            var data = {'district_id':$(this).val()};
            // console.log(data); return false;
            var url = "{{ route('admin.district.cities') }}";
            $.ajax({
                url  : url,
                type : 'GET',
                data : data,
                success: function(result){
                    $('#city_id').html(result);
                }
            });
        });
    });
    $('#scheme_date').datetimepicker({
        format: 'Y-M-D'
    });

    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'description_hindi' );
    // toastr.success("Have fun storming the castle!", "Miracle Max Says");
</script>
@endsection