@extends('app')

@section('content')
	
	<div class="row">
		<h1>Bestellingen</h1>
		<hr/>

		@foreach($orders as $order)
		<div class="small-6 columns callout">
			<div class="small-8 columns">
				<h4>Persoonsgegevens:</h4>
				<ul>
					<li>{{$userData[$order['id']]->name}}</li>
					<li>Tel.: {{$userData[$order['id']]->phonenumber}}</li>
					<li>E-mail: {{$userData[$order['id']]->email}}</li>
				</ul>
			</div>
			<p class="small-4 columns">
				<strong>Bestelling nr: {{$order['id']}}</strong> <br/>
				Status: {{$statusData[$order->id]['name']}} 
				Markt: {{$cityData[$order->id]['name']}}
			</p>
		
			<div class="small-12 columns">
				<h4>Bestelling:</h4>
				@foreach($orderlines[$order['id']] as $orderline)
				<p class="small-6 columns">
					@foreach($productData as $product)
						@if($product['id'] == $orderline['product_id'])
							Product: {{$product['name']}}
						@endif
					@endforeach
				</p>
				<p class="small-6 columns">
					Hoeveelheid: {{$orderline['amount']}}
				</p>
				@endforeach
			</div>
					
			<p class="small-12 columns">
				Bestelling geplaatst op: 
				{{$order['updated_at']->format('d-m-y H:i') }} 
				({{$order['updated_at']->diffForHumans() }})
			</p>
		</div>
		@endforeach

	</div>
	
@stop
