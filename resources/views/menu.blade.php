<div class="contain-to-grid">
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li class="menu-text">DEV Menu</li>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('/bestelling')}}">Bestellen</a></li>
            </ul>
        </div>
        <div class="top-bar-right">
            <ul class="menu">
                @if(Auth::check())
                    <li><span>Ingelogd als:</span></li>
                    <li><a href="{{action('UsersController@index')}}">{{Auth::user()['name']}}</a></li>
                    @if(Entrust::hasRole('admin'))
                        <li><a href="{{url('manager')}}">Manager</a></li>
                    @elseif(Entrust::hasRole('moderator'))
                        <li><a href="{{url('manager')}}">Manager</a></li>
                    @endif
                    <li><a href="{{action('Auth\AuthController@getLogout')}}">Uitloggen</a></li>
                @else
                    <li><a href="{{action('Auth\AuthController@getLogin')}}">Inloggen</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
<div id="header-menu">
    <div class="row">
        <div id="logo" class="small-5 large-2 columns">
            <a href="{{action('HomeController@index')}}">
            <img src="{{URL::asset('img/logo-krat-klaar.png')}}">
            </a>
        </div>
        <div id="menu-icon" class="small-2 columns">
            <button id="menu-button">
                <img src="{{URL::asset('img/icons/menu-icon.svg')}}">
            </button>
        </div>
    </div>
</div>
<nav id="main-menu" class="orange">
    <button class="close-menu">+</button>
    <ul>
        <li><a class="white orange-text button expanded" href="#">Button</a></li>
        <li><a class="white orange-text button expanded" href="#">Button</a></li>
        <li><a class="white orange-text button expanded" href="#">Button</a></li>
        <li><a class="white orange-text button expanded" href="#">Button</a></li>
    </ul>
    <h5 class="white-text">Titel van de tekst</h5>
    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua.</p>
</nav>
