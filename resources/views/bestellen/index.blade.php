@extends('app')

@section('content')
	<div class="row">
		<div class="small-12 columns">
			<div class="skew orange">
				<h2>Kies je maaltijden:</h2>
			</div>
		</div>
	</div>
	<div class="row">
	@foreach($products as $product)
	<div class="small-10 large-5 small-centered columns large-uncentered top-product" id="product_{{$product->id}}">
		@if(array_search($product['id'], array_column($orderLines, 'product_id')) === false)
			<div class="panel product-overview">
		@else
			<div class="panel product-overview hidden">
		@endif
			<h2 class="ribbon"><span>
				<a href="#" title="{{ $product->name }}">
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

			<div class="row">
				@if(array_search($product['id'], array_column($orderLines, 'product_id')) === false)
					{!! Form::open(['url' => 'bestelling/', 'id' => 'form_'.$product['id']]) !!}
						{!! Form::hidden('amount', "0", ['class' => 'input-group-field']) !!}
						{!! Form::hidden('product_id', $product['id'], ['class' => 'input-group-field']) !!}
						{!! Form::submit('Bijwerken', ['class' => 'hidden']) !!}
					{!! Form::close() !!}
				@else
					@foreach($orderLines as $orderLine)
						@if($product['id'] == $orderLine['product_id'])
							{!! Form::open(['url' => 'bestelling/', 'id' => 'form_'.$product['id']]) !!}
								{!! Form::hidden('amount', $orderLine['amount'], ['class' => 'input-group-field']) !!}
								{!! Form::hidden('product_id', $product['id'], ['class' => 'input-group-field']) !!}
								{!! Form::submit('Bijwerken', ['class' => 'hidden']) !!}
							{!! Form::close() !!}
						@endif
					@endforeach
				@endif
			</div>

			<div class="column row hidden" id="ingredients-list">
				<p class="small-12 columns">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
				<h4 class="small-12 columns light-green-text alt-font">Wat zit er in?</h4>
				<ul class="menu small-10 columns">
				@foreach($ingredients[$product['id']] as $ingredient)
					<li class="small-6 columns end">
						{{$ingredient['name']}}
					</li>
				@endforeach
				</ul>
				<h4 class="small-12 columns light-green-text alt-font">Zelf toevoegen</h4>
				<ul class="menu small-10 columns">
					<li class="small-6 columns end">Peper &amp; Zout</li>
					<li class="small-6 columns end">(Olijf)olie</li>
				</ul>
				
			</div>


			<div class="row">
				<div class="small-6 columns">
					<button class="button orange expanded add-products" id="product_{{$product['id']}}">Toevoegen</button>
				</div>
				<div class="small-6 columns">
					<button class="button orange expanded show-product" title="{{ $product->name }} bekijken">
						Bekijken
					</button>
				</div>
			</div>

		</div>
		@if(array_search($product['id'], array_column($orderLines, 'product_id')) === false)
			<div class="panel selector hidden">
			<h2 class="ribbon hidden"><span>
		@else
			<div class="panel selector disabled">
			<h2 class="ribbon"><span>
		@endif
				<a href="#" title="{{ $product->name }}">
					{{ $product->name }}
				</a>
			</span></h2>
			<div class="row">
				<span class="small-1 columns">-</span>

				@if(array_search($product['id'], array_column($orderLines, 'product_id')) === false)
					@for ($i = 1; $i < 6; $i++)
						<img class="small-2 columns svg" id="amount_{{$i}}" src="{{ URL::asset('img/icons/meal-icon-square.svg') }}" />
					@endfor
				@else
					@foreach($orderLines as $orderLine)
						@if($product['id'] == $orderLine['product_id'])
							@for ($i = 1; $i < 6; $i++)
								@if($orderLine['amount'] >= $i)
									<img class="small-2 columns selected" id="amount_{{$i}}" src="{{ URL::asset('img/icons/meal-icon-square.svg') }}" />
								@else
									<img class="small-2 columns" id="amount_{{$i}}" src="{{ URL::asset('img/icons/meal-icon-square.svg') }}" />
								@endif
							@endfor
						@endif
					@endforeach
				@endif
				<span class="small-1 columns">+</span>
			</div>
			<div class="row">
				<div class="small-6 columns">
					<button class="button dark-green expanded price">&euro; ?</button>
				</div>
				<div class="small-6 columns">
					@if(array_search($product['id'], array_column($orderLines, 'product_id')) === false)
						<button class="button orange expanded confirm-amount" title="Bevestigen">
							Bevestigen
						</button>
						<button class="button orange expanded edit-amount hidden" title="Bewerken">
							Wijzigen
						</button>
					@else
						<button class="button orange expanded confirm-amount hidden" title="Bevestigen">
							Bevestigen
						</button>
						<button class="button orange expanded edit-amount" title="Bewerken">
							Wijzigen
						</button>
					@endif
				</div>
			</div>
			<div class="row hidden" id="loading-icon">
				<div class="spinner">
					<div class="bounce1"></div>
					<div class="bounce2"></div>
					<div class="bounce3"></div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	</div>
@stop

@section('javascript')
	<script src="{{ URL::asset('js/selector.js') }}"></script>
@stop