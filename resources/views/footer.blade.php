<div id="footer-menu" class="orange">
	<div class="row">
		<div class="small-4 medium-3 large-3 columns no-padding" id="city-selection-overlay">
			<div class="row close-city-overlay">
				<div class="small-4 large-3 columns">
					<img class="no-padding" src="{{URL::asset('img/icons/location-marker.svg')}}">
				</div>
				<div class="small-8 large-9 no-padding columns">
					<p class="white-text">Geselecteerd:</p>
					<h4 class="white-text">Leeuwarden</h4>
				</div>
			</div>
			<div class="column row">
				<h6 class="white-text">Het afhaalpunt:</h6>
				<p class="white-text">W. Alexanderplein<br/>Postcode 8900HM</p>
				<h6 class="white-text">Afhaalmoment:</h6>
				<p class="white-text">Vrijdag 09:00 - 17:00</p>
				<p class="white-text">De recepten zijn gemaakt door <strong>Eetcafe Spinoza</strong></p>
			</div>
			<div class="column row">
				<a class="white button expanded orange-text" href="#">Amsterdam</a>
				<a class="white button expanded orange-text" href="#">Drachten</a>
				<a class="white button expanded disabled orange-text" href="#">Leeuwarden</a>
				<a class="white button expanded orange-text" href="#">Heerenveen</a>
			</div>
		</div>

		<div class="small-4 medium-3 large-3 columns no-padding" id="city-selection">
			<div class="small-4 large-3 columns">
				<img class="no-padding" src="{{URL::asset('img/icons/location-marker.svg')}}">
			</div>
			<div class="small-8 large-9 no-padding columns">
				<p class="white-text">in<br/><strong>Leeuwarden</strong></p>
			</div>
		</div>

		<div class="small-4 medium-4 large-4 small-offset-8 columns no-padding" id="total-meal-overlay">
			<div class="row close-meal-overlay">
				<div class="small-4 columns">
					<img class="no-padding" src="{{URL::asset('img/icons/meal-icon-white.svg')}}">
				</div>
				<div class="small-8 no-padding columns">
					{{-- */$i=0;/* --}}
					@foreach($orderLines as $orderLine)
						{{-- */$i += $orderLine['amount'];/* --}}
					@endforeach

					@if ($i < 1)
						{{-- */$i="Geen";/* --}}

					@endif
					
					<p class="white-text"><strong>{{$i}}</strong> maaltijden</p>
				</div>
				<div class="columns row meal-overview">
					<h6>Pasta Pesto: &euro;?,-</h6>
					<img class="small-4 medium-3 large-2 columns" src="{{URL::asset('img/icons/meal-icon-square-white.svg')}}">
					<img class="small-4 medium-3 large-2 columns" src="{{URL::asset('img/icons/meal-icon-square-white.svg')}}">
					<img class="small-4 medium-3 large-2 columns disabled" src="{{URL::asset('img/icons/meal-icon-square-white.svg')}}">
					<img class="small-4 medium-3 large-2 columns disabled" src="{{URL::asset('img/icons/meal-icon-square-white.svg')}}">
					<img class="small-4 medium-3 large-2 columns disabled" src="{{URL::asset('img/icons/meal-icon-square-white.svg')}}">
					<img class="small-4 medium-3 large-2 columns disabled" src="{{URL::asset('img/icons/meal-icon-square-white.svg')}}">
				</div>
				<div class="columns row meal-overview">
					<h6>Spaghetti: &euro;?,-</h6>
					<img class="small-4 medium-3 large-2 columns" src="{{URL::asset('img/icons/meal-icon-square-white.svg')}}">
					<img class="small-4 medium-3 large-2 columns" src="{{URL::asset('img/icons/meal-icon-square-white.svg')}}">
					<img class="small-4 medium-3 large-2 columns" src="{{URL::asset('img/icons/meal-icon-square-white.svg')}}">
					<img class="small-4 medium-3 large-2 columns" src="{{URL::asset('img/icons/meal-icon-square-white.svg')}}">
					<img class="small-4 medium-3 large-2 columns disabled" src="{{URL::asset('img/icons/meal-icon-square-white.svg')}}">
					<img class="small-4 medium-3 large-2 columns disabled" src="{{URL::asset('img/icons/meal-icon-square-white.svg')}}">
				</div>
			</div>
		</div>

		<div class="small-4 medium-4 large-4 columns no-padding" id="total-meal">
			<div class="small-4 columns">
				<img src="{{URL::asset('img/icons/meal-icon-white.svg')}}">
			</div>
			<div class="small-8 no-padding columns">
				{{-- */$i=0;/* --}}
				@foreach($orderLines as $orderLine)
					{{-- */$i += $orderLine['amount'];/* --}}
				@endforeach

				@if ($i < 1)
					{{-- */$i="Geen";/* --}}

				@endif
				
				<p class="white-text"><strong>{{$i}}</strong> maaltijden</p>
			</div>
		</div>
	</div>
</div>

<div id="footer-order-cta">
	<a class="button orange expanded @if(!count($orderLines)) disabled @endif" href="#">Bestellen</a>
	<img src="{{URL::asset('img/icons/euro-icon.svg')}}">
	<p>Voor 0,-</p>
</div>
