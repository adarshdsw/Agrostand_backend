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
				<div class="col-md-12">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">Personal</a></li>
								<li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address</a></li>
								<li class="nav-item"><a class="nav-link" href="#kyc_bank" data-toggle="tab">KYC & Bank</a></li>
								<li class="nav-item"><a class="nav-link" href="#business" data-toggle="tab">Business</a></li>
								<li class="nav-item"><a class="nav-link" href="#education" data-toggle="tab">Education</a></li>
							</ul>
						</div><!-- /.card-header -->
						<div class="card-body">
							<div class="tab-content">

								<div class="tab-pane active" id="personal">
									<form class="form-horizontal">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="inputName" class="col-form-label">Name</label>
													<input disabled type="text" class="form-control" id="inputName" placeholder="Name" value="{{ ($user) ? $user->name : '' }}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="inputEmail" class="col-form-label">Email</label>
													<input disabled type="text" class="form-control" id="inputEmail" placeholder="Email" value="{{ ($user) ? $user->email : '' }}">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="mobile" class="col-form-label">Mobile</label>
													<input disabled type="text" class="form-control" id="mobile" placeholder="Name" value="{{ ($user) ? $user->mobile : '' }}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="category_id" class="col-form-label">User Category</label>
													<input disabled type="text" class="form-control" id="category_id" placeholder="Name" value="{{ ($user->category) ? $user->category->title : '' }}">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="subcategory_id" class="col-form-label">User Subcategory</label>
													<input disabled type="text" class="form-control" id="subcategory_id" placeholder="Name" value="{{ ($user->subcategory) ? $user->subcategory->title : '' }}">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="role_id" class="col-form-label">User Role</label>
													<select disabled class="form-control" id="role_id" name="role_id">
														<option value="">--select option--</option>
														@if($roles)
															@foreach($roles as $role)
																<option value="{{$role->id}}" {{ ($role->id == $user->role_id) ? "selected" : "" }}>{{$role->title}}</option>
															@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="assured_id" class="col-form-label">User Assurity</label>
													<select disabled class="form-control" id="assured_id" name="assured_id">
														<option value="">--select option--</option>
														@if($assures)
															@foreach($assures as $assure)
																<option value="{{$assure->id}}" {{ ($assure->id == $user->assured_id) ? "selected" : "" }}>{{$assure->title}}</option>
															@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="status" class="col-form-label">User Status</label>
													<select disabled class="form-control" id="status" name="status">
														<option {{ ($user->status == 0) ? "selected" : "" }} value="0">Inactive</option>
														<option {{ ($user->status == 1) ? "selected" : "" }} value="1">Active</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="form-group">
												<label for="commodities" class="col-form-label">User Commodity</label>
													@if($user->commodities)
														@foreach($user->commodities as $user_commodity)
															<span class='badge bg-info'>{{ ($user_commodity->commodity) ? $user_commodity->commodity->title : '' }}</span>
														@endforeach
													@endif
											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->

								<div class="tab-pane" id="address">
									<form class="form-horizontal">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="address" class="col-form-label">Address</label>
													<textarea disabled class="form-control" id="address" name="address">{{ ($user->address) ? $user->address->address : '' }}</textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="land_area" class="col-form-label">Land Area</label>
													<input disabled type="text" class="form-control" id="land_area" placeholder="Name" value="{{ ($user->address) ? $user->address->land_area : '' }}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="land_area_proof" class="col-form-label">Land Area Proof</label>
													<a href="{{ ($user->address) ? $user->address->land_proof_img : '' }}" alt="{{ ($user->address) ? $user->address->land_area : '' }}"> Land Area Proof</a>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="state_id" class="col-form-label">States</label>
													<select disabled class="form-control" id="state_id" name="state_id">
														<option value="">--select option--</option>
														@if($states)
															@foreach($states as $state)
																<option value="{{$state->state_id}}" {{ ($state->state_id == $user->address->state_id) ? "selected" : "" }}>{{$state->state_name}}</option>
															@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="district_id" class="col-form-label">Districts</label>
													<select disabled class="form-control" id="district_id" name="district_id">
														<option value="">--select option--</option>
														@if($districts)
															@foreach($districts as $district)
																<option value="{{$district->district_id}}" {{ ($district->district_id == $user->address->district) ? "selected" : "" }}>{{$district->district_name}}</option>
															@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="city_id" class="col-form-label">City</label>
													<select disabled class="form-control" id="city_id" name="city_id">
														<option value="">--select option--</option>
														@if($cities)
															@foreach($cities as $city)
																<option value="{{$city->city_id}}" {{ ($city->city_id == $user->address->city) ? "selected" : "" }}>{{$district->district_name}}</option>
															@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="status" class="col-form-label">User Status</label>
													<select disabled class="form-control" id="status" name="status">
														<option {{ ($user->status == 0) ? "selected" : "" }} value="0">Inactive</option>
														<option {{ ($user->status == 1) ? "selected" : "" }} value="1">Active</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="village_town" class="col-form-label">Village Town</label>
													<input disabled type="text" class="form-control" id="village_town" placeholder="Name" value="{{ ($user->address) ? $user->address->village_town : '' }}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="house_number" class="col-form-label">House Number</label>
													<input disabled type="text" class="form-control" id="house_number" placeholder="Name" value="{{ ($user->address) ? $user->address->house_number : '' }}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="pincode" class="col-form-label">Pincode</label>
													<input disabled type="text" class="form-control" id="pincode" placeholder="Name" value="{{ ($user->address) ? $user->address->pincode : '' }}">
												</div>
											</div>
										</div>
									</form>
								</div>

								<div class="tab-pane" id="kyc_bank">
									<form class="form-horizontal">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="kyc_type" class="col-form-label">KYC Type</label>
													@if($user->kyc)
														<select disabled class="form-control" id="kyc_type" name="kyc_type">
															<option {{ ($user->kyc->kyc_type == 0) ? "selected" : "" }} value="0">Voter ID</option>
															<option {{ ($user->kyc->kyc_type == 1) ? "selected" : "" }} value="1">Aadhar Card</option>
															<option {{ ($user->kyc->kyc_type == 2) ? "selected" : "" }} value="2">PAN Card</option>
														</select>
													@else
														<p>No KYC found</p>
													@endif
												</div>
											</div>
											<div class="col-md-4">
												<label for="card_number" class="col-form-label">Card Number</label>
												<input disabled type="text" class="form-control" id="card_number" name="card_number" placeholder="card_number" value="{{ ($user->kyc) ? $user->kyc->card_number : '' }}">
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="card_img" class="col-form-label">Card Image</label>
													<a href="{{ ($user->kyc) ? $user->kyc->card_img : '' }}" alt="{{ ($user->kyc) ? $user->kyc->card_number : '' }}"> Card Image</a>
												</div>
											</div>
										</div>
										<!-- bank -->
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="bank_address" class="col-form-label">Bank Address</label>
													<textarea disabled class="form-control" id="bank_address" name="bank_address">{{ ($user->bank) ? $user->bank->bank_address : '' }}</textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="bank_name" class="col-form-label">Bank Name</label>
													<input disabled type="text" class="form-control" id="bank_name" placeholder="Bank Name" value="{{ ($user->bank) ? $user->bank->bank_name : '' }}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="account_number" class="col-form-label">A/c Number</label>
													<input disabled type="text" class="form-control" id="account_number" placeholder="Acount Number" value="{{ ($user->bank) ? $user->bank->account_number : '' }}">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="account_owner" class="col-form-label">Account Owner</label>
													<input disabled type="text" class="form-control" id="account_owner" placeholder="Account Owner" value="{{ ($user->bank) ? $user->bank->account_owner : '' }}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="passbook_img" class="col-form-label">Passbook Image</label>
													<a href="{{ ($user->bank) ? $user->bank->passbook_img : '' }}" alt="passbook_img"> Passbook Image</a>
												</div>
											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
								<!-- Business -->
								<div class="tab-pane" id="business">
									<form class="form-horizontal">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="business_name" class="col-form-label">Business Name</label>
													<input disabled type="text" class="form-control" id="business_name" placeholder="business_name" value="{{ ($user->business) ? $user->business->business_name : '' }}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="owner_name" class="col-form-label">Owner Name</label>
													<input disabled type="text" class="form-control" id="owner_name" placeholder="Email" value="{{ ($user->business) ? $user->business->owner_name : '' }}">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="business_address" class="col-form-label">Businee Address</label>
													<input disabled type="text" class="form-control" id="business_address" placeholder="business_address" value="{{ ($user->business) ? $user->business->business_address : '' }}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="gstin" class="col-form-label">GSTIN</label>
													<input disabled type="text" class="form-control" id="gstin" placeholder="gstin" value="{{ ($user->business) ? $user->business->gstin : '' }}">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="business_contact" class="col-form-label">Business Contact</label>
													<input disabled type="text" class="form-control" id="business_contact" placeholder="business_contact" value="{{ ($user->business) ? $user->business->business_contact : '' }}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="business_email" class="col-form-label">Business Email</label>
													<input disabled type="text" class="form-control" id="business_email" placeholder="business_email" value="{{ ($user->business) ? $user->business->business_email : '' }}">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="role_id" class="col-form-label">User Role</label>
													<select disabled class="form-control" id="role_id" name="role_id">
														<option value="">--select option--</option>
														@if($roles)
															@foreach($roles as $role)
																<option value="{{$role->id}}" {{ ($role->id == $user->role_id) ? "selected" : "" }}>{{$role->title}}</option>
															@endforeach
														@endif
													</select>
												</div>
											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
								<!-- Education panel -->
								<div class="tab-pane" id="education">
									<form class="form-horizontal">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="education_name" class="col-form-label">Education Name</label>
													<input disabled type="text" class="form-control" id="education_name" placeholder="education_name" value="{{ ($user->education) ? $user->education->education_name : '' }}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="experience" class="col-form-label">Experience</label>
													<input disabled type="text" class="form-control" id="experience" placeholder="experience" value="{{ ($user->education) ? $user->education->experience : '' }}">
												</div>
											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div><!-- /.card-body -->
					</div>
					<!-- /.card -->
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
	CKEDITOR.replace( 'description' );
	CKEDITOR.replace( 'description_hindi' );
	// toastr.success("Have fun storming the castle!", "Miracle Max Says");
</script>
@endsection