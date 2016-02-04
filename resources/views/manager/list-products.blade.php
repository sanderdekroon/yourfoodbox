@extends('backend')

@section('content')
	<div class="row">
		<h1>Producten beheer</h1>
			<p><a class="button light-green" id="add-new-product" href="#">Nieuw product aanmaken</a></p>

			<div id="new-product-form" class="hidden">
				<h4>Maak een nieuw product aan</h4>
				<p>Voer eerst het weeknummer en jaar in. Vervolgens de titel en de omschrijving. 
				Voer als laatste de ingredienten in die bij dit product horen.
				Als een ingredient niet in de lijst staat, kun je deze gewoon toevoegen.</p>
				@include('errors.list')

				{!! Form::open(['url' => '/manager/products']) !!}
					@include('manager._product-form', ['submitButtonText' => 'Opslaan'])	
				{!! Form::close() !!}
			</div>

		{{-- */$previousYear = null/* --}}
		{{-- */$previousWeek = null/* --}}
		@foreach($products as $product)
			@if($previousYear != $product->year || $previousWeek != $product->week_no)
				</div>
				<div class="row">
				<h2>Week {{$product->week_no}} - {{$product->year}}</h2>
			@endif
			<div class="small-4 columns end">
				<div class="panel">
					<p>Week {{$product->week_no}} - {{$product->year}}</p>
					<h5>
						{{$product->name}}
						@if($product->week_no >= date('W'))
						<a class="light-green-text" href="{{URL::action('ProductsController@edit', $product->id)}}"><i class="fa fa-pencil"></i></a>
						<a class="orange-text" href="#"><i class="fa fa-times"></i></a>
						@endif
					</h5>
					<p>{{$product->description}}</p>
					
				</div>
			</div>
			{{-- */$previousYear = $product->year/* --}}
			{{-- */$previousWeek = $product->week_no/* --}}
		@endforeach
	</div>

@stop

@section('javascript')
	<script src="{{URL::asset('js/selectize.js')}}"></script>
	<script type="text/javascript">
		$("#add-new-product").on("click", function(e){
			e.preventDefault();
			$("#new-product-form").slideDown();
			$("#add-new-product").hide();
		})
		
		$("#select-ingredient").selectize({
			persist: false,
		    maxItems: null,
		    valueField: 'name',
		    labelField: 'name',
		    searchField: ['name'],
		    options: [
		    	@foreach($ingredients as $ingredient)
				{ name: '{{$ingredient->name}}', id: {{$ingredient->id}} },
				@endforeach
		    ], 
			create:true
		});
	</script>
@stop
