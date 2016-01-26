@extends('app')

@section('content')
	
	<div class="row">
		<div class="small-12 columns">
			<div class="skew orange">
				<h2>Bevestigen</h2>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="small-10 large-5 small-centered columns">
			<div class="panel">
				<div class="row column">
					@if($userData->is_guest == false)
						<h5>Deze gegevens van jou zijn bij ons bekend:</h5>
						<p class="small-5 columns"><strong>Naam: </strong></p> <p class="small-7 columns">{{$userData->name}}</p>
						<p class="small-5 columns"><strong>E-mail: </strong></p> <p class="small-7 columns">{{$userData->email}}</p>
						<p class="small-5 columns"><strong>Telefoon: </strong></p> <p class="small-7 columns">{{$userData->phonenumber}}</p>
					@else
						<h5>Wat leuk dat je bij ons besteld!</h5>
						<p class="lead">Om je volledig van dienst te kunnen zijn, hebben we een aantal gegevens van je nodig.</p>
					@endif
				</div>
				<div class="row column">
					<h5>Dit moet je weten over je bestelling:</h5>
					<p class="small-5 columns"><strong>Afhaalmoment:</strong></p>
					<p class="small-7 columns">{{$openingDayDate}} <br/> {{date('G\:i', strtotime($city->openingHoursFrom))}} - {{date('G\:i', strtotime($city->openingHoursTill))}}</p>
					<p class="small-5 columns"><strong>Het afhaalpunt:</strong></p>
					<p class="small-7 columns">{{$city->address}} {{$city->name}}</p>
					<p class="small-12 columns">De recepten zijn gemaakt door <strong>Eetcafe Spinoza</strong></p>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="small-10 large-5 small-centered columns large-uncentered top-product" id="order-overview">
			<div class="panel selector">
			@foreach($orderLines as $orderLine)
				<h2 class="ribbon"><span>
					{{ $productInfo[$orderLine->id]->name }}
				</span></h2>

				<div class="row">
					<span class="small-1 columns">-</span>
					@for ($i = 1; $i < 6; $i++)
						@if($orderLine->amount >= $i)
							<img class="small-2 columns svg selected" id="amount_{{$i}}" src="{{ URL::asset('img/icons/meal-icon-square.svg') }}" />
						@else
							<img class="small-2 columns svg" id="amount_{{$i}}" src="{{ URL::asset('img/icons/meal-icon-square.svg') }}" />
						@endif
					@endfor
					<span class="small-1 columns">+</span>
				</div>
				<div class="row">
					<div class="small-6 columns">
						<button class="button dark-green expanded price">&euro; ?</button>
					</div>
					<div class="small-6 columns">
						<button class="button orange expanded confirm-amount hidden" title="Bevestigen">
							Bevestigen
						</button>
						<button class="button orange expanded edit-amount" title="Bewerken">
							Wijzigen
						</button>
					</div>
				</div>
				<div class="row hidden" id="loading-icon">
					<div class="spinner">
						<div class="bounce1"></div>
						<div class="bounce2"></div>
						<div class="bounce3"></div>
					</div>
				</div>
			@endforeach
				<span>+</span>
				<hr>
				<div class="row">
					<div class="small-5 columns small-centered">
						<button class="button dark-green expanded price" id="total-price">&euro; 10,-</button>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
