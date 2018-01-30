@extends('layouts.admin_master')


@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
        
        <a href="{{ route('classroom_teacher.index') }}">Matières enseignants</a>
    
    </li>




@endsection


@section('work-section')
    
    
    
    
    <panel-default>
        
        {{-- Panel Header --}}
        
        <template slot="header">
    
            Matières enseignants
        
        </template>
        
        
        {{-- Panel Body --}}
        
        
        @include('layouts.display-message')
        
        
        {{-- Create button --}}
        
        <a href="{{ route('classroom_teacher.create') }}" class="btn btn-success pull-right">
            
            
            Créer
        
        
        </a>
        
        
        <table class="table table-responsive table-hover table-condensed">
            
            
            <thead>
            
            
            <td class="col-md-2">
                
                
                <strong>
                    
                    Classe
                
                </strong>
            
            
            </td>
            
            <td class="col-md-3">
                
                
                <strong>
                    
                    Matière
                
                </strong>
            
            
            </td>

            <td class="col-md-3">
    
    
                <strong>
        
                    Enseignant
    
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
            
            @foreach($classroomTeachers as $classroomTeacher)
                
                
                <tr>
                    
                    
                    <td>
                        
                        
                        {{ $classroomTeacher->classroom->name }}
                    
                    
                    </td>
                    
                    <td>
                        
                        
                        {{ $classroomTeacher->subject->name }}
                    
                    
                    </td>
                    
                    <td>
                        
                        
                        {{ $classroomTeacher->teacher->firstname . ' ' . $classroomTeacher->teacher->lastname }}
                    
                    
                    </td>
    
                    <td>
        
        
                        {{ $classroomTeacher->classroom->schoolYear->name }}
    
    
                    </td>
                    
                    <td>
                        
                        
                        <a href="{{ route('classroom_teacher.edit',[$classroomTeacher->classroom_id, $classroomTeacher->teacher_id]) }}"
                           title="Modifier la liaison" data-toggle="tooltip"
                           data-placement="top">
                            
                            
                            <span class="glyphicon glyphicon-edit " aria-hidden="true"></span>
                        
                        
                        </a>
                    
                    
                    </td>
                    
                    <td>
                        
                        
                        <a @click.prevent="deleteForm($event)" href="#"
                           title="Supprimer la liaison" data-toggle="tooltip"
                           data-placement="top">
                            
                            
                            <span  class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                            
                            {{--Form for requesting school year deletion --}}
                            
                            <form action="{{ route('classroom_teacher.destroy',
                                            [$classroomTeacher->classroom_id, $classroomTeacher->teacher_id, $classroomTeacher->subject_id]) }}"
                                  method="POST">
                                
                                
                                {{ csrf_field() }}
                                
                                <input name="_method" type="hidden" value="DELETE">
                            
                            
                            </form>
                        
                        
                        </a>
                    
                    
                    
                    </td>
                
                
                
                
                </tr>
            
            
            @endforeach
        
        
        </table>
        
        
        {{ $classroomTeachers->links() }}
    
    </panel-default>




@endsection
