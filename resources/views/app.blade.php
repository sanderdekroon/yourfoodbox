<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Foundation | Welcome</title>
		<link rel="stylesheet" href="{{URL::asset('css/foundation.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('css/style.css')}}" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	</head>
	<body>
		@include('menu')

		@yield('content')

		@yield('footer')
		
		<script src="{{URL::asset('js/vendor/jquery.min.js')}}"></script>
	    <script src="{{URL::asset('js/vendor/what-input.min.js')}}"></script>
	    <script src="{{URL::asset('js/foundation.min.js')}}"></script>
	    <script src="{{URL::asset('js/app.js')}}"></script>
	</body>
</html>
