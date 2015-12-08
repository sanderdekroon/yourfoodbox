<div class="contain-to-grid">
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li class="menu-text">Your Food Box</li>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('/pages')}}">Pagina's</a></li>
                
            </ul>
        </div>
        <div class="top-bar-right">
            <ul class="menu">
                @if(Auth::check())
                    <li><span>Ingelogd als:</span></li>
                    <li><a href="#">{{Auth::user()['name']}}</a></li>
                    @if(Entrust::hasRole('admin'))
                        <li><a href="#">Secret admin menu</a></li>
                    @elseif(Entrust::hasRole('moderator'))
                        <li><a href="#">Secret mod menu</a></li>
                    @endif
                    <li><a href="{{action('Auth\AuthController@getLogout')}}">Uitloggen</a></li>
                @else
                    <li><a href="{{action('Auth\AuthController@getLogin')}}">Inloggen</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
