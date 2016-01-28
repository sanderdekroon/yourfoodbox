<!-- Tijdelijke AUTH -->
{!! Form::hidden('user_id', 1) !!}


<div class="small-6 columns">
	<div class="input-group">
		{!! Form::label('title', 'Titel: ', ['class' => 'input-group-label']) !!}
		{!! Form::text('title', null, ['class' => 'input-group-field']) !!}
	</div>
</div>

<div class="small-6 columns">
	<div class="input-group">
		{!! Form::label('slug', 'URL: ', ['class' => 'input-group-label']) !!}
		{!! Form::text('slug', null, ['class' => 'input-group-field']) !!}
	</div>
</div>

<div class="small-12 columns">
	{!! Form::label('content', 'Inhoud: ') !!}
	{!! Form::textarea('content') !!}
</div>

<fieldset class="small-12 columns">
	{!! Form::checkbox('is_published') !!}
	{!! Form::label('is_published', 'Direct publiceren') !!}
</fieldset>

<div class="small-12 columns">
	{!! Form::submit($submitButtonText, ['class' => 'button']) !!}
</div>
