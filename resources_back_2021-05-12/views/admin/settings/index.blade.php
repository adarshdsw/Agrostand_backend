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
							<form role="form" method="POST" action="{{ route('admin.settings.update', $settings) }}" enctype="multipart/form-data" id="update_intro">
								{{ method_field('PUT') }}
								@csrf
								<div class="card-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="contact_person">Contact Person</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Enter contact person" value="{{ isset($settings) ? $settings->contact_person : old('contact_person') }}">
												@if ($errors->has('contact_person'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('contact_person') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="contact_email">Contact Email</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Enter contact person" value="{{ isset($settings) ? $settings->contact_email : old('contact_email') }}">
												@if ($errors->has('contact_email'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('contact_email') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="contact_number">Contact Number</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter contact person" value="{{ isset($settings) ? $settings->contact_number : old('contact_number') }}">
												@if ($errors->has('contact_number'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('contact_number') }}</strong>
													</p>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="col-md-12">
												<div class="form-group">
													<label for="company_address">Contact Person Address</label><span class="text-danger">&#42;</span>
													<textarea class="form-control" id="company_address" name="company_address" rows="5">{{ isset($settings) ? $settings->company_address : old('company_address') }}</textarea>
													@if ($errors->has('company_address'))
														<p class="text-danger" role="alert">
															<strong>{{ $errors->first('company_address') }}</strong>
														</p>
													@endif
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="col-md-12">
												<div class="form-group">
													<label for="company_address_hindi">Address [Hindi]</label><span class="text-danger">&#42;</span>
													<textarea class="form-control" id="company_address_hindi" name="company_address_hindi" rows="5">{{ isset($settings) ? $settings->company_address_hindi : old('company_address_hindi') }}</textarea>
													@if ($errors->has('company_address_hindi'))
														<p class="text-danger" role="alert">
															<strong>{{ $errors->first('company_address_hindi') }}</strong>
														</p>
													@endif
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="col-md-12">
												<div class="form-group">
													<label for="terms_conditions">Terms & Conditions</label><span class="text-danger">&#42;</span>
													<textarea class="form-control" id="terms_conditions" name="terms_conditions" rows="10">{{ isset($settings) ? $settings->terms_conditions : old('terms_conditions') }}</textarea>
													@if ($errors->has('terms_conditions'))
														<p class="text-danger" role="alert">
															<strong>{{ $errors->first('terms_conditions') }}</strong>
														</p>
													@endif
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="col-md-12">
												<div class="form-group">
													<label for="terms_conditions_hindi">Terms & Conditions [Hindi]</label><span class="text-danger">&#42;</span>
													<textarea class="form-control" id="terms_conditions_hindi" name="terms_conditions_hindi" rows="10">{{ isset($settings) ? $settings->terms_conditions_hindi : old('terms_conditions_hindi') }}</textarea>
													@if ($errors->has('terms_conditions_hindi'))
														<p class="text-danger" role="alert">
															<strong>{{ $errors->first('terms_conditions_hindi') }}</strong>
														</p>
													@endif
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-12">
											<div class="col-md-12">
												<div class="form-group">
													<label for="privacy_policy">Privacy & Policy</label><span class="text-danger">&#42;</span>
													<textarea class="form-control" id="privacy_policy" name="privacy_policy" rows="10">{{ isset($settings) ? $settings->privacy_policy : old('privacy_policy') }}</textarea>
													@if ($errors->has('privacy_policy'))
														<p class="text-danger" role="alert">
															<strong>{{ $errors->first('privacy_policy') }}</strong>
														</p>
													@endif
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-12">
											<div class="col-md-12">
												<div class="form-group">
													<label for="privacy_policy_hindi">Privacy & Policy [Hindi] </label><span class="text-danger">&#42;</span>
													<textarea class="form-control" id="privacy_policy_hindi" name="privacy_policy_hindi" rows="10">{{ isset($settings) ? $settings->privacy_policy_hindi : old('privacy_policy_hindi') }}</textarea>
													@if ($errors->has('privacy_policy_hindi'))
														<p class="text-danger" role="alert">
															<strong>{{ $errors->first('privacy_policy_hindi') }}</strong>
														</p>
													@endif
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="col-md-12">
												<div class="form-group">
													<label for="about_us">About us</label><span class="text-danger">&#42;</span>
													<textarea class="form-control" id="about_us" name="about_us" rows="10">{{ isset($settings) ? $settings->about_us : old('about_us') }}</textarea>
													@if ($errors->has('about_us'))
														<p class="text-danger" role="alert">
															<strong>{{ $errors->first('about_us') }}</strong>
														</p>
													@endif
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="col-md-12">
												<div class="form-group">
													<label for="about_us_hindi">About us [Hindi]</label><span class="text-danger">&#42;</span>
													<textarea class="form-control" id="about_us_hindi" name="about_us_hindi" rows="10">{{ isset($settings) ? $settings->about_us_hindi : old('about_us_hindi') }}</textarea>
													@if ($errors->has('about_us_hindi'))
														<p class="text-danger" role="alert">
															<strong>{{ $errors->first('about_us_hindi') }}</strong>
														</p>
													@endif
												</div>
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
	$('#news_date').datetimepicker({
        format: 'Y-M-D'
    });

	CKEDITOR.replace( 'company_address' );
	CKEDITOR.replace( 'terms_conditions' );
	CKEDITOR.replace( 'privacy_policy' );
	CKEDITOR.replace( 'about_us' );

	CKEDITOR.replace( 'company_address_hindi' );
	CKEDITOR.replace( 'terms_conditions_hindi' );
	CKEDITOR.replace( 'privacy_policy_hindi' );
	CKEDITOR.replace( 'about_us_hindi' );
	// toastr.success("Have fun storming the castle!", "Miracle Max Says");
</script>
@endsection