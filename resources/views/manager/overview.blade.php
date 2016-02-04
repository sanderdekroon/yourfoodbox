@extends('backend')

@section('content')
	
	<div class="row" id="order-overview">
		<h1>Bestellingen</h1>

		@if(!count($orders))
			<div class="small-12 large-6 columns end warning callout">
				<h5>Er zijn geen (actieve) bestellingen gevonden</h5>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
				<a href="/orders" class="close-button" aria-label="Dismiss alert" type="button">
					<span aria-hidden="true">&#8635;</span>
				</a>
			</div>
		@endif
		@foreach($orders as $order)
		<div class="small-6 columns panel no-ribbon end {{$statusData->where('id', $order->status_id)->first()['name']}}">
			<div class="small-8 columns">
				<h5>Persoonsgegevens:</h5>
				<ul>
					<li>{{$userData[$order['id']]->name}}</li>
					<li>Tel.: {{$userData[$order['id']]->phonenumber}}</li>
					<li>E-mail: {{$userData[$order['id']]->email}}</li>
				</ul>
			</div>
			<p class="small-4 columns">
				<strong>Bestelling nr: {{$order['id']}}</strong> <br/>

				Markt: {{$cityData[$order->id]['name']}}
			</p>
		
			<div class="small-12 columns">
				<h5>Bestelling:</h5>
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
				<strong>Bestelling geplaatst op: </strong><br/>
				{{$order['created_at']->format('d-m-y H:i') }} 
				({{$order['created_at']->diffForHumans() }})
			</p>
			<p class="small-12 columns">
				<strong>Bestelling voor het laatst aangepast op: </strong><br/>
				{{$order['updated_at']->format('d-m-y H:i') }} 
				({{$order['updated_at']->diffForHumans() }})
			</p>
			<div class="small-12 columns">
				<strong>Status bijwerken:</strong>
				
				{!! Form::open(['method' => 'PATCH', 'url' => '/manager/orders', 'id' => 'order'.$order->id, 'name' => 'order'.$order->id]) !!}
					{!! Form::hidden('order_id', $order->id) !!}

					<select name="status" id="order{{$order->id}}" class="status-update">
					@foreach ($statusData as $status)
						@if ($status->id == $order->status_id)
						<option selected="selected" value="{{$status->id}}">{{$status->name}} - {{$status->description}}</option>
						@else
						<option value="{{$status->id}}">{{$status->name}} - {{$status->description}}</option>
						@endif
						
					@endforeach
					</select>

					{!! Form::submit('Bijwerken') !!}
				{!! Form::close() !!}
			</div>
		</div>
		@endforeach
	</div>

@stop

@section('javascript')
	<script type="text/javascript">
		$("select.status-update").on("change", function(event) {
			$(this).parents("form").submit();
		});
	</script>
@stop
