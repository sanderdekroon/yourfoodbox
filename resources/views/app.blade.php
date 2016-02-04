<!doctype html>
<html class="no-js" lang="nl">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Krat en Klaar | Home</title>
		<link rel="stylesheet" href="{{URL::asset('css/foundation.min.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('css/style.css')}}" />
		<!-- Remove style.css on production -->
		<link rel="stylesheet" href="{{URL::asset('css/app.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('css/ribbon.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('css/animate.css')}}" />
		<link href='https://fonts.googleapis.com/css?family=Arimo:700' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id="page">
			@include('menu')

			@yield('content')
			
		</div>
		<script src="{{URL::asset('js/vendor/jquery.min.js')}}"></script>
	    <script src="{{URL::asset('js/foundation.min.js')}}"></script>
	    <script src="{{URL::asset('js/app.js')}}"></script>
	    <script src="{{ URL::asset('js/menu.js') }}"></script>
		<script type="text/javascript">
			$(document).ready(function(e){
				$(".ribbon").width($(".top-product").width()+22);
			});
			$(window).resize(function(e){
				$(".ribbon").width($(".top-product").width()+22);
			});
		</script>

	    @yield('javascript')
	</body>
</html>
