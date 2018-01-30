@extends('layouts.admin_master')


@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
        
        <a href="{{ route('level.index') }}">Niveaux</a>
    
    </li>




@endsection


@section('work-section')
    
    
    
    
    <panel-default>
        
        {{-- Panel Header --}}
        
        <template slot="header">
            
            Niveaux
        
        </template>
        
        
        {{-- Panel Body --}}
        
        
        @include('layouts.display-message')
        
        
        {{-- Create button --}}
        
        <a href="{{ route('level.create') }}" class="btn btn-success pull-right">
            
            
            Créer
        
        
        </a>
        
        
        <table class="table table-responsive table-hover table-condensed">
            
            
            <thead>
            
            
                <tr>
            
            
                    <td class="col-md-1">
                        
                        #
                    
                    </td>
                    
                    <td class="col-md-5">
                        
                        
                        <strong>
                            
                            Libellé
                        
                        </strong>
                    
                    
                    </td>
                    
                    <td class="col-md-4">
                        
                        
                        <strong>
                            
                            Cycle
                        
                        </strong>
                    
                    
                    </td>
                    
                    
                    <td></td>
                    
                    <td></td>
                
                
                </tr>
            
            
            </thead>
            
            <tbody>


            @foreach($levels as $level)
    
    
                <tr>
        
        
                    <td>
            
            
                        {{ $level->id }}
        
        
                    </td>
        
                    <td>
            
            
                        {{ $level->name }}
        
        
                    </td>
        
                    <td>
            
            
                        {{ $level->academic_grade }}
        
        
                    </td>
        
                    <td>
            
            
                        <a href="{{ route('level.edit',[$level->id]) }}"
                           title="{{ 'Modifier ' . $level->name }}" data-toggle="tooltip"
                           data-placement="top">
                
                
                            <span class="glyphicon glyphicon-edit " aria-hidden="true"></span>
            
            
                        </a>
        
        
                    </td>
        
                    <td>
            
            
                        <a v-on:click.prevent="deleteForm($event)" href="#"
                           title="{{ 'Supprimer ' . $level->name }}" data-toggle="tooltip"
                           data-placement="top">
                
                
                            <span  class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                
                
                            {{--Form for requesting school year deletion --}}
                
                            <form action="{{ route('level.destroy',[$level->id]) }}"
                                  method="POST">
                    
                    
                                {{ csrf_field() }}
                    
                                <input name="_method" type="hidden" value="DELETE">
                
                
                            </form>
            
            
                        </a>
        
        
        
                    </td>
    
    
    
    
                </tr>


            @endforeach
            
            
            </tbody>
        
        
        </table>
        
        
        {{ $levels->links() }}
    
    
    </panel-default>




@endsection
