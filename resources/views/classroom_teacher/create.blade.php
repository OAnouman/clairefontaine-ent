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
        
        <a href="{{ route('level_subject.create') }}">Nouveau matière enseignant</a>
    
    </li>



@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot="header">
    
            Nouveau matières enseignants
        
        </template>
        
        
        
        <!-- Panel content -->
        
        
        <div class="col-md-6">
            
            
            <form method="POST" action="{{ route('classroom_teacher.store') }}">
                
                
                {{ csrf_field() }}
                
                <div class="form-group {{ $errors->has('classroom_id') ? 'has-error' : '' }}">
                    
                    
                    <label for="classroom_id" >Classe</label>
                    
                    <select required id = "classroom_id" class="form-control selectpicker show-tick"
                            name="classroom_id" data-header="Sélectionner une classe" data-live-search="true">
    
                        
                        @foreach($classrooms as  $classroom)
        
        
                            <option value="{{ $classroom->id }}"
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
        
        
                    <label for="school_year" >Année scolaire</label>
        
                    <select required id = "subject_id" class="form-control selectpicker show-tick"
                            name="subject_id" data-header="Sélectionner une matière" data-live-search="true">
            
            
                        @foreach($subjects as $subject)
                
                
                            <option value="{{ $subject->id }}"
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
        
        
                    <label for="teacher_id" >Enseignant</label>
        
                    <select required id = "teacher_id" class="form-control selectpicker show-tick"
                            name="teacher_id" data-header="Sélectionner un enseignant" data-live-search="true">
    
                        
                        @foreach($teachers as $teacher)
                        
                            
                            <option value="{{ $teacher->id }}" data-tokens="{{ $teacher->lastname . ' ' . $teacher->firstname }}">
                                
                                
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
                
                <button type="submit" class="btn btn-primary">
                    
                    
                    Créer
                
                
                </button>
            
            
            </form>
        
        
        </div>
    
    
    
    </panel-default>


@endsection