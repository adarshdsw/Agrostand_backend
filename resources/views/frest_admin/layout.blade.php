<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta  charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Dashboard Ecommerce - Friday Fan</title>
  <link rel="apple-touch-icon" href="{{ asset('frest/images/ico/apple-icon-120.html')}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frest/images/ico/favicon.ico')}}">

  
  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

  <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/vendors/css/extensions/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/vendors/css/extensions/sweetalert2.min.css')}}">
  <!-- END: Vendor CSS-->

  <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/themes/semi-dark-layout.css')}}">
  <!-- END: Theme CSS-->

  <!-- BEGIN: Page CSS-->
      <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/core/menu/menu-types/vertical-menu.css')}}">
      <link rel="stylesheet" type="text/css" href="{{ asset('frest/css/pages/dashboard-ecommerce.css')}}">
  <!-- END: Page CSS-->

  <!-- BEGIN: Custom CSS-->
      <link rel="stylesheet" type="text/css" href="{{ asset('frest/assets/css/style.css')}}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css')}}">
  <!-- END: Custom CSS-->
  
  <!-- BEGIN: Toastr CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/vendors/css/extensions/toastr.css')}}">
  <!-- END: Toastr CSS-->

  <!-- BEGIN: Confirm jQuery CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <!-- END: Confirm jQuery CSS-->

  <!-- Begin : Datatable -->
  <link rel="stylesheet" type="text/css" href="{{ asset('frest/vendors/css/tables/datatable/datatables.min.css')}}">
  <!-- End : Datatable -->
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
  @yield('css')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 2-columns semi-dark-layout  navbar-sticky footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <div id="spinner"></div>

  <!-- BEGIN: Header-->
  <div class="header-navbar-shadow"></div>
  @include('admin.include.header')
  <!-- END: Header-->

  <!-- BEGIN: Main Menu-->
  @include('admin.include.sidebar')
  <!-- END: Main Menu-->

  <!-- BEGIN: Content-->
  <div class="app-content content">
  
      
    <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row"></div>
      <div class="content-body">
        <!-- Dashboard Ecommerce Starts -->
          @yield('main')
        <!-- Dashboard Ecommerce ends -->
      </div>
    </div>
  </div>
  <!-- END: Content-->




  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

<!-- BEGIN: Footer-->
  @include('admin.include.footer')
<!-- END: Footer-->

  <!-- BEGIN: Vendor JS-->
    <script>
        var assetBaseUrl = "index.html";
    </script>
    <script src="{{ asset('frest/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ asset('frest/fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
    <script src="{{ asset('frest/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
    <script src="{{ asset('frest/fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>
  <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
      <script src="{{ asset('frest/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
      <script src="{{ asset('frest/vendors/js/charts/apexcharts.min.js')}}"></script>
      <script src="{{ asset('frest/vendors/js/extensions/swiper.min.js')}}"></script>
    <!-- <script src="{{ asset('frest/js/scripts/extensions/toastr.js')}}"></script> -->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Datatable JS-->
      <script src="{{ asset('frest/vendors/js/tables/datatable/datatables.min.js')}}"></script>
      <script src="{{ asset('frest/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
      <script src="{{ asset('frest/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
      <script src="{{ asset('frest/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
      <script src="{{ asset('frest/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
      <script src="{{ asset('frest/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
      <script src="{{ asset('frest/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
      <script src="{{ asset('frest/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
      <script src="{{ asset('frest/js/scripts/datatables/datatable.js')}}"></script>
    <!-- END: Datatable JS-->




    <!-- BEGIN: Theme Script JS-->
      <script src="{{ asset('frest/js/scripts/configs/vertical-menu-light.js')}}"></script>
      <script src="{{ asset('frest/js/core/app-menu.js')}}"></script>
      <script src="{{ asset('frest/js/core/app.js')}}"></script>
      <script src="{{ asset('frest/js/scripts/components.js')}}"></script>
      <script src="{{ asset('frest/js/scripts/footer.js')}}"></script>
      <script src="{{ asset('frest/vendors/js/extensions/toastr.min.js')}}"></script>
    <!-- END: Theme Script JS-->

  @yield('js')
    <!-- BEGIN: Page JS-->
      <script src="{{ asset('frest/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->
     

<!-- Mirrored from www.pixinvent.com/demo/frest-bootstrap-laravel-admin-dashboard-template/demo-3/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2020 16:31:35 GMT -->
</html>
<script>
    $(function() {
        $('#logout').click(function(e) {
            e.preventDefault();
            $('#logout-form').submit()
        })
    })
  
  $(window).on('load', function(){
    $('#cover').fadeOut(1000);
  });

</script>