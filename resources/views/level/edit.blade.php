@extends('layouts.admin_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href = "{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
        
        <a href = "{{ route('level.index') }}">Niveaux</a>
    
    </li>
    
    <li>
        
        {{ $level->name }}
    
    </li>



@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot = "header">
            
            {{ $level->name }}
        
        </template>
        
        
        <!-- Panel content -->
        
        
        <div class = "col-md-6">
            
            
            <form class = "" method = "POST" action = "{{ route('level.update', $level->id) }}" data-toggle="validator">
    
                <input name="_method" type="hidden" value="PATCH">
                
                {{ csrf_field() }}
                
                <div class = "form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    
                    
                    <label for = "name">Libellé</label>
                    
                    <input required type = "text" value = "{{ $level->name }}" class = "form-control" name = "name"
                           id = "name" placeholder = "Libéllé">
    
                    <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
    
                    <span id="lastname" class="sr-only">(required)</span>
                    
                    @if ( $errors->has('name') )
                        
                        
                        <span class = "help-block">


                            <strong>{{ $errors->first('name') }}</strong>


                        </span>
                    
                    
                    @endif
                
                
                </div>
                
                <div class = "form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    
                    
                    <label for = "academic_grade">Cycle</label>
                    
                    <select required id = "academic_grade" class = "form-control selectpicker show-tick"
                            name = "academic_grade" data-header="Sélectionner un cycle">
                        
                            
                        <option {{ $level->academic_grade === 'Maternelle' ? 'selected' : ''}}
                                value = "Maternelle">Maternelle</option>
                        
                        <option {{ $level->academic_grade === 'Primaire' ? 'selected' : '' }}
                                value = "Primaire">Primaire</option>
                        
                        <option {{ $level->academic_grade === 'Secondaire' ? 'selected' : '' }}
                                value = "Secondaire">Secondaire</option>
                    
                    
                    </select>
                    
                    @if ($errors->has('academic_grade'))
                        
                        
                        <span class = "help-block">


                        <strong>{{ $errors->first('academic_grade') }}</strong>


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