@extends('layouts.teacher.teacher_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>

    <li>
    
        <a href="{{ route('evaluation.index') }}">Evaluations</a>

    </li>
    
    <li>
        
            
            Evaluation du {{ $evaluation->evaluation_date }} -
            
            {{ $evaluation->classroom->name }}
        
   
    </li>


@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot = "header">
            
            <span class="glyphicon glyphicon-star-empty"></span> &nbsp;
            
            Evaluation du {{ $evaluation->evaluation_date }} -
    
            <a href="{{ route('teacher_classroom.show', $evaluation->classroom->id) }}">
                
                {{ $evaluation->classroom->name }}
            
            </a>
            
            - {{ $evaluation->subject->name }}

            
            
            <span class="pull-right label label-success"> {{ $evaluation->classroom->students()->count() }}</span>
        
        </template>
        
        
        <!-- Panel content -->
        
        <!-- Student list -->
        
        <ul class="list-group">
    
    
            @foreach($evaluation->classroom->students as $student)
    
    
                <li href="#" class="list-group-item">
                    
                    
                   <div class="row">
    
    
                       <div class="col-md-4 item-header" >
        
        
                           <p class="center-name">
                               
                               @if( $evaluation->topStudents()->contains($student->id) )
        
        
                                   <span data-toggle="tooltip" data-placement="top"
                                         title="Meilleure note"
                                         class="glyphicon glyphicon-star text-success"></span>
                               
                               
                               @endif
    
                               @if( $evaluation->worstStudents()->contains($student->id) )
    
    
                                   <span data-toggle="tooltip" data-placement="top"
                                         title="Plus basse note"
                                         class="glyphicon blink glyphicon-warning-sign text-danger"></span>


                               @endif
                               
                               <strong>
                                   
                                   {{ $student->lastname . ' ' . $student->firstname}}
                               
                               </strong>
                               
                               <span class="icon"></span>
                           
                           </p>
    
    
                       </div>
    
                       <div class="col-md-8 item-form">
        
        
                           <form class="form-inline">
            
                               <div class="sr-only">
                                   {{ $grade = $evaluation->grades()->where('student_id', $student->id)->first() }}
                               </div>
            
                               <input type="hidden" id="id" name="id" value="{{ $grade !== null ? $grade->id : '' }}" />
            
                               <input type="hidden" name="evaluation_id" value=" {{ $evaluation->id }}" />
            
                               <input type="hidden" name="student_id" value=" {{ $student->id }}" />
            
                               <div id="value" class = "form-group col-md-3
                                    {{ $errors->has('value') ? 'has-error' : '' }}">
                                   
                
                                   <div class="col-md-12">
                                       
                                       <input type = "number" class = "form-control" placeholder="Valeur"
                                          name = "value" id = "value" value="{{ $grade !== null ? $grade->value : '' }}"
                                              min="0" style="width: 100%;">
                                   
                                   </div>
            
            
                               </div> <!-- End Value -->
            
                               <div id="teacher_assessment" class = "form-group col-md-9
                                    {{ $errors->has('teacher_assessment') ? 'has-error' : '' }}">
                                   
                                  <div class="col-md-12">
                                      
                                      <input type = "text" class = "form-control" placeholder="Commentaires"
                                             value="{{ $grade !== null ? $grade->teacher_assessment : '' }}"
                                          name = "teacher_assessment" id = "teacher_assessment" style="width: 100%">
                                  
                                  </div>
            
            
                               </div> <!-- End Value -->
        
        
                           </form>
    
    
                       </div>
                       
                       
                   </div>
                    
                    
                </li>
                
    
            @endforeach
            
            
        </ul>
    
        <div class="col-md-12 clear-padding">
        
        
            <div class="pull-left">
    
                
                <button @click="back" class="btn btn-default" type="button" data-loading-text="Enregistrement...">
        
                    <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
    
                </button>
                
                
            </div>
        
            <div class="pull-right">
            
            
                <button @click="submitEvaluationGrade($event)" class="btn btn-primary" type="button" data-loading-text="Enregistrement...">
                
                    Enregistrer
            
                </button>
        
        
            </div>
    
    
        </div>
        
    
    </panel-default>


@endsection