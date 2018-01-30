@extends('errors.master')


@section('content')
    
    
    <error>
    
    
        <template slot="error-name">
    
    
            <i class="fa fa-frown-o text-danger" aria-hidden="true"></i> 404 <br>
    
            <small class="text-uppercase">Désolé, cette page n'existe pas</small>
            
            
        </template>
        
        <template slot="error-description">
    
    
            <strong> La page que vous avez demandé est introuvable </strong>
            <br>
    
            La page demandée n’existe pas ou n’existe plus.
    
            Veuillez retourner à la page précedente <br>  ou à la page d'accueil. <br>
    
            Si vous estimer que c'est une erreur, veuillez contacter
    
            les <br> adminstrateurs du site.
            
        
        </template>
        
    
    </error>


@endsection