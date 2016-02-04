<div class="small-6 columns">
	<div class="small-6 columns">
		<div class="input-group">
			{!! Form::label('week_no', 'Weeknummer: ', ['class' => 'input-group-label']) !!}
			{!! Form::text('week_no', date('W'), ['class' => 'input-group-field']) !!}
		</div>
	</div>

	<div class="small-6 columns">
		<div class="input-group">
			{!! Form::label('year', 'Jaar: ', ['class' => 'input-group-label']) !!}
			{!! Form::text('year', date('Y'), ['class' => 'input-group-field']) !!}
		</div>
	</div>

	<div class="small-12 columns">
		<div class="input-group">
			{!! Form::label('name', 'Naam: ', ['class' => 'input-group-label']) !!}
			{!! Form::text('name', null, ['class' => 'input-group-field']) !!}
		</div>
	</div>

	<div class="small-12 columns">
		{!! Form::label('description', 'Omschrijving: ') !!}
		{!! Form::textarea('description') !!}
	</div>

</div>

<div class="small-6 columns">
	<div class="small-12 columns">
		<label for="select-ingredient">Ingredienten:</label>
		<select id="select-ingredient" name="ingredient-list[]" placeholder="Selecteer ingredienten..."></select>
	</div>

	<div class="small-12 columns">
		<br/><br/><br/><!-- This *should* be removed  -->
		{!! Form::submit($submitButtonText, ['class' => 'button expanded light-green']) !!}
	</div>
</div>