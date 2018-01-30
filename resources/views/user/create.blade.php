@extends('layouts.admin_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        <a href="{{ route('user.index') }}"> Utilisateurs </a>
    
    </li>
    
    <li>
        
        Nouvel utilisateur
    
    </li>
    
    
@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot="header">
            
            Nouvel utilissateur
        
        </template>
        
        
        
        <!-- Panel content -->
        
        
        @component ('components.user_form', ['user' => null, 'action' => 'register', 'data' => null])
        
        
            @slot('button')
            
                <div class="form-group">
                    
                
                    <button type="submit" class="btn btn-primary">
                    
                    
                        Creer
                
                
                    </button>
            
            
                </div>
        
            @endslot
        
        @endcomponent
    
    
    </panel-default>


@endsection