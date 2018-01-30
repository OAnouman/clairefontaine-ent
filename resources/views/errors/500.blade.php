@extends('errors.master')


@section('content')
    
    
    <error refresh="true">
        
        
        <template slot="error-name">
    
    
            <i class="fa fa-chain-broken text-danger" aria-hidden="true"></i> 500 <br>
            
            <small class="text-uppercase">Service indisponible</small>
        
        
        </template>
        
        <template slot="error-description">
            
            
            <strong> Le serveur ne peut répondre à votre requête actuellement. </strong>
            <br>
            
            Veuillez ressayer plus tard. Si cette erreur persiste, veuillez contacter  <br>
            
            les adminstrateurs du site.
        
        
        </template>
    
    
    </error>


@endsection