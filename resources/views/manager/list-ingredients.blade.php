@extends('backend')

@section('content')
	<div class="row">
		<h1>Ingredienten beheer</h1>
		
		@foreach($ingredients as $ingredient)
			<div class="small-3 columns end">
				<div class="panel">
					<h5>
						{{$ingredient->name}}
						<a class="light-green-text" href="{{URL::action('IngredientsController@show', $ingredient->id)}}"><i class="fa fa-pencil"></i></a>
						<a class="orange-text" href="#"><i class="fa fa-times"></i></a>
					</h5>
					<p>{{$ingredient->unit}} product, {{$ingredient->type}}, per {{$ingredient->min_amount}}</p>

				</div>
			</div>
		@endforeach
	</div>

@stop

@section('javascript')
	
@stop
