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
                      <li class="breadcrumb-item active">
                        Change Password
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
                         
                         <li class="nav-item active">
                            <a class="nav-link d-flex align-items-center" id="account-pill-password" data-toggle="pill"
                               href="#account-vertical-password" aria-expanded="false">
                            <i class="bx bx-lock"></i>
                            <span>Change Password</span>
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
                                  
                                  <div class=" " role="tabpanel"
                                     aria-labelledby="account-pill-password" aria-expanded="false">
                                     <form method="post" action="{{ route('admin.update.password', [$admin->id]) }}" id="reset-password-form">
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
                                                    <p id="old_password" class="text-danger"></p>
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
                                                    <p id="new_password" class="text-danger"></p>
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
                                                    <p id="conf_password" class="text-danger"></p>
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                              <input type="submit" id="save_password" name="save_password" class="btn btn-primary glow mr-sm-1 mb-1" value="Save">
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


@section('js')
<script src="{{ asset('js/back.js') }}"></script>
<script>
    $(document).ready(function(){
      /*$.each($('.text-danger'), function(error_value){
        console.log($(this).prev().val()); return false;
      });*/
      $('#reset-password-form').submit(function(event){
        event.preventDefault();
        var that = $(this)[0];
        var url = "{{ route('admin.update.password', [$admin->id]) }}";
        var formData = new FormData(that);
        $.ajax({
          url: url,
          type: 'POST',
          dataType: 'JSON',
          cache: false,
          processData: false,
          contentType: false,
          data: formData,
          beforeSend: function() {
            $('#save_password').attr('disabled', true);
            $('#save_password').val('redirecting...');
          },
          success : function(res){
            // console.log(res);return false;
            toastr.success("Success", "Profile Updated successfully!");
            $('#save_password').attr('disabled', false);
            $('#save_password').val('Save');
            setTimeout(function(){
              location.reload();
            },1000);
          },
          error : function(data){
            if( data.status === 422 ) {
              var obj = $.parseJSON(data.responseText);
              console.log(obj);
              $('#save_password').attr('disabled', false);
              $('#save_password').val('Save');
              toastr.error(obj.message);
              if(obj.errors.old_password[0] != undefined){
                $('#old_password').html(obj.errors.old_password[0]);
              }
              if(obj.errors.password[0] != undefined){
                $('#new_password').html(obj.errors.password[0]);
              }
              if(obj.errors.con_password[0] != undefined){
                $('#conf_password').html(obj.errors.con_password[0]);
              }
            }
            
          }
        });
      });
    });
</script>
@endsection