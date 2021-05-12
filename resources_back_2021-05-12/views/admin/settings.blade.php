@extends('admin.layout')

@section('css')
  html body.navbar-sticky .app-content .content-wrapper {
    padding: 1.8rem 2.2rem 0;
    margin-top: 1rem !important;
  }
@endsection


@section('main')

  <div class="content-wrapper">
    <div class="content-header row">
       <div class="content-header-left col-12 mb-2 mt-1">
          <div class="row breadcrumbs-top">
             <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Account Settings</h5>
                <div class="breadcrumb-wrapper col-12">
                   <ol class="breadcrumb p-0 mb-0">
                      <li class="breadcrumb-item ">
                         <a href="index.html"><i class="bx bx-home-alt"></i></a>
                      </li>
                      <li class="breadcrumb-item ">
                         <a href="#">Pages</a>
                      </li>
                      <li class="breadcrumb-item active">
                         Account Settings            
                      </li>
                   </ol>
                </div>
             </div>
          </div>
       </div>
    </div>
    <div class="content-body">
       <!-- account setting page start -->
       <section id="page-account-settings">
          <div class="row">
             <div class="col-12">
                <div class="row">
                   <!-- left menu section -->
                   <div class="col-md-3 mb-2 mb-md-0 pills-stacked">
                      <ul class="nav nav-pills flex-column">
                         <li class="nav-item">
                            <a class="nav-link d-flex align-items-center active" id="account-pill-general" data-toggle="pill"
                               href="#account-vertical-general" aria-expanded="true">
                            <i class="bx bx-cog"></i>
                            <span>General</span>
                            </a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="account-pill-password" data-toggle="pill"
                               href="#account-vertical-password" aria-expanded="false">
                            <i class="bx bx-lock"></i>
                            <span>Change Password</span>
                            </a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="account-pill-info" data-toggle="pill"
                               href="#account-vertical-info" aria-expanded="false">
                            <i class="bx bx-info-circle"></i>
                            <span>Info</span>
                            </a>
                         </li>
                      </ul>
                   </div>
                   <!-- right content section -->
                   <div class="col-md-9">
                      <div class="card">
                         <div class="card-content">
                            <div class="card-body">
                              @if (session('category-ok'))
                                  @component('admin.components.alert')
                                      @slot('type')
                                          success
                                      @endslot
                                      {!! session('category-ok') !!}
                                  @endcomponent
                              @endif
                               <div class="tab-content">
                                  <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                     aria-labelledby="account-pill-general" aria-expanded="true">
                                     <div class="media">
                                        <a href="javascript: void(0);">
                                        <img src="images/portrait/small/avatar-s-16.jpg"
                                           class="rounded mr-75" alt="profile image" height="64" width="64">
                                        </a>
                                        <div class="media-body mt-25">
                                           <div
                                              class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                              <label for="select-files" class="btn btn-sm btn-light-primary ml-50 mb-50 mb-sm-0">
                                              <span>Upload new photo</span>
                                              <input id="select-files" type="file" hidden>
                                              </label>
                                              <button class="btn btn-sm btn-light-secondary ml-50">Reset</button>
                                           </div>
                                           <p class="text-muted ml-1 mt-50"><small>Allowed JPG, GIF or PNG. Max
                                              size of 800kB</small>
                                           </p>
                                        </div>
                                     </div>
                                     <hr>
                                     <form method="post" action="{{ route('admin.update.general', [$admin->id]) }}">

                                      {{ method_field('PUT') }}
                                        {{ csrf_field() }}

                                        <div class="row">
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <div class="controls">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" placeholder="Username" name="name" value="{{ old('name', $admin->name) }}">
                                                    @error('name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <div class="controls">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ old('first_name', $admin->first_name) }}">
                                                    @error('first_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <div class="controls">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" placeholder="Name" name="last_name" 
                                                       value="{{ old('last_name', $admin->last_name) }}">
                                                      @error('last_name')
                                                          <p class="text-danger">{{ $message }}</p>
                                                      @enderror
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <div class="controls">
                                                    <label>E-mail</label>
                                                    <input type="email" class="form-control" placeholder="Email" name="email" 
                                                       value="{{ old('email', $admin->email) }}">
                                                        @error('email')
                                                          <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                              <input type="submit" name="save_general" class="btn btn-primary glow mr-sm-1 mb-1" value="Save">
                                              <button type="reset" class="btn btn-light mb-1">Cancel</button>
                                           </div>
                                        </div>
                                     </form>
                                  </div>
                                  <div class="tab-pane fade " id="account-vertical-password" role="tabpanel"
                                     aria-labelledby="account-pill-password" aria-expanded="false">
                                     <form method="post" action="{{ route('admin.update.password', [$admin->id]) }}">
                                      {{ method_field('PUT') }}

                                        {{ csrf_field() }}
                                        <input type="hidden" name="email" value="{{ ($admin->email) ? $admin->email : '' }}">
                                        <div class="row">
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <div class="controls">
                                                    <label>Old Password</label>
                                                    <input type="password" class="form-control" name="old_password" placeholder="Old Password">
                                                    @error('old_password')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <div class="controls">
                                                    <label>New Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="New Password">
                                                    @error('password')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <div class="controls">
                                                    <label>Retype new Password</label>
                                                    <input type="password" name="con_password" class="form-control" placeholder="New Password">
                                                    @error('con_password')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                              <input type="submit" name="save_password" class="btn btn-primary glow mr-sm-1 mb-1" value="Save">
                                              <button type="reset" class="btn btn-light mb-1">Cancel</button>
                                           </div>
                                        </div>
                                     </form>
                                  </div>
                                  <div class="tab-pane fade" id="account-vertical-info" role="tabpanel"
                                     aria-labelledby="account-pill-info" aria-expanded="false">
                                     
                                     <form method="post" action="{{ route('admin.update.info', [$admin->id]) }}">
        
                                        {{ method_field('PUT') }}

                                        {{ csrf_field() }}

                                        <div class="row">
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <label>Bio</label>
                                                 <textarea class="form-control" id="accountTextarea" rows="3" name="bio"  
                                                    placeholder="Your Bio data here...">{{ old('bio', $admin->bio) }}</textarea>
                                                    @error('bio')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                              </div>
                                           </div>
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <div class="controls">
                                                    <label>Birth date</label>
                                                    <input type="text" class="form-control birthdate-picker" name="birth_date" value="{{ old('birth_date', $admin->birth_date) }}" >
                                                      @error('birth_date')
                                                        <p class="text-danger">{{ $message }}</p>
                                                      @enderror
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <label>Country</label>
                                                 <select class="form-control" id="country" name="country">
                                                    <option value="India" {{ ($admin->country == 'India') ? 'selected' : '' }} >India</option>
                                                 </select>
                                                 @error('country')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                                              </div>
                                           </div>
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <label>State</label>
                                                 <select class="form-control" id="state" name="state">
                                                    <option value="MP" {{ ($admin->state == 'MP') ? 'selected' : '' }} >Madhya Pradesh</option>
                                                    <option value="UP" {{ ($admin->state == 'UP') ? 'selected' : '' }} >Uttar Pradesh</option>
                                                    <option value="MH" {{ ($admin->state == 'MH') ? 'selected' : '' }} >Maharastra</option>
                                                 </select>
                                                 @error('state')
                                                    <p class="text-danger">{{ $message }}</p>
                                                 @enderror
                                              </div>
                                           </div>
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <label>City</label>
                                                 <input type="text" class="form-control" placeholder="City" name="city" 
                                                       value="{{ old('city', $admin->city) }}" >
                                                   @error('city')
                                                      <p class="text-danger">{{ $message }}</p>
                                                   @enderror
                                              </div>
                                           </div>
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <div class="controls">
                                                    <label>Phone</label>
                                                    <input type="text" class="form-control" name="mobile" 
                                                       placeholder="Phone number" value="{{ old('mobile', $admin->mobile) }}">
                                                       @error('mobile')
                                                          <p class="text-danger">{{ $message }}</p>
                                                       @enderror
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                              <input type="submit" name="save" class="btn btn-primary glow mr-sm-1 mb-1" value="Save">
                                              <button type="reset" class="btn btn-light mb-1">Cancel</button>
                                           </div>
                                        </div>
                                     </form>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </section>
       <!-- account setting page ends -->
    </div>
  </div>
	
@endsection