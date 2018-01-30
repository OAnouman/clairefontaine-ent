@extends('layouts.admin_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        <a href="{{ route('user.index')}}"> Utilisateurs </a>
    
    </li>
    
    <li>
        
        {{ $user->lastname . ' ' . $user->firstnamr }}
    
    </li>





@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot="header">
    
            {{ $user->lastname . ' ' . $user->firstnamr }}
        
        </template>
        
        
        
        <!-- Panel content -->
        
        
        @component ('components.user_form',
            ['user' => $user, 'action' => 'user.update', 'data' => [$user->id] ])
        
            @slot('button')
            
                <div class="form-group">
    
    
                    <button type="button" class="btn btn-default" @click="back">
        
        
                        <span class="glyphicon glyphicon-circle-arrow-left"></span>
                        
                        Retour
    
    
                    </button>
                    
                    <button type="submit" class="btn btn-primary">
                    
                    
                        Modifier
                
                
                    </button>
            
            
                </div>
            
            @endslot
        
        
        @endcomponent
    
    
    </panel-default>


@endsection