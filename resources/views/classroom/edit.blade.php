@extends('layouts.admin_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href = "{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
        
        <a href = "{{ url('/classroom') }}">Classes</a>
    
    </li>
    
    <li>
        
        {{ $classroom->name }}
    
    </li>



@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot = "header">
    
            {{ $classroom->name }}
        
        </template>
        
        
        <!-- Panel content -->
        
        
        <div class = "col-md-6">
            
            
            <form class = "" method = "POST" action = "{{ route('classroom.update', $classroom->id) }}">
                
                
                {{ csrf_field() }}
    
                <input name="_method" type="hidden" value="PATCH">
                
                <div class = "form-group {{ $errors->has('level_id') ? 'has-error' : '' }}">
                    
                    
                    <label for = "level_id">Niveau</label>
                    
                    <select required id = "level_id" @change="syncClass" data-header="Sélectionner un niveau"
                            class = "form-control selectpicker show-tick" name = "level_id"
                            data-live-search="true">
                        
                        <optgroup label = "Maternelle">
                            
                            
                            @foreach($kindergarten as $kinder)
                                
                                
                                <option {{ $classroom->level_id === $kinder->id ? 'selected' : '' }}
                                        data-tokens="{{ $kinder->name }}"
                                        value = "{{ $kinder->name }}">{{ $kinder->name }}</option>
                            
                            
                            @endforeach
                        
                        
                        </optgroup>
                        
                        <optgroup label = "Primaire">
                            
                            
                            @foreach($elementary as $elt)
                                
                                
                                <option {{ $classroom->level_id === $elt->id ? 'selected' : '' }}
                                        data-tokens="{{ $elt->name }}"
                                        value = "{{ $elt->name }}">{{ $elt->name }}</option>
                            
                            
                            @endforeach
                        
                        
                        </optgroup>
                        
                        <optgroup label = "Secondaire">
                            
                            
                            @foreach($secondary as $sec)
                                
                                
                                <option {{ $classroom->level_id === $sec->id ? 'selected' : '' }}
                                        data-tokens="{{ $sec->name }}"
                                        value = "{{ $sec->name }}">{{ $sec->name }}</option>
                            
                            
                            @endforeach
                        
                        
                        </optgroup>
                    
                    
                    </select>
                    
                    @if ($errors->has('level_id'))
                        
                        
                        <span class = "help-block">


                        <strong>{{ $errors->first('level_id') }}</strong>


                    </span>
                    
                    
                    @endif
                
                
                </div>
                
                <div class="form-group {{ $errors->has('school_year_id') ? 'has-error' : '' }}">
                    
                    
                    <label for="school_year_id" >Année scolaire</label>
                    
                    <select required id = "school_year_id" class="form-control selectpicker show-tick"
                            name="school_year_id" data-header="Sélectionner une année scoalaire">
                        
                        <option value="">Sélectionner l'année scolaire</option>
                        
                        @foreach($schoolYears as $schoolYear )
                            
                            
                            <option {{ $classroom->school_year_id === $schoolYear->id ? 'selected' : '' }}
                                    value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
                        
                        
                        @endforeach
                    
                    
                    </select>
                    
                    @if ($errors->has('school_year_id'))
                        
                        
                        <span class="help-block">


                        <strong>{{ $errors->first('school_year_id') }}</strong>


                    </span>
                    
                    
                    @endif
                
                
                </div>
                
                <div class = "form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    
                    
                    <label for = "name">Libellé</label>
                    
                    <input required type = "text" value = "{{ $classroom->name }}"
                           class = "form-control" name = "name" id = "name"
                           placeholder = "Libellé">
    
                    <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
    
                    <span id="name" class="sr-only">(required)</span>
                    
                    @if ($errors->has('name'))
                        
                        
                        <span class = "help-block">


                        <strong>{{ $errors->first('name') }}</strong>


                    </span>
                    
                    
                    @endif
                
                
                </div>
    
                <div class = "form-group {{ $errors->has('teacher_id') ? 'has-error' : '' }}">
        
        
                    <label for = "teacher_id">Enseignant en charge</label>
        
                    <select required id = "teacher_id" class = "form-control selectpicker show-tick"
                            name = "teacher_id" data-header="Sélectionner un professeur" data-live-search="true">
            
                        @foreach($teachers as $teacher)
                
                
                            <option {{ $classroom->teacher_id === $teacher->id ? 'selected' : '' }}
                                    data-tokens="{{ $teacher->firstname . ' ' . $teacher->lastname  }}"
                                    value="{{ $teacher->id }}">{{ $teacher->firstname . ' ' . $teacher->lastname }}</option>
            
            
                        @endforeach
        
        
                    </select>
        
                    @if ($errors->has('teacher_id'))
            
            
                        <span class = "help-block">


                        <strong>{{ $errors->first('teacher_id') }}</strong>


                    </span>
        
        
                    @endif
    
    
                </div>
    
    
                <button type = "button" @click = "back" class = "btn btn-default">
        
        
                    <span class = "glyphicon glyphicon-circle-arrow-left"></span> Retour
    
    
                </button>
                
                <button type = "submit" class = "btn btn-primary">
                    
                    
                    Modifier
                
                
                </button>
            
            
            </form>
        
        
        </div>
    
    
    </panel-default>


@endsection