@extends('app')

@section('content')
	
	<div class="row">
			<h1>Producten</h1>
			<hr/>

			@foreach($products as $product)
				<h2>
					{{ $product->name }}
				</h2>
					
				<p>{{ $product->description }}</p>
				<hr>
			@endforeach

			<ul class="menu">
				<li>
					<a href="{{ action('CitiesController@index')}}" title="Markt wijzigen">Geselecteerde markt: {{$selectedCity['name']}}</a>
				</li>
				<li>
					<a href="{{ action('CitiesController@destroyCity')}}" title="DESTROY ALL HUMANS">Reset</a>
				</li>

			</ul>
	</div>
	
@stop
