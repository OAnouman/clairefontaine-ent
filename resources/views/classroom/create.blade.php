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
        
        <a href = "{{ route('classroom.create') }}">Nouvelle classe</a>
    
    </li>



@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot = "header">
            
            Nouvelle classe
        
        </template>
        
        
        <!-- Panel content -->
        
        
        <div class = "col-md-6">
            
            
            <form class = "" method = "POST" action = "{{ route('classroom.store') }}" data-toggle="validator">
                
                
                {{ csrf_field() }}
                
                
                <div class = "form-group {{ $errors->has('level_id') ? 'has-error' : '' }}">
                    
                    
                    <label for = "level_id">Niveau</label>
                    
                    <select required id = "level_id" @change="syncClass" data-header="Sélectionner un niveau"
                            class = "form-control selectpicker show-tick" name = "level_id"
                            data-live-search="true">
                        
                        <optgroup label = "Maternelle">
                            
                            
                            @foreach($kindergarten as $kinder)
                                
                                
                                <option data-tokens="{{ $kinder->name }}"
                                        value = "{{ $kinder->name }}">{{ $kinder->name }}</option>
                            
                            
                            @endforeach
                        
                        
                        </optgroup>
                        
                        <optgroup label = "Primaire">
                            
                            
                            @foreach($elementary as $elt)
                                
                                
                                <option data-tokens="{{ $elt->name }}"
                                        value = "{{ $elt->name }}">{{ $elt->name }}</option>
                            
                            
                            @endforeach
                        
                        
                        </optgroup>
                        
                        <optgroup label = "Secondaire">
                            
                            
                            @foreach($secondary as $sec)
                                
                                
                                <option data-tokens="{{ $sec->name }}"
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
                        
            
                        @foreach($schoolYears as $schoolYear )
                
                
                            <option value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
            
            
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
        
                    <input required type = "text" value = "{{ old('name') }}"
                           class = "form-control" name = "name" id = "name"
                           placeholder = "Libellé de la classe" @keyup="upperCaseInput($event)" />
    
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

                    <select id="teacher_id" class="form-control selectpicker show-tick"
                            name = "teacher_id" data-header="Sélectionner un professeur" data-live-search="true">
            
                       @foreach($teachers as $teacher)
                       
                       
                           <option data-tokens="{{ $teacher->firstname . ' ' . $teacher->lastname  }}"
                                   value="{{ $teacher->id }}">{{ $teacher->firstname . ' ' . $teacher->lastname }}</option>
                       
                       
                       @endforeach
        
        
                    </select>
        
                    @if ($errors->has('teacher_id'))
            
            
                        <span class = "help-block">


                        <strong>{{ $errors->first('teacher_id') }}</strong>


                    </span>
        
        
                    @endif
    
    
                </div>
                
                <button type = "submit" class = "btn btn-primary">
                    
                    
                    Créer
                
                
                </button>
            
            
            </form>
        
        
        </div>
    
    
    </panel-default>


@endsection