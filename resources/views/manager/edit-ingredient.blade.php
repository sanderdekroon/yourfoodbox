@extends('backend')

@section('content')
	<div class="row">
		<div class="small-12 columns">
		<a class="orange button" href="{{URL::action('IngredientsController@index')}}"><i class="fa fa-arrow-left"></i> Terug naar het overzicht</a>
		</div>
		<div class="small-6 columns">
			<h1>Ingredient {{$ingredient->name}} bewerken</h1>
			@include('errors.list')

			@if (session('status'))
			    <div class="callout primary">
			        {{session('status')}}
			    </div>
			@endif

			{!! Form::open(['method' => 'PATCH', 'url' => '/manager/ingredients/'.$ingredient->id]) !!}
				@include('manager._ingredient-form', ['submitButtonText' => 'Bewerken'])	
			{!! Form::close() !!}
		</div>

		<div class="small-6 columns">
			<h4>Dit ingredient komt voor in de volgende producten:</h4>
			<ul>
			@foreach($products as $product)
				<li>{{$product->name}} - Week {{$product->week_no}} {{$product->year}}</li>
			@endforeach
			</ul>
		</div>
		
	</div>

@stop

@section('javascript')
	
@stop
