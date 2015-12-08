@extends('app')

@section('content')
    
    <div class="row">
        <h1>Registreren</h1>
        <hr>

        @include('errors.list')

        {!! Form::open(['action' => 'Auth\AuthController@postRegister']) !!}
            <fieldset class="large-6 small-12 colums end">
                <legend>Vul hieronder je gegevens in om een account te registreren.</legend>
                <div class="row">
                    <div class="small-12 large-3 columns">
                        {!! Form::label('name', 'Naam: ', ['class' => 'middle']) !!}
                    </div>
                    <div class="small-12 large-9 columns">
                            {!! Form::text('name', null) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 large-3 columns">
                        {!! Form::label('email', 'E-mail adres: ', ['class' => 'middle']) !!}
                        
                    </div>
                    <div class="small-12 large-9 columns">
                        {!! Form::text('email', null) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 large-3 columns">
                        {!! Form::label('password', 'Wachtwoord: ', ['class' => 'middle']) !!}
                    </div>
                    <div class="small-12 large-9 columns">
                        {!! Form::password('password', null) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="small-12 large-3 columns">
                        {!! Form::label('password_confirmation', 'Wachtwoord bevestigen: ', ['class' => 'middle']) !!}
                    </div>
                    <div class="small-12 large-9 columns">
                        {!! Form::password('password_confirmation', null) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        {!! Form::submit('Registreren', ['class' => 'button']) !!}
                    </div>
                </div>
                
            </fieldset>

        {!! Form::close() !!}

    </div>
    
@stop
