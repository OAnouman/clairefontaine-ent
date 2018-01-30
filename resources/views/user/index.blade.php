@extends('layouts.admin_master')


@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Utilisateur
    
    </li>
    

@endsection


@section('work-section')
    
    
    
    
    <panel-default>
        
        {{-- Panel Header --}}
        
        <template slot="header">
            
            Utilisateurs
        
        </template>
        
        
        {{-- Panel Body --}}
        
        
        @include('layouts.display-message')
        
        
        <div class="row">
            
            
            <div class="col-md-9">
                
                <p>
                    
                    <strong>
                        
                        {{ $users->firstItem() . ' à ' . $users->lastItem() .
                        ' sur ' . $users->total() }} utilisateurs
                    
                    </strong>
                
                </p>
            
            </div><!-- Pagination state -->
            
            <div class="col-md-3 pull-right">
                
                {{-- Create button --}}
                
                <a href="{{ route('register') }}" class="btn btn-success pull-right">
                    
                    
                    Créer
                
                
                </a>
            
            </div>
        
        
        </div>
        
        
        <table class="table table-responsive table-hover table-condensed">
            
            
            <thead>
            
                <tr>
    
    
                    <td class="col-md-1">
        
                        #
    
                    </td>
    
                    <td class="col-md-2">
        
        
                        <strong>
            
                            Nom
        
                        </strong>
    
    
                    </td>
    
                    <td class="col-md-4">
        
        
                        <strong>
            
                            Prénoms
        
                        </strong>
    
    
                    </td>
    
                    <td class="col-md-3">
        
        
                        <strong>
            
                            Email
        
                        </strong>
    
    
                    </td>
    
                    <td class="col-md-2">
        
        
                        <strong>
            
                            Compte
        
                        </strong>
    
    
                    </td>
    
                    <td></td>
                    <td></td>
                    
                    
                </tr>
            
            </thead>
            
            @foreach($users as $user)
                
                
                <tr>
                    
                    
                    <td>
                        
                        
                        {{ $user->id }}
                    
                    
                    </td>
                    
                    <td>
                        
                        
                        {{ $user->lastname }}
                    
                    
                    </td>
                    
                    <td>
                        
                        
                        {{ $user->firstname }}
                    
                    
                    </td>
                    
                    <td>
                        
                        
                        {{ $user->email }}
                    
                    
                    </td>
    
                    <td>
        
        
                        {{ ucfirst( $user->account_type ) }}
    
    
                    </td>
                    
                    <td>
                        
                        
                        <a href="{{ route('user.edit',[$user->id]) }}"
                           title="{{ 'Modifier ' . $user->firstname . ' ' . $user->lastname }}"
                           data-toggle="tooltip" data-placement="top">
                            
                            
                            <span class="glyphicon glyphicon-edit " aria-hidden="true"></span>
                        
                        
                        </a>
                    
                    
                    </td>
    
                    <td>
        
        
                        <a @click.prevent="deleteForm($event)" href="#"
                           title="{{ 'Supprimer ' . $user->firstname . ' ' . $user->lastname }}"
                           data-toggle="tooltip" data-placement="top">
            
            
                            <span  class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
            
            
                            {{--Form for requesting  deletion --}}
            
                            <form action="{{ route('user.destroy',[$user->id]) }}"
                                  method="POST">
                
                
                                {{ csrf_field() }}
                
                                <input name="_method" type="hidden" value="DELETE">
            
            
                            </form>
        
        
                        </a>
    
    
    
                    </td>
                    
                
                
                </tr>
            
            
            @endforeach
        
        
        </table>
        
        
        {{ $users->links() }}
    
    </panel-default>




@endsection
