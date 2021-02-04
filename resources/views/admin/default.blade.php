<!DOCTYPE html>

<html lang="en">
	
	<head>

   		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<meta name="description" content="">

		<meta name="author" content="">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{config('app.name')}} | {{ $title }}</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Font Awesome -->
		<!-- <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}"> -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Tempusdominus Bbootstrap 4 -->
		<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
		<!-- iCheck -->
		<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
		<!-- JQVMap -->
		<link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
		<!-- DataTables -->
		<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}} ">
		<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}} ">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css')}}">
		<!-- overlayScrollbars -->
		<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
		<!-- Daterange picker -->
		<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
		<!-- summernote -->
		<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">
		<!-- Toastr -->
  		<link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

		<!-- Confirm jQuery CSS-->
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	    <!-- Sweet Alert 2 CSS-->
	    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css')}}">	   
   		@yield('css')

 	</head>

 	<body class="hold-transition sidebar-mini layout-fixed">

 		<div class="wrapper">

 			<!-- Navbar -->
				@include('admin/partials.header_navbar') <!-- add @ before include method to show header_sidebar -->
			<!-- /.navbar -->
			
			<!-- Main Sidebar Container -->
				@include('admin/partials.sidebar')
			<!-- /.sidebar -->

			<div class="content-wrapper">
			   
			   	<!-- Content Header (Page header) -->
					@include('admin/partials.content_header')
			   	<!-- /.content-header -->

				<!-- Content Wrapper. Contains page content -->
					@yield('content')
				<!-- /.content-wrapper -->
			</div>


			<footer class="main-footer">
			    <strong>Copyright &copy; 2020-2021 <a href="https://www.parkhya.com/">Parkhya IT Solution</a>.</strong>
			    All rights reserved.
			    <div class="float-right d-none d-sm-inline-block">
			       <b>Version</b> 3.0.0
			    </div>
			</footer>

		</div>

		<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button)
		</script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- ChartJS -->
		<script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
		<!-- Sparkline -->
		<script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
		<!-- JQVMap -->
		<!-- <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
		<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script> -->
		<!-- jQuery Knob Chart -->
		<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
		<!-- daterangepicker -->
		<script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
		<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
		<!-- Tempusdominus Bootstrap 4 -->
		<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
		<!-- Summernote -->
		<script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
		<!-- overlayScrollbars -->
		<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
		<!-- DataTables -->
		<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }} "></script>
		<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }} "></script>
		<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }} "></script>
		<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }} "></script>
		<!-- Toastr -->
		<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('adminlte/dist/js/adminlte.js')}}"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="{{ asset('adminlte/dist/js/pages/dashboard.js')}}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>
		<!-- jquery-confirm3 js -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
		<!-- sweet-alert2 js -->
		<script src="{{ asset('plugins/sweetalert2/sweetalert2.js')}}"></script>
		<!-- Backend JS -->
		<script src="{{ asset('js/back.js')}}"></script>
		<!-- My Custom JS -->
		<script src="{{ asset('js/my_custom.js')}}"></script>
		<!-- ck editor -->
	    <script type="text/javascript" src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
	    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.15.1/adapters/jquery.min.js"></script>
		@yield('js')

	</body>

</html>