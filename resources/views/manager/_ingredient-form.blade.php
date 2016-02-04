<div class="small-12 columns">
	<div class="input-group">
		{!! Form::label('name', 'Ingredient naam: ') !!}
		{!! Form::text('name', $ingredient->name) !!}
	</div>
</div>

<div class="small-12 columns">
	<div class="input-group">
		{!! Form::label('unit', 'Verkocht per: ') !!}
		<select name="unit">
			@foreach($ingredientUnitStatuses as $ingredientUnitStatus)
				@if($ingredient->unit == $ingredientUnitStatus)
					<option selected value="{{$ingredientUnitStatus}}">{{$ingredientUnitStatus}}</option>
				@else
					<option value="{{$ingredientUnitStatus}}">{{$ingredientUnitStatus}}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>

<div class="small-12 columns">
	<div class="input-group">
		{!! Form::label('type', 'Ingredient type: ') !!}
		<select name="type">
			@foreach($ingredientTypeStatuses as $ingredientTypeStatus)
				@if($ingredient->type == $ingredientTypeStatus)
					<option selected value="{{$ingredientTypeStatus}}">{{$ingredientTypeStatus}}</option>
				@else
					<option value="{{$ingredientTypeStatus}}">{{$ingredientTypeStatus}}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>

<div class="small-12 columns">
	<div class="input-group">
		{!! Form::label('min_amount', 'Minimale afname hoeveelheid: ') !!}
		{!! Form::text('min_amount', $ingredient->min_amount) !!}
	</div>
</div>

<div class="small-12 columns">
	{!! Form::submit($submitButtonText, ['class' => 'button expanded light-green']) !!}
</div>