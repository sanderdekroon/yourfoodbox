@extends('app')

@section('content')
	
	<div class="row">
			<h1>{{$page->title}}</h1>
			<p>{{ $page->content }}</p>
	</div>
	
@stop

