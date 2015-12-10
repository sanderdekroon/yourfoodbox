@extends('app')

@section('content')
	
	<div class="row">
		<h1>Bestellingen</h1>
		<hr/>

		@foreach($orders as $order)
		<div class="small-6 columns callout">
				<p><strong>Bestelling Nummer: {{$order['id']}}</strong> <br/>Status: {{$order['status']}} Markt: {{$order['city_id']}}. </p>
				
					
					@foreach($orderlines[$order['id']] as $orderline)
					<ul class="small-5 columns">
						<li>Product: {{$orderline['product_id']}}</li>
						<li>Hoeveelheid: {{$orderline['amount']}}</li>
					</ul>
					@endforeach
				<p>Bestelling geplaatst op: {{$order['updated_at']->format('d-m-y H:i') }} ({{$order['updated_at']->diffForHumans() }})</p>
		</div>
		@endforeach

	</div>
	
@stop
