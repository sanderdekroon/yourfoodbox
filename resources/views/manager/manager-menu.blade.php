<div class="row">
    <div id="logo" class="small-5 large-2 columns">
        <a href="#" data-open="closeManager">
            <img src="{{URL::asset('img/logo-krat-klaar.png')}}">
        </a>
    </div>
    <div class="small-7 columns">
        <h2>Krat en Klaar Manager</h2>
    </div>
</div>

<div class="contain-to-grid">
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li><a href="{{url('/manager')}}">Home</a></li>
                <li><a href="{{url('/manager/products')}}">Producten</a></li>
                <li><a href="{{url('/manager/ingredients')}}">Ingredienten</a></li>
                <li><a href="{{url('/manager/orders')}}">Bestellingen</a></li>
                <li><a href="{{url('/manager')}}">Markt informatie</a></li>
            </ul>
        </div>
        <div class="top-bar-right">
            <ul class="dropdown menu" data-dropdown-menu>
                @if(Auth::check())
                    <li><a href="{{action('UsersController@index')}}">Account</a></li>
                    @if(Entrust::hasRole('admin'))
                        <li><a href="{{url('manager')}}">Gebruikersbeheer</a></li>
                    @endif
                    <li><a href="{{action('Auth\AuthController@getLogout')}}">Uitloggen</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>