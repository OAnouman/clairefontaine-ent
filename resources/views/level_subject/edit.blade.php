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
    
    <li>
        
        <a href="{{ route('level_subject.create') }}">Nouveau matière niveau</a>
    
    </li>



@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot="header">
            
            Nouveau matière niveau
        
        </template>
        
        
        
        <!-- Panel content -->
        
        
        <div class="col-md-6">
            
            
            <form method="POST" action="{{ route('level_subject.update') }}" data-toggle="validator">
                
                
                {{ csrf_field() }}
    
                <input name="_method" type="hidden" value="PATCH">
                
                <div class="form-group {{ $errors->has('level_id') ? 'has-error' : '' }}">
                    
                    
                    <label for="level_id" >Niveau</label>
                    
                    <select required id = "level_id" class="form-control selectpicker show-tick"
                            name="level_id" data-header="Sélectionner un niveau" data-live-search="true">
                        
                        
                        @foreach($levels as $level)
                            
                            
                            <option {{ $levelSubject->level_id === $level->id ? 'selected' : '' }} data-tokens="{{ $level->name }}"
                                    value="{{ $level->id }}">{{ $level->name }}</option>
                        
                        
                        @endforeach
                    
                    
                    </select>
                    
                    @if ($errors->has('level_id'))
                        
                        
                        <span class="help-block">


                        <strong>{{ $errors->first('level_id') }}</strong>


                    </span>
                    
                    
                    @endif
                
                
                </div>
                
                <div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">
                    
                    
                    <label for="subject_id" >Matière</label>
                    
                    <select required id = "subject_id" class="form-control selectpicker show-tick"
                            name="subject_id" data-header="Sélectionner une matière" data-live-search="true">
                        
                        
                        @foreach($subjects as $subjects)
                            
                            
                            <option {{ $levelSubject->subject_id === $subjects->id ? 'selected' : '' }}
                                    data-tokens="{{ $subjects->name }}"
                                    value="{{ $subjects->id }}">{{ $subjects->name }}</option>
                        
                        
                        @endforeach
                    
                    
                    </select>
                    
                    @if ($errors->has('subject_id'))
                        
                        
                        <span class="help-block">


                        <strong>{{ $errors->first('subject_id') }}</strong>


                    </span>
                    
                    
                    @endif
                
                
                </div>
                
                <div class = "form-group {{ $errors->has('coefficient') ? 'has-error' : '' }}">
                    
                    
                    <label for = "ncoefficientame">Coefficient</label>
                    
                    <input type = "text" value = "{{ $levelSubject->coefficient }}" class = "form-control"
                           name = "coefficient" id = "coefficient" placeholder = "1.0">
                    
                    @if ( $errors->has('coefficient') )
                        
                        
                        <span class = "help-block">


                            <strong>{{ $errors->first('coefficient') }}</strong>


                        </span>
                    
                    
                    @endif
                
                
                </div>
    
                <button type = "button" @click = "back" class = "btn btn-default">
        
        
                    <span class = "glyphicon glyphicon-circle-arrow-left"></span> Retour
    
    
                </button>
                
                <button type="submit" class="btn btn-primary">
                    
                    
                    Modifier
                
                
                </button>
            
            
            </form>
        
        
        </div>
    
    
    
    </panel-default>


@endsection