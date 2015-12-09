@extends('app')

@section('content')
	
	<div class="row">
			<h1>Steden</h1>
			<hr/>
			<ul>
			@foreach($cities as $city)
				<li><a href="{{ action('CitiesController@setCity', $city->name) }}" title="{{ $city->name }}">{{ $city->name }}</a></li>
			@endforeach
			</ul>
	</div>
	
@stop
