@extends('app')

@section('content')

	<div class="row">
		<div class="small-12 columns">
			<div class="skew orange">
				<h2>Bestelling geslaagd</h2>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="small-10 large-5 small-centered columns">
			<div class="panel">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<div class="small-6 columns small-centered">
					<a class="light-green button expanded" href="{{URL::action('HomeController@index')}}">Ga verder</a>
				</div>
			</div>
		</div>
	</div>
	
	
	
@stop
