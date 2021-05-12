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
							<form role="form" method="POST" action="{{ route('admin.bank.update', $admin_bank) }}" enctype="multipart/form-data" id="update_intro">
								{{ method_field('PUT') }}
								@csrf
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="account_owner">Account Owner</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="account_owner" name="account_owner" placeholder="Enter contact person" value="{{ isset($admin_bank) ? $admin_bank->account_owner : old('account_owner') }}">
												@if ($errors->has('account_owner'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('account_owner') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="account_owner_hindi">Account Owner [Hindi]</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="account_owner_hindi" name="account_owner_hindi" placeholder="Enter contact person" value="{{ isset($admin_bank) ? $admin_bank->account_owner_hindi : old('account_owner_hindi') }}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="bank_name">Bank Name</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter contact person" value="{{ isset($admin_bank) ? $admin_bank->bank_name : old('bank_name') }}">
												@if ($errors->has('bank_name'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('bank_name') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="bank_name_hindi">Bank Name [Hindi]</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="bank_name_hindi" name="bank_name_hindi" placeholder="Enter contact person" value="{{ isset($admin_bank) ? $admin_bank->bank_name_hindi : old('bank_name_hindi') }}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="col-md-12">
												<div class="form-group">
													<label for="bank_address">Bank Address</label><span class="text-danger">&#42;</span>
													<textarea class="form-control" id="bank_address" name="bank_address" rows="5">{{ isset($admin_bank) ? $admin_bank->bank_address : old('bank_address') }}</textarea>
													@if ($errors->has('bank_address'))
														<p class="text-danger" role="alert">
															<strong>{{ $errors->first('bank_address') }}</strong>
														</p>
													@endif
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="col-md-12">
												<div class="form-group">
													<label for="bank_address_hindi">Bank Address [Hindi]</label><span class="text-danger">&#42;</span>
													<textarea class="form-control" id="bank_address_hindi" name="bank_address_hindi" rows="5">{{ isset($admin_bank) ? $admin_bank->bank_address_hindi : old('bank_address_hindi') }}</textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="account_number">Account Number</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter contact person" value="{{ isset($admin_bank) ? $admin_bank->account_number : old('account_number') }}">
												@if ($errors->has('account_number'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('account_number') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="ifsc_code">Bank IFSC Code</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="Enter contact person" value="{{ isset($admin_bank) ? $admin_bank->ifsc_code : old('ifsc_code') }}">
												@if ($errors->has('ifsc_code'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('ifsc_code') }}</strong>
													</p>
												@endif
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