<header class="container-fluid">
    @if ($btnMenu)
        <button class="navbar-toggler" type="button" id="menubtn">
            <i class="icofont-navigation-menu"></i>
        </button>
        @endif
    <div class="container">
        <a class="name-header" href="{{url('/')}}"><span>Influencers</span></a>
        @if ($btnLogin)
        <a class=" ml-auto" href="{{ url('/login')}}"><button class="btn btn-primary btn-login">Entrar</button></a>
        @endif
    </div>
</header>