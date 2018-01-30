@extends('layouts.admin_master')


@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
        
        <a href="{{ route('level_subject.index') }}">Matières niveaux</a>
    
    </li>




@endsection


@section('work-section')
    
    
    
    
    <panel-default>
        
        {{-- Panel Header --}}
        
        <template slot="header">
    
            Matières niveaux
        
        </template>
        
        
        {{-- Panel Body --}}
        
        
        @include('layouts.display-message')
        
        
        {{-- Create button --}}
        
        <a href="{{ route('level_subject.create') }}" class="btn btn-success pull-right">
            
            
            Créer
        
        
        </a>
        
        
        <table class="table table-responsive table-hover table-condensed">
            
            
            <thead>
            
            
                <tr>
    
    
                    <td class="col-md-4">
        
        
                        <strong>
            
                            Niveau
        
                        </strong>
    
    
                    </td>
    
                    <td class="col-md-4">
        
        
                        <strong>
            
                            Matière
        
                        </strong>
    
    
                    </td>
    
                    <td class="col-md-2">
        
        
                        <strong>
            
                            Coefficient
        
                        </strong>
    
    
                    </td>
    
    
                    <td></td>
    
                    <td></td>
                    
                    
                </tr>
            
            
            </thead>
            
            <tbody>


                @foreach($levels as $level)
    
    
                @foreach($level->subjects as $subject)
        
        
                    <tr>
            
            
                        <td>
                
                
                            {{ $level->name }}
            
            
                        </td>
            
                        <td>
                
                
                            {{ $subject->name }}
            
            
                        </td>
            
                        <td>
                
                
                            {{ $subject->pivot->coefficient }}
            
            
                        </td>
            
                        <td>
                
                
                            <a href="{{ route( 'level_subject.edit',[ $level->id, $subject->id ]) }}"
                               title="{{ 'Modifier ' . $level->name . ' - ' . $subject->name }}" data-toggle="tooltip"
                               data-placement="top">
                    
                    
                                <span class="glyphicon glyphicon-edit " aria-hidden="true"></span>
                
                
                            </a>
            
            
                        </td>
            
                        <td>
                
                
                            <a v-on:click.prevent="deleteForm($event)" href="#"
                               title="{{ 'Supprimer ' . $level->name . ' - ' . $subject->name }}" data-toggle="tooltip"
                               data-placement="top">
                    
                    
                                <span  class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                    
                                {{--Form for requesting school year deletion --}}
                    
                                <form action="{{ route('level_subject.destroy',[ $level->id, $subject->id ]) }}"
                                      method="POST">
                        
                        
                                    {{ csrf_field() }}
                        
                                    <input name="_method" type="hidden" value="DELETE">
                    
                    
                                </form>
                
                
                            </a>
            
            
            
                        </td>
        
        
        
        
                    </tr>
    
    
                @endforeach


            @endforeach
            
            
            </tbody>
        
        
        </table>
        
        
    
    </panel-default>




@endsection
