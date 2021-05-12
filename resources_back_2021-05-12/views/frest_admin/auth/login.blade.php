<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<!-- Added by HTTrack -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- mobile specific metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Login Page - Frest - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="images/ico/apple-icon-120.html">
    <link rel="shortcut icon" type="image/x-icon" href="images/ico/favicon.ico">

    
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('frest/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/vendors/css/extensions/toastr.css')}}">
        <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/core/menu/menu-types/vertical-menu.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/pages/authentication.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('frest/assets/css/style.css') }}">
        <!-- END: Custom CSS-->
        <style type="text/css">
          #spinner{
            position: fixed;
            top: 18rem;
            left: 30rem;
            z-index: 10000;
          }
          .spinner-border{
            height: 5rem !important;
            width: 5rem !important;
          }
          .text-error{
            color: red;
          }
        </style>
  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout 1-column navbar-sticky bg-full-screen-image footer-static blank-page
  semi-dark-layout " data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
  
  <div id="spinner"></div>

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
         <!-- login page start -->
<section id="auth-login" class="row flexbox-container">
  <div class="col-xl-8 col-11">
    <div class="card bg-authentication mb-0">
      <div class="row m-0">
        <!-- left section-login -->
        <div class="col-md-6 col-12 px-0">
          <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
            <div class="card-header pb-1">
              <div class="card-title">
                <h4 class="text-center mb-2">Welcome Friday Fam</h4>
              </div>
            </div>
            <div class="card-content">
              <div class="card-body">

                <form method="POST" action="{{ route('admin.login') }}" id="login-form">
                  @csrf
                  <div class="form-group mb-50">
                    <label class="text-bold-600" for="email">Email address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                    <p id="error-email" class="text-error"></p>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label class="text-bold-600" for="exampleInputPassword1">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="current-password">
                    <p id="error-password" class="text-error"></p>
                  </div>
                  <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                    <div class="text-left">
                      <div class="checkbox checkbox-sm">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="checkboxsmall" for="exampleCheck1">
                          <small>Keep me logged in</small>
                        </label>
                      </div>
                    </div>
                  </div>
                  <button id="login" type="submit" class="btn btn-primary glow w-100 position-relative">Login
                    <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- right section image -->
        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
          <div class="card-content">
            <img class="img-fluid" src="{{ asset('frest/images/pages/login.png') }}" alt="branding logo">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- login page ends -->
        </div>
      </div>
    </div>
    <!-- END: Content-->
    
    <!-- BEGIN: Vendor JS-->
    <script>
        var assetBaseUrl = "index.html";
    </script>
    <script src="{{ asset('frest/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('frest/fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
    <script src="{{ asset('frest/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
    <script src="{{ asset('frest/fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
        <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
        <script src="{{ asset('frest/js/scripts/configs/vertical-menu-light.js')}}"></script>
        <script src="{{ asset('frest/js/core/app-menu.js')}}"></script>
    <script src="{{ asset('frest/js/core/app.js')}}"></script>
    <script src="{{ asset('frest/js/scripts/components.js')}}"></script>
    <script src="{{ asset('frest/js/scripts/footer.js')}}"></script>
    <script src="{{ asset('frest/js/scripts/customizer.js')}}"></script>
    <!-- <script src="{{ asset('frest/js/scripts/extensions/toastr.js')}}"></script> -->
    <script src="{{ asset('frest/vendors/js/extensions/toastr.min.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
        <!-- END: Page JS-->

  </body>
  <!-- END: Body-->

<!-- Mirrored from www.pixinvent.com/demo/frest-bootstrap-laravel-admin-dashboard-template/demo-3/auth-login by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2020 16:34:00 GMT -->
</html>
<script src="{{ asset('js/back.js') }}"></script>
<script>
    $(document).ready(function(){
      $(document).on('click', '#login', function(event){
        event.preventDefault();
        var that = $(this);
        var url = "{{ route('admin.login') }}";
        var data = $('#login-form').serialize();
        $.ajax({
          url: url,
          type: 'POST',
          dataType: 'JSON',
          data: data,
          beforeSend: function() {
            $(that).attr('disabled', true);
            $(that).text('redirecting...');
          },
          success : function(res){
            toastr.success("Success", "You are login successfully!");
            setTimeout(function(){
              location.reload();
            },3000);
          },
          error : function(data){
            if( data.status === 422 ) {
              var obj = $.parseJSON(data.responseText);
              toastr.error(obj.message);
              if(obj.errors.email[0] != undefined){
                $('#error-email').html(obj.errors.email[0]);
              }
              if(obj.errors.password[0] != undefined){
                $('#error-password').html(obj.errors.password[0]);
              }
              $(that).attr('disabled', false);
              $(that).text('Login');
              /*$('#login-form').find("input[name=email]").next().html('<p>'+obj.message.email+'</p>');
              $('#login-form').find("input[name=password]").next().html('<p>'+obj.message.password+'</p>');*/
              // console.log(obj.errors.email[0]);
            }
            if( data.status === 400 ) {
              var obj = $.parseJSON(data.responseText);
              toastr.error(obj.errors);
              $(that).attr('disabled', false);
              $(that).text('Login');
            }
            console.log(data);
            
          }
        });
      });
    });
</script>