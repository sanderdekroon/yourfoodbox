@extends('app')

@section('content')
	
	<div class="row">
		<h1>Edit: {!! $page->title !!}</h1>
			
		@include('errors.list')

		{!! Form::model($page, ['method' => 'PATCH', 'url' => 'pages/' . $page->id]) !!}
			@include('pages._form', ['submitButtonText' => 'Update'])	
		{!! Form::close() !!}
	</div>
	
@stop

