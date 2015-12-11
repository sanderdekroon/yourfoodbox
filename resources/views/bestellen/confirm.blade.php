@extends('app')

@section('content')
	
	<div class="row">
		<h1>Bestelling Bevestigen</h1>
	</div>
		@if($userData->is_guest == false)
			<div class="row">
				<div class="small-6 columns callout success">
					<h5>Deze gegevens van jou zijn bij ons bekend:</h5>
					<ul class="clear-list">
						<li>{{$userData->name}}</li>
						<li>{{$userData->email}}</li>
						<li>{{$userData->phonenumber}}</li>
					</ul>
				</div>
				<div class="small-4 columns callout secondary">
					<ul>
						<li><a href="#">Gegevens aanpassen</a></li>
						<li><a href="#">Gegevens aanpassen</a></li>
						<li><a href="#">Gegevens aanpassen</a></li>
						<li><a href="#">Gegevens aanpassen</a></li>
					</ul>
				</div>
			</div>
		@else
			<h5>Wat leuk dat je bij ons besteld!</h5>
			<p class="lead">Om je volledig van dienst te kunnen zijn, hebben we een aantal gegevens van je nodig.</p>
		@endif
		
		<div class="row">
		@foreach($orderLines as $orderLine)
			<div class="small-6 columns end">
				
				<div class="row">
					<h4>{{$productInfo[$orderLine->id]->name}}</h4>
					<p>{{$productInfo[$orderLine->id]->description}}</p>

					<p>Besteld: {{$orderLine['amount']}}x</p>
				</div>
				<div class="row">
					@include('errors.list')

					{!! Form::open(['method' => 'PATCH', 'url' => 'bestellen/', 'class' => 'small-3 columns']) !!}
						{!! Form::label('amount', 'Aantal: ', ['class' => 'input-group-label']) !!}
						{!! Form::text('amount', $orderLine['amount'], ['class' => 'input-group-field']) !!} <br/>
						{!! Form::submit('Aantal bijwerken', ['class' => 'button']) !!}
						{!! Form::hidden('product_id', $orderLine['product_id']) !!}
					{!! Form::close() !!}
				</div>

			</div>
		@endforeach
		</div>
			<div class="small-6 columns end">
				<a class="button" href="#" title="Bestelling Plaatsen">Bestelling bevestigen</a>
			</div>
	</div>
	
@stop
