<!-- Navbar -->

<nav class="navbar navbar-default">
    
    
    <div class="container-fluid">
        
    
        <div class="navbar-header">
            
            <button type="button" class="navbar-toggle collapsed"
                    data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
           
            <a class="navbar-brand text-uppercase" href="#"> Clairefontaine ENT</a>
       
        </div>
        
        <ul class="nav navbar-nav navbar-right">
            
            
            <!-- Message link -->
            
            <li disabled="true">
                
                <a href="#" style="padding-right: 0">
                    
                    <span class="glyphicon glyphicon-bell text-danger"></span>
                    
                    <span class="badge inbox">0</span>
                
                </a>
            
            
            </li>
    
            <li>
        
                <a href="{{ route('message_center_parent.index') }}" style="padding-right: 0">
            
                    <span class="glyphicon glyphicon-envelope text-primary"></span>
    
                    <span class="badge inbox {{ auth()->user()->userable->unreadMessages() > 0 ? 'badge-alert' : ''}} ">
                    
                        {{ auth()->user()->userable->unreadMessages() }}
                    
                    </span>
        
                </a>
    
    
            </li>
            
            <!-- Logout link -->
            
            <li class="dropdown">
                
                
                <a href="#" class="dropdown-toggle logout" data-toggle="dropdown" role="button"
                   aria-haspopup="true" aria-expanded="false">
                    
                    <span>
                        
                        <img src="{{ asset(config('image.uploads_path') . '/' . $student->picture) }}"
                                 class="img-circle" width="40" height="40">
                    
                    </span>
    
                    Bienvenue {{ Auth()->user()->firstname }}
                    
                    <span class="caret"></span>
                
                </a>
                
                <ul class="dropdown-menu">
    
    
                    <li>
        
        
                        <a href="{{ route('parent.profile', Auth()->user()->userable->id ) }}" >
            
                            <i class="fa fa-user" aria-hidden="true"></i>
                            
                            Mon profil
        
                        </a>
    
    
                    </li>
                    
                    
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
        
        
        </ul>
    
    
    </div>


</nav>