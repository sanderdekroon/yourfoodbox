@extends('app')

@section('content')

	<div class="small-10 medium-6 large-5 small-centered columns top-product">
		<div class="panel product-overview">
			<h2 class="ribbon"><span>
				<a href="{{ action('ProductsController@show', $product->name)}}" title="{{ $product->name }}">
					{{ $product->name }}
				</a>
			</span></h2>

			<div class="column row" id="product-data">
				<div class="small-4 columns">
					<img class="small-12 columns" src="{{URL::asset('img/icons/meat.svg')}}">
					<p class="small-12 columns"><small>Vlees</small></p>
				</div>
				<div class="small-4 columns">
					<img class="small-12 columns" src="{{URL::asset('img/icons/pan-1-difficulty.svg')}}">
					<p class="small-12 columns"><small>Gemakkelijk</small></p>
				</div>
				<div class="small-4 columns">
					<img class="small-12 columns" src="{{URL::asset('img/icons/15-min-duration.svg')}}">
					<p class="small-12 columns"><small>Circa 15 min</small></p>
				</div>
			</div>

			<div class="column row">
				<h4 class="light-green-text alt-font">Wat zit er in?</h4>
				<ul class="menu ingredients-list">
				@foreach($ingredients as $ingredient)
					<li class="small-6 medium-4 large-4 columns end">
						{{$ingredient['name']}}
					</li>
				@endforeach
				</ul>
			</div>

			<div class="column row">
				<h4 class="light-green-text alt-font">Zelf toevoegen</h4>
				<ul class="menu ingredients-list">
					<li class="small-6 medium-4 large-4 columns end">Peper &amp; Zout</li>
					<li class="small-6 medium-4 large-4 columns end">(Olijf)olie</li>
				</ul>
			</div>

			<div class="row">
				<div class="small-6 columns">
					<button class="button orange expanded add-products" id="product_{{$product['id']}}">Recipe (for disaster)</button>
				</div>
				<div class="small-6 columns">
					<a class="button orange expanded" href="{{ action('ProductsController@index')}}" title="{{ $product->name }} bestellen">
						Bestellen
					</a>
				</div>
			</div>
		</div>
		
	</div>
	
@stop
