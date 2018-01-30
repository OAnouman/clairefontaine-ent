<nav class="navbar navbar-default navbar-static-top">


    <div class="container">


        <div class="navbar-header">


            <!-- Collapsed Hamburger -->

            <toggle-menu data="app-navbar-collapse"></toggle-menu>


            <!-- Branding Image -->

            <a class="navbar-brand" href="{{ url('/') }}">

                <span>

                    <img alt="Clairefontaine ENT" src="{{ asset('images/clfe_brand_40x40.png') }}"/>

                </span>

                <span title="Environnement Numérique de Travail">

                    {{ config('app.name', 'Laravel') }}

                </span>


            </a>


        </div>


        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <!-- Left Side Of Navbar -->

            <ul class="nav navbar-nav">
                &nbsp;
            </ul>


            <!-- Right Side Of Navbar -->

            <ul class="nav navbar-nav navbar-right">


                <!-- Authentication Links  when user not connected-->

                @if (Auth::guest())


                    <li><a href="{{ route('login') }}">Se connecter</a></li>

                    {{--<li><a href="{{ route('register') }}">S'enregistrer</a></li>--}}


                @else


                    <li class="dropdown">

                        <a href="#" class="dropdown-toggle logout" data-toggle="dropdown" role="button"
                           aria-expanded="false">

                             <span>
                        
                                <img src="{{ Avatar::create(auth()->user()->lastname . ' '
                                        . auth()->user()->firstname)->toBase64() }}"
                                     class="img-circle" width="40" height="40">
                            
                            </span>
                            
                            Bienvenue {{ Auth::user()->firstname }}

                            <span class="caret"></span>

                        </a>

                        <ul class="dropdown-menu" role="menu">


                            <li>

                               
                                
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
    
                                    <span class="glyphicon glyphicon-log-out"></span>
                                    
                                    Se déconnecter
                                    
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">


                                    {{ csrf_field() }}


                                </form>


                            </li>


                        </ul>


                    </li>


                @endif


            </ul>


        </div>


    </div>


</nav>