@extends('app')

@section('content')
	
	<div class="row">
			<h1>Producten</h1>
			<hr/>

			@foreach($products as $product)
				
				<h2>
					<a href="{{ action('ProductsController@show', $product->name)}}" title="{{ $product->name }}">
						{{ $product->name }}
					</a>
				</h2>
					
				<p>{{ $product->description }}</p>
				@foreach($orderLines as $orderLine)
					@if($product['id'] == $orderLine['product_id'])

						{!! Form::open(['method' => 'PATCH', 'url' => 'bestelling/', 'class' => 'small-3 columns end']) !!}
							{!! Form::label('amount', 'Hoeveelheid besteld: ', ['class' => 'input-group-label']) !!}
							{!! Form::text('amount', $orderLine['amount'], ['class' => 'input-group-field']) !!}
							{!! Form::submit('Bijwerken', ['class' => 'button']) !!}
							{!! Form::hidden('product_id', $product['id']) !!}
						{!! Form::close() !!}
					@endif
				@endforeach
				<hr>
			@endforeach

			<a class="button" href="{{ action('OrdersController@overview')}}">Bestelling plaatsen!</a>

			<ul class="menu">
				<li>
					<a href="{{ action('CitiesController@index')}}" title="Markt wijzigen">Geselecteerde markt: {{$selectedCity['name']}}</a>
				</li>
				<li>
					<a href="{{ action('HomeController@reset')}}" title="DESTROY ALL HUMANS">Reset</a>
				</li>

			</ul>
	</div>
	
@stop
