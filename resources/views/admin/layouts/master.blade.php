<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title') Shop :: Administrative Panel</title>
		<!-- Google Font: Source Sans Pro -->
		{{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
		<link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/all.css') }}">
        <!-- Font Awesome -->
		{{-- <link rel="stylesheet" href="{{ asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}"> --}}
		<!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/datetimepicker.css') }}">

        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/summernote/summernote-bs4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/dropzone/dropzone.css') }}">
		<link rel="stylesheet" href="{{ asset('admin_assets/css/adminlte.min.css') }}">
		<link rel="stylesheet" href="{{ asset('admin_assets/css/custom.css') }}">



        <meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body class="hold-transition sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">
			@include('admin.layouts.header')
			@include('admin.layouts.sidebar')
			@yield('content')
			@include('admin.layouts.footer')

		</div>
		<!-- ./wrapper -->

		<!-- jQuery -->
		{{-- <script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script> --}}
        <script src="{{ asset('admin_assets/js/jquery-3.7.1.min.js') }}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('admin_assets/js/adminlte.min.js') }}"></script>

        <script src="{{ asset('admin_assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

        <script src="{{ asset('admin_assets/plugins/dropzone/min/dropzone.min.js') }}"></script>

        <script src="{{ asset('admin_assets/js/datetimepicker.js') }}"></script>


		<!-- AdminLTE for demo purposes -->
		<script src="{{ asset('admin_assets/js/demo.js') }}"></script>

        <script src="{{ asset('admin_assets/plugins/select2/js/select2.min.js') }}"></script>

        <script src="{{ asset('fontawesome-free-6.5.1-web/js/all.js') }}"></script>






        <script>
            $.ajaxSetup({

                headers:
                {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }

            });
        </script>

        <script>
            $(document).ready(function(){

                $(".summernote").summernote({


                    height: 250

                });


            });
        </script>

        @yield('customejs')

	</body>
</html>
