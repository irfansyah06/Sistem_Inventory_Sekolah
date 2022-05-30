<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Sistem Inventory Sekolah</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('templete/vendors/images/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('templete/vendors/images/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('templete/vendors/images/favicon-16x16.png')}}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('templete/vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('templete/vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('templete/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('templete/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('templete/vendors/styles/style.css')}}">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
    {{-- JS Filter --}}
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- End JS Filter --}}
</head>
<body>

	{{--  Header  --}}
    @include('layouts.header')

	{{--  Setting Tema  --}}
    @include('layouts.SettingTema')

	{{--  Sidebar  --}}
    @include('layouts.sidebar')

	<div class="main-container">
		<div class="pd-ltr-20">

            {{--  Content  --}}
            @yield('content')

			{{--  Footer  --}}
            @include('layouts.footer')
		</div>
	</div>
    {{--  Alert  --}}
    @include('sweetalert::alert')
	<!-- js -->
	<script src="{{asset('templete/vendors/scripts/core.js')}}"></script>
	<script src="{{asset('templete/vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('templete/vendors/scripts/process.js')}}"></script>
	<script src="{{asset('templete/vendors/scripts/layout-settings.js')}}"></script>
	<script src="{{asset('templete/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('templete/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('templete/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('templete/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
	<script src="{{asset('templete/vendors/scripts/dashboard.js')}}"></script>
    <!-- Datatable Setting js -->
	{{--  <script src="{{asset('templete/vendors/scripts/datatable-setting.js')}}"></script></body>  --}}
</body>
</html>
