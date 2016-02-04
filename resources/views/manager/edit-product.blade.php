@extends('backend')

@section('content')
	<div class="row">
		<div class="small-12 columns">
			<a class="orange button" href="{{URL::action('ManagerController@listProducts')}}"><i class="fa fa-arrow-left"></i> Terug naar het overzicht</a>
		</div>
		{!! Form::open(['method' => 'PATCH', 'url' => '/manager/products/'.$product->id]) !!}
		<div class="small-6 columns">
			<h1>Product {{$product->name}} bewerken</h1>
			<p>Bewerk hier de gegevens van het product {{$product->name}}. 
			De ingredienten die gekoppeld staan dit product kunnen ook bewerkt worden.</p>
			@include('errors.list')

			@if (session('status'))
			    <div class="callout primary">
			        {{session('status')}}
			    </div>
			@endif

			
				<div class="small-6 columns">
					<div class="input-group">
						{!! Form::label('week_no', 'Weeknummer: ', ['class' => 'input-group-label']) !!}
						{!! Form::text('week_no', $product->week_no, ['class' => 'input-group-field']) !!}
					</div>
				</div>

				<div class="small-6 columns">
					<div class="input-group">
						{!! Form::label('year', 'Jaar: ', ['class' => 'input-group-label']) !!}
						{!! Form::text('year', $product->year, ['class' => 'input-group-field']) !!}
					</div>
				</div>

				<div class="small-12 columns">
					<div class="input-group">
						{!! Form::label('name', 'Naam: ', ['class' => 'input-group-label']) !!}
						{!! Form::text('name', $product->name, ['class' => 'input-group-field']) !!}
					</div>
				</div>

				<div class="small-12 columns">
					{!! Form::label('description', 'Omschrijving: ') !!}
					{!! Form::textarea('description', $product->description) !!}
				</div>
		</div>

		<div class="small-6 columns">
			<h2>Ingredienten in dit product:</h2>
			<label for="select-ingredient">Ingredienten:</label>
			<select id="select-ingredient" name="ingredient-list[]" placeholder="Selecteer ingredienten..."></select>
			<br/><br/><br/>
			{!! Form::submit('Bewerken', ['class' => 'button expanded light-green']) !!}
		</div>
		{!! Form::close() !!}
	</div>

@stop

@section('javascript')
	<script src="{{URL::asset('js/selectize.js')}}"></script>
	<script type="text/javascript">
		$("#select-ingredient").selectize({
			persist: false,
		    maxItems: null,
		    valueField: 'name',
		    labelField: 'name',
		    searchField: ['name'],
		    options: [
		    	@foreach($allIngredients as $ingredient)
				{ name: '{{$ingredient->name}}', id: {{$ingredient->id}} },
				@endforeach
		    ],
	    	items: [
	    		@foreach($ingredientsInProduct as $ingredient)
	    			'{{$ingredient->name}}',
	    		@endforeach
	    	],
			create:true
		});
		</script>
@stop
