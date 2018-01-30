@extends('layouts.admin_master')


@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
        
        <a href="{{ route('classroom.index') }}">Classes</a>
    
    </li>




@endsection


@section('work-section')
    
    
    
    
    <panel-default>
        
        {{-- Panel Header --}}
        
        <template slot="header">
            
            Classes
        
        </template>
        
        
        {{-- Panel Body --}}
        
        
        @include('layouts.display-message')
        
        
        {{-- Pagination and create button --}}
        
        <div class="row">
        
        
            <div class="col-md-9">
            
                <p>
                
                    <strong>
                    
                        {{ $classrooms->firstItem() . ' à ' . $classrooms->lastItem() . ' sur ' . $classrooms->total() }} classes
                
                    </strong>
            
                </p>
        
            </div>
            
            <div class="col-md-3 pull-right">
    
    
                <a href="{{ route('classroom.create') }}" class="btn btn-success pull-right">
        
        
                    Créer
    
    
                </a>
                
                
            </div>
    
    
        </div> <!-- Pagination state -->
        
        <table class="table table-responsive table-hover table-condensed">
            
            
            <thead>
            
            <td class="col-md-1">
                
                #
            
            </td>
            
            <td class="col-md-5">
                
                
                <strong>
                    
                    Libellé
                
                </strong>
            
            
            </td>
            
            <td class="col-md-2">
                
                
                <strong>
                    
                    Niveau
                
                </strong>
            
            
            </td>

            <td class="col-md-2">
    
    
                <strong>
        
                    Année scolaire
    
                </strong>


            </td>
            
            
            <td></td>
            
            <td></td>
            
            </thead>
            
            @foreach($classrooms as $classroom)
                
                
                <tr>
                    
                    
                    <td>
                        
                        
                        {{ $classroom->id }}
                    
                    
                    </td>
                    
                    <td>
                        
                        
                        {{ $classroom->name }}
                    
                    
                    </td>
                    
                    <td>
                        
                        
                        {{ $classroom->level->name }}
                    
                    
                    </td>
    
                    <td>
        
        
                        <a href="{{ url('/classroom?school-year=' . $classroom->schoolYear->name) }}">
    
    
                            {{ $classroom->schoolYear->name }}
                            
                            
                        </a>
                        
    
                    </td>
                    
                    <td>
                        
                        
                        <a href="{{ route('classroom.edit',[$classroom->id]) }}"
                           title="{{ 'Modifier ' . $classroom->name }}" data-toggle="tooltip"
                           data-placement="top">
                            
                            
                            <span class="glyphicon glyphicon-edit " aria-hidden="true"></span>
                        
                        
                        </a>
                    
                    
                    </td>
                    
                    <td>
                        
                        
                        <a @click.prevent="deleteForm($event)" href="#"
                           title="{{ 'Supprimer ' . $classroom->name }}" data-toggle="tooltip"
                           data-placement="top">
                            
                            
                            <span  class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                            
                            
                            {{--Form for requesting school year deletion --}}
                            
                            <form action="{{ route('classroom.destroy',[$classroom->id]) }}"
                                  method="POST">
                                
                                
                                {{ csrf_field() }}
                                
                                <input name="_method" type="hidden" value="DELETE">
                            
                            
                            </form>
                        
                        
                        </a>
                    
                    
                    
                    </td>
                
                
                
                
                </tr>
            
            
            @endforeach
        
        
        </table>
        
        
        {{ $classrooms->links() }}
    
    </panel-default>




@endsection
