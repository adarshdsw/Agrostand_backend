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
							<form role="form" method="POST" action="{{ route('admin.agromeets.store') }}" enctype="multipart/form-data" id="create_village">
								@csrf
								<div class="card-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="meeting_title">Title</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="meeting_title" name="meeting_title" placeholder="Enter village name" value="{{ isset($agromeet) ? $agromeet->meeting_title : old('meeting_title') }}">
												@if ($errors->has('meeting_title'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('meeting_title') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="meeting_title_hindi">Title [Hindi]</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="meeting_title_hindi" name="meeting_title_hindi" placeholder="Enter village name hindi" value="{{ isset($agromeet) ? $agromeet->meeting_title_hindi : old('meeting_title_hindi') }}">
												@if ($errors->has('meeting_title_hindi'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('meeting_title_hindi') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="meeting_type">Type</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="meeting_type" name="meeting_type" placeholder="Enter village name hindi" value="{{ isset($agromeet) ? $agromeet->meeting_type : old('meeting_type') }}">
												@if ($errors->has('meeting_type'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('meeting_type') }}</strong>
													</p>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="meeting_description">Description</label><span class="text-danger">&#42;</span>
												<textarea class="form-control" id="meeting_description" name="meeting_description" rows="5">{{ isset($agromeet) ? $agromeet->meeting_description : old('meeting_description') }}</textarea>
												@if ($errors->has('meeting_description'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('meeting_description') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="meeting_description_hindi">Description [Hindi]</label><span class="text-danger">&#42;</span>
												<textarea class="form-control" id="meeting_description_hindi" name="meeting_description_hindi" rows="5">{{ isset($agromeet) ? $agromeet->meeting_description_hindi : old('meeting_description_hindi') }}</textarea>
												@if ($errors->has('meeting_description_hindi'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('meeting_description_hindi') }}</strong>
													</p>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="meeting_link">Link</label>
												<input type="text" class="form-control" name="meeting_link" id="meeting_link" placeholder="Enter Meeting Link" value="{{ isset($agromeet) ? $agromeet->meeting_link : old('meeting_link') }}">
												@if ($errors->has('meeting_link'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('meeting_link') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="meeting_image">Banner Image</label>
												<div class="input-group">
													<div class="custom-file">
													<input type="file" class="custom-file-input" id="meeting_image" name="meeting_image">
														<label class="custom-file-label" for="meeting_image">Choose file</label>
													</div>
												</div>
												<p class="text-muted ml-1 mt-50"><small>Allowed JPG, GIF or PNG. Max size of 800kB</small></p>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<!-- <input type="text" class="form-control" name="meeting_date_time" id="meeting_date_time" placeholder="Enter Meeting Link" value="{{ isset($agromeet) ? $agromeet->meeting_date_time : old('meeting_date_time') }}"> -->
											</div>
											<div class="form-group">
												<label for="meeting_date_time">Date / Time</label>
								                <div class="input-group date" id="meeting_date_time" data-target-input="nearest">
								                    <input type="text" name="meeting_date_time" class="form-control datetimepicker-input" data-target="#meeting_date_time"/>
								                    <div class="input-group-append" data-target="#meeting_date_time" data-toggle="datetimepicker">
								                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
								                    </div>
										            @if ($errors->has('meeting_date_time'))
														<p class="text-danger" role="alert">
															<strong>{{ $errors->first('meeting_date_time') }}</strong>
														</p>
													@endif
								                </div>
								            </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
					   							<label for="status">Status</label>
					   							<select class="form-control" id="status" name="status">
					   								<option value="2"> Draft </option>
					   								<option value="1"> Public </option>
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
		// date/time picker
		$('#meeting_date_time').datetimepicker();
	});
	$('#scheme_date').datetimepicker({
        format: 'Y-M-D'
    });

	CKEDITOR.replace( 'meeting_description' );
	CKEDITOR.replace( 'meeting_description_hindi' );
	// toastr.success("Have fun storming the castle!", "Miracle Max Says");
</script>
@endsection