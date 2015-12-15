@extends('app')

@section('content')
	
	<div class="row">
		<h1>Gerecht</h1>
		<hr/>

			<h2>
				{{ $product->name }}
			</h2>
				
			<p>{{ $product->description }}</p>

		<ul class="small-6 columns">
			@foreach($ingredients as $ingredient)
			<li>
				{{ $ingredient['min_amount']}} {{ $ingredient['name'] }}
			</li>
			@endforeach
		</ul>

		<div class="small-5 columns">
			@include('errors.list')

			{!! Form::open(['url' => 'bestelling']) !!}
					{!! Form::hidden('product_id', $product->id) !!}
					{!! Form::label('amount', 'Hoeveelheid: ') !!}
					{!! Form::text('amount', null) !!}
					{!! Form::submit('Toevoegen', ['class' => 'button']) !!}
			{!! Form::close() !!}
		</div>
	</div>
	
@stop
