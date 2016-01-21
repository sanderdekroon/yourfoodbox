<!doctype html>
<html class="no-js" lang="nl">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Krat en Klaar | Home</title>
		<link rel="stylesheet" href="{{URL::asset('css/foundation.min.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('css/style.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('css/app.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('css/mmenu.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('css/ribbon.css')}}" />
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
	    <script src="{{URL::asset('js/mmenu.js')}}"></script>
	    <script type="text/javascript">
			$(document).ready(function() {
				$("#menu").mmenu({
					offCanvas: {
						position : "right",
						zposition : "front"
					},
					navbar: {
						title : "<img id=\"close-menu-button\" src=\"img/icons/menu-icon-white.svg\">"
					}
				});
				var api = $("#menu").data( "mmenu" );
				$(".mm-title").on( "click", function() {
					api.close();
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function(e){
				$(".ribbon").width($(".ribbon").parent().width()+20);
			});
			$(window).resize(function(e){
				$(".ribbon").width($(".ribbon").parent().width()+20);
			});
		</script>

	    @yield('javascript')
	</body>
</html>
