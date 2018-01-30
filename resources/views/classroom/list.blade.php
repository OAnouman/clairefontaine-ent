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
    
    <li>
        
        <a href="{{ route('classroom_student.index') }}">Liste de classe</a>
    
    </li>




@endsection


@section('work-section')
    
    
    
    
    <panel-default>
        
        {{-- Panel Header --}}
        
        <template slot="header">
            
            Classes
        
        </template>
        
        
        {{-- Panel Body --}}
        
        
        <div id="display_message">

            
            @include('layouts.display-message')


        </div>
        
        
        @include('classroom.list-head-form')
        
        <br>
        
        <div class="row col-md-5">
    
    
            <div class = "form-group">
        
                <label for="classroom_id" class="sr-only" >Classe</label>
        
                <select required id = "class_to_show" data-header="Sélect. une classe"
                        class = "form-control selectpicker show-tick" data-size="10" data-show-subtext="true"
                        data-live-search="true" title="Filtrer par classe" @change="onClassroomSelect">
            
            
                    @foreach($classrooms as $classroom)
                
                
                        <option data-tokens="{{ $classroom->name }}"
                                data-subtext="{{ $classroom->teacher->firstname . ' ' . $classroom->teacher->lastname }}"
                                value = "{{ $classroom->id }}">{{ $classroom->name }}</option>
            
            
                    @endforeach
        
        
                </select>
    
    
            </div> <!-- End classroom -->
        
        
        </div>
        
        <div class="col-md-3 pull-right">
            
            
            <a id="printList" target="_blank" href="#" class="btn btn-default pull-right">
                
                <span class="glyphicon glyphicon-print"></span> Imprimer
                
            </a>
            
            
        </div>
        
        <div id="student_list">
    
    
            @section('student-list')
        
        
                <table class="table table-responsive table-hover table-condensed">
            
            
                    <thead>
            
                    <td class="col-md-2">
                
                
                        <strong>
                    
                            Matricule
                
                        </strong>
            
            
                    </td>
            
                    <td class="col-md-5">
                
                
                        <strong>
                    
                            Nom et Prénoms
                
                        </strong>
            
            
                    </td>
            
                    <td class="col-md-2">
                
                
                        <strong>
                    
                            Date Naissance
                
                        </strong>
            
            
                    </td>
            
                    <td class="col-md-2">
                
                
                        <strong>
                    
                            Sexe
                
                        </strong>
            
            
                    </td>
            
            
                    <td></td>
            
                    </thead>
            
                    @foreach($students as $student)
                
                
                        <tr>
                    
                    
                            <td>
                        
                        
                                {{ $student->reg_number }}
                    
                    
                            </td>
                    
                            <td>
                        
                        
                                {{ $student->firstname . ' ' . $student->lastname }}
                    
                    
                            </td>
                    
                            <td>
                        
                        
                                {{ $student->birth_date }}
                    
                    
                            </td>
                    
                            <td>
                        
                        
                                {{ ucfirst( $student->sex ) }}
                    
                    
                            </td>
                    
                    
                            <td>
                        
                        
                                <a onclick="ajaxDeleteForm()" href="#"
                                   title="Retirer de la classe" data-toggle="tooltip"
                                   data-placement="top">
                            
                            
                                    <span  class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                                    
                                    {{--Form for requesting deletion --}}
                            
                                    <form action="">
                                
                                        
                                        <input type="hidden" name="student_id" value="{{ $student->pivot->student_id }}">
                                        
                                        <input type="hidden" name="classroom_id" value="{{ $student->pivot->classroom_id }}">
                            
                            
                                    </form>
                        
                        
                                </a>
                    
                    
                    
                            </td>
                
                
                
                
                        </tr>
            
            
                    @endforeach
        
        
                </table>
    
    
            @show
            
            
        </div>
        
        
    
    </panel-default>




@endsection