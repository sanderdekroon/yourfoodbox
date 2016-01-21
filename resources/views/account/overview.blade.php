@extends('app')

@section('content')
	
	<div class="row">
		<h1>Account gegevens</h1>
	</div>
	<div class="row">
		<div class="large-6 small-12 columns">
			<ul class="tabs" data-tabs id="account-data">
				<li class="tabs-title @if (!$errors->any()) is-active @endif">
					<a href="#data" aria-selected="true">Jouw gegevens</a>
				</li>
				<li class="tabs-title @if ($errors->any()) is-active @endif">
					<a href="#edit">Gegevens aanpassen</a>
				</li>
			</ul>
			<div class="tabs-content" data-tabs-content="account-data">
				<div class="tabs-panel @if (!$errors->any()) is-active @endif" id="data">
					<h5>Deze gegevens van jou zijn bij ons bekend:</h5>
					<ul class="clear-list">
						<li>{{$user->name}}</li>
						<li>{{$user->email}}</li>
						<li>{{$user->phonenumber}}</li>
					</ul>
				</div>
				<div class="tabs-panel @if($errors->any()) is-active @endif" id="edit">
					@include('errors.list')

			        {!! Form::open(['action' => 'UsersController@update']) !!}
	                    {!! Form::label('name', 'Naam: ', ['class' => 'middle']) !!}
	                    {!! Form::text('name', $user->name) !!}
	                    {!! Form::label('email', 'E-mail adres: ', ['class' => 'middle']) !!}
	                    {!! Form::text('email', $user->email) !!}
	                    {!! Form::label('phonenumber', 'Telefoonnummer: ', ['class' => 'middle']) !!}
	                    {!! Form::text('phonenumber', $user->phonenumber) !!}
	                    {!! Form::submit('Bewerken', ['class' => 'button']) !!}
			        {!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<h3>Gemaakte bestellingen:</h3>
		@foreach ($orders as $order)
			<div class="large-6 small-12 callout columns">
				<h4>{{ $cityData[$order->id]['name'] }}</h4>
				<p>Aangemaakt op: {{$order->created_at->format('d-m-Y')}}<br/>
				Voor het laatst aangepast op: {{$order->updated_at->format('d-m-Y \o\m H:i') }} 
				({{$order->updated_at->diffForHumans() }})</p>
				
				<table width="100%">
					<thead>
						<tr>
							<th>Maaltijd</th>
							<th>Hoeveelheid</th>
							<th>Prijs</th>
							<th>Extra</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($orderLines[$order->id] as $orderLine)
							<tr>
								<td>{{$productData[$orderLine->id]->name}}</td>
								<td>{{$orderLine['amount']}}</td>
								<td>blub</td>
								<td>blab</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<p>
					Status: 
					<span class="succes label">{{$statusData[$order->id]->name}}</span>
					<span data-tooltip aria-haspopup="true" class="has-tip" data-disable-hover='false' tabindex=1 title="{{$statusData[$order->id]->description}}">?</span> 
				</p>
			</div>

		@endforeach
	</div>
@stop
