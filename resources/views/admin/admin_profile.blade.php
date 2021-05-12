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
							<form role="form" method="POST" action="{{ route('admin.profile.update', $admin) }}" enctype="multipart/form-data" id="update_intro">
								{{ method_field('PUT') }}
								@csrf
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="username">User Name</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="username" name="username" placeholder="Enter admin username" value="{{ isset($admin) ? $admin->username : old('username') }}">
												@if ($errors->has('username'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('username') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="email">Email</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="email" name="email" placeholder="Enter admin email" value="{{ isset($admin) ? $admin->email : old('email') }}">
												@if ($errors->has('email'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('email') }}</strong>
													</p>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="mobile">Admin Mobile</label><span class="text-danger">&#42;</span>
												<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Admin Mobile" value="{{ isset($admin) ? $admin->mobile : old('mobile') }}">
												@if ($errors->has('mobile'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('mobile') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="password">Admin Password</label><span class="text-danger">&#42;</span>
												<input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" value="{{ old('password') }}">
												@if ($errors->has('password'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('password') }}</strong>
													</p>
												@endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="conf_password">Confirm Password</label><span class="text-danger">&#42;</span>
												<input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="Enter Confirm New password" value="{{ old('conf_password') }}">
												@if ($errors->has('conf_password'))
													<p class="text-danger" role="alert">
														<strong>{{ $errors->first('conf_password') }}</strong>
													</p>
												@endif
											</div>
										</div>
									</div>
									<!-- Links -->
									<div class="col-2">
										<button type="submit" class="btn btn-primary btn-block">Update</button>
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