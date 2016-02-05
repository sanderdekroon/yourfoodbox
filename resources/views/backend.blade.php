<!doctype html>
<html class="no-js" lang="nl">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Krat en Klaar | Home</title>
		<link rel="stylesheet" href="{{URL::asset('css/foundation.min.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('css/manager.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('css/ribbon.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('css/selectize.css')}}" />
		<link href='https://fonts.googleapis.com/css?family=Arimo:700' rel='stylesheet' type='text/css'>
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> -->
	</head>
	<body>
		@include('manager.manager-menu')

		@yield('content')

		<footer class="row">
			<hr/>
			<p>&copy; {{date('Y')}} Krat en Klaar</p>
		</footer>

		<div class="reveal" id="closeManager" data-reveal>
			<h1>Manager afsluiten.</h1>
			<p>Weet je zeker dat je de manager wilt afsluiten?</p>
			<div class="small-6 columns light-green">
				<a class="button light-green expanded" href="{{URL::action('HomeController@index')}}" title="Terug">
					Afsluiten
				</a>
			</div>
			<div class="small-6 columns">
				<button class="button orange expanded" data-close aria-label="Close modal" type="button">
					<span aria-hidden="true">Annuleren</span>
				</button>
			</div>
			<button class="close-button" data-close aria-label="Close modal" type="button">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		<script src="{{URL::asset('js/vendor/jquery.min.js')}}"></script>
	    <script src="{{URL::asset('js/foundation.min.js')}}"></script>
	    <script src="{{URL::asset('js/app.js')}}"></script>
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
