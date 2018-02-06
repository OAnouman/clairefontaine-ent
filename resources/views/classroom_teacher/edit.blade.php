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
    
    <li>
        
        {{ $classroomTeacher->classroom->name . ' - ' .
        $classroomTeacher->teacher->firstname . ' ' . $classroomTeacher->teacher->lastname }}
    
    </li>



@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot="header">
    
            {{ $classroomTeacher->classroom->name . ' - ' .
        $classroomTeacher->teacher->firstname . ' ' . $classroomTeacher->teacher->lastname }}
        
        </template>
        
        
        
        <!-- Panel content -->
        
        
        <div class="col-md-6">
            
            
            <form method="POST" action="{{ route('classroom_teacher.update') }}" data-toggle="validator">
                
                
                {{ csrf_field() }}
    
                <input name="_method" type="hidden" value="PATCH">
    
                <div class="form-group {{ $errors->has('classroom_id') ? 'has-error' : '' }}">
        
        
                    <label for="classroom_id" >Classe</label>
        
                    <select required id = "classroom_id" class="form-control selectpicker show-tick"
                            name="classroom_id" data-header="Sélectionner une classe" data-live-search="true" disabled>
            
            
                        @foreach($classrooms as  $classroom)
                
                
                            <option value="{{ $classroom->id }}"
                                    {{ $classroomTeacher->classroom_id === $classroom->id ? 'selected' : ''}}
                                    data-tokens="{{ $classroom->name }}">
                    
                    
                                {{ $classroom->name }}
                
                
                            </option>
            
            
                        @endforeach
        
        
                    </select>
        
                    @if ($errors->has('classroom_id'))
            
            
                        <span class="help-block">


                        <strong>{{ $errors->first('classroom_id') }}</strong>


                    </span>
        
        
                    @endif
    
    
                </div>
    
                <div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">
        
        
                    <label for="school_year" >Matière</label>
        
                    <select required id = "subject_id" class="form-control selectpicker show-tick"
                            name="subject_id" data-header="Sélectionner une matière" data-live-search="true">
            
            
                        @foreach($subjects as $subject)
                
                
                            <option value="{{ $subject->id }}"
                                    {{ $classroomTeacher->subject_id === $subject->id ? 'selected' : ''}}
                                    data-tokens="{{ $subject->name }}">
                    
                    
                                {{ $subject->name }}
                
                
                            </option>
            
            
                        @endforeach
        
        
                    </select>
        
                    @if ($errors->has('subject_id'))
            
            
                        <span class="help-block">
                        
                        <strong>{{ $errors->first('subject_id') }}</strong>


                    </span>
        
        
                    @endif
    
    
                </div>
    
                <div class="form-group {{ $errors->has('teacher_id') ? 'has-error' : '' }}">
        
        
                    <label for="teacher_id">Enseignant</label>
        
                    <select required id = "teacher_id" class="form-control selectpicker show-tick"
                            name="teacher_id" data-header="Sélectionner un enseignant" data-live-search="true" disabled>
            
            
                        @foreach($teachers as $teacher)
                
                
                            <option value="{{ $teacher->id }}"
                                    data-tokens="{{ $teacher->lastname . ' ' . $teacher->firstname }}"
                                    {{ $classroomTeacher->teacher_id === $teacher->id ? 'selected' : ''}}>
                                
                                {{ $teacher->firstname . ' ' . $teacher->lastname }}
                            
                            </option>
            
            
                        @endforeach
        
        
                    </select>
        
                    @if ($errors->has('teacher_id'))
            
            
                        <span class="help-block">


                        <strong>{{ $errors->first('teacher_id') }}</strong>


                    </span>
        
        
                    @endif
    
    
                </div>
    
                <button type = "button" @click = "back" class = "btn btn-default">
        
        
                    <span class = "glyphicon glyphicon-circle-arrow-left"></span> Retour
    
    
                </button>
                
                <button type="submit" class="btn btn-primary">
                    
                    
                    Modofier
                
                
                </button>
            
            
            </form>
        
        
        </div>
    
    
    
    </panel-default>


@endsection