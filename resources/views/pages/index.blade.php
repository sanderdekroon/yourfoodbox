@extends('app')

@section('content')
	
	<div class="row">
			<h1>Pages index</h1>
			<hr/>

			@foreach($pages as $page)
					<h2>
						<a href="{{ url('/pages', $page->slug) }}" title="{{$page->title}}">{{ $page->title }}</a>
					</h2>
						
					<p>{{ $page->content }}</p>
					<ul class="menu">
						<li>
							<a href="{{ action('PagesController@edit', $page->slug) }}" title="Aanpassen">
								<small><i class="fa fa-pencil"></i></small>
							</a>
						</li>
					</ul>
					<hr>
			@endforeach
	</div>
	
@stop

