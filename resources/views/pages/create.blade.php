@extends('app')

@section('content')
	
	<div class="row">
		<h1>Create a new page</h1>
		<hr>

		@include('errors.list')

		{!! Form::open(['url' => 'pages']) !!}
			@include('pages._form', ['submitButtonText' => 'Opslaan'])	
		{!! Form::close() !!}
	</div>
	
@stop

