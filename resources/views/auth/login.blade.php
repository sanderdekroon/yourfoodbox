@extends('app')

@section('content')
    
    <div class="row">
        <div class="large-8 small-12 small-centered columns">
            <div class="callout secondary">
                <h1>Login</h1>
            </div>

            @include('errors.list')

            {!! Form::open(['action' => 'Auth\AuthController@postLogin']) !!}
                
                <div class="small-12 columns">
                    <div class="input-group">
                        {!! Form::label('email', 'Emailadres: ') !!}
                        {!! Form::text('email', null) !!}
                    </div>
                </div>

                <div class="small-12 columns">
                    <div class="input-group">
                        {!! Form::label('password', 'Wachtwoord: ') !!}
                        {!! Form::password('password', null) !!}
                    </div>
                </div>

                <div class="small-12 columns">
                    {!! Form::checkbox('remember') !!}
                    {!! Form::label('remember', 'Aangemeld blijven') !!}
                </div>

                <div class="small-12 columns">
                    {!! Form::submit('Login', ['class' => 'button']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
    
@stop
