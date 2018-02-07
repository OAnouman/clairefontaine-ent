@extends('layouts.admin_master')


@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
        
        <a href="{{ route('teacher.index') }}">Enseignants</a>
    
    </li>




@endsection


@section('work-section')
    
    
    
    
    <panel-default>
        
        {{-- Panel Header --}}
        
        <template slot="header">
            
            Enseignants
        
        </template>
        
        
        {{-- Panel Body --}}
        
        
        @include('layouts.display-message')
        
    
        <div class="row">
        
        
            <div class="col-md-9">
            
                <p>
                
                    <strong>
                    
                        {{ $teachers->firstItem() . ' à ' . $teachers->lastItem() .
                        ' sur ' . $teachers->total() }} professeurs
                
                    </strong>
            
                </p>
        
            </div><!-- Pagination state -->
        
            <div class="col-md-3 pull-right">
    
                {{-- Create button --}}
    
                <a href="{{ route('teacher.create') }}" class="btn btn-success pull-right">
        
        
                    Créer
    
    
                </a>
        
            </div>
    
    
        </div>
        

        <table class="table table-responsive table-hover table-condensed">
            
            
            <thead>
            
                <td class="col-md-1">

                    #

                </td>

                <td class="col-md-2">


                    <strong>

                        Nom

                    </strong>


                </td>

                <td class="col-md-3">


                    <strong>

                        Prénoms

                    </strong>


                </td>

                <td class="col-md-2">


                    <strong>

                        Mobile

                    </strong>


                </td>

                <td class="col-md-1">


                    <strong>

                        Email

                    </strong>


                </td>


                <td></td>

                <td></td>
            
            </thead>
            
            @foreach($teachers as $teacher)
                
                
                <tr>
                    
                    
                    <td>
                        
                        
                        {{ $teacher->id }}
                    
                    
                    </td>
                    
                    <td>
                        
                        
                        {{ $teacher->lastname }}
                    
                    
                    </td>
                    
                    <td>
                        
                        
                        {{ $teacher->firstname }}
                    
                    
                    </td>
    
                    <td>
        
        
                        {{ $teacher->mobile }}
    
    
                    </td>
    
                    <td>
        
        
                        {{ $teacher->email }}
    
    
                    </td>
                    
                    <td>
                        
                        
                        <a href="{{ route('teacher.edit',[$teacher->id]) }}"
                           title="{{ 'Modifier ' . $teacher->firstname . ' ' . $teacher->lastname }}"
                           data-toggle="tooltip" data-placement="top">
                            
                            
                            <span class="glyphicon glyphicon-edit " aria-hidden="true"></span>
                        
                        
                        </a>
                    
                    
                    </td>
                    
                    <td>
                        
                        
                        <a v-on:click.prevent="deleteForm($event)" href="#"
                           title="{{ 'Supprimer ' . $teacher->firstname . ' ' . $teacher->lastname }}"
                           data-toggle="tooltip" data-placement="top">
                            
                            
                            <span  class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                            
                            
                            {{--Form for requesting school year deletion --}}
                            
                            <form action="{{ route('teacher.destroy',[$teacher->id]) }}"
                                  method="POST">
                                
                                
                                {{ csrf_field() }}
                                
                                <input name="_method" type="hidden" value="DELETE">
                            
                            
                            </form>
                        
                        
                        </a>
                    
                    
                    
                    </td>
                
                
                
                
                </tr>
            
            
            @endforeach
        
        
        </table>
        
        
        {{ $teachers->links() }}
    
    </panel-default>




@endsection
