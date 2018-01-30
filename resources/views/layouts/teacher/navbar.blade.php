<!-- Navbar -->

<nav class="navbar navbar-default">
    
    
    <div class="container-fluid">
        
        
        <ul class="nav navbar-nav navbar-right">
            
            
            <!-- Message link -->
            
            <li>
                
                <a href="{{ route('message_center.index') }}" style="padding-right: 0">
                    
                    <span class="glyphicon glyphicon-envelope"></span>
                    
                    <span class="badge inbox {{ auth()->user()->userable->unreadMessages() > 0 ? 'badge-alert' : ''}} ">
                    
                        {{ auth()->user()->userable->unreadMessages() }}
                    
                    </span>
                
                </a>
            
            
            </li>
            
            <!-- Logout link -->
            
            <li class="dropdown">
                
                
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-haspopup="true" aria-expanded="false">
                    
                    Bienvenue {{ Auth()->user()->firstname }}
                    
                    <span class="caret"></span>
                
                </a>
                
                <ul class="dropdown-menu">
                    
                    
                    <li>
                        
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
    
                            <span class="glyphicon glyphicon glyphicon-log-out"></span>
                            
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