@extends('errors.master')


@section('content')
    
    
    <error refresh="true">
        
        
        <template slot="error-name">
            
            
            <i class="fa fa-cogs text-success" aria-hidden="true"></i> 503 <br>
            
            <small class="text-uppercase">Maintenance en cours</small>
        
        
        </template>
        
        <template slot="error-description">
            
            
            <strong> Le site est actuelement en maintenance </strong>
            <br>
            
            Nous améliorons la plateforme Clairefontaine ENT <br> afin de mieux vous satisfaire.
            
            Veuillez ressayer dans quelques instants.
        
        
        </template>
    
    
    </error>


@endsection