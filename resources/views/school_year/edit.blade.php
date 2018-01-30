@extends('layouts.admin_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href = "{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
        
        <a href = "{{ url('/school-year') }}">Année scolaire</a>
    
    </li>
    
    <li>
        
        Année scolaire {{ $schoolYear->name }}
    
    </li>



@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot = "header">
            
            Année scolaire {{ $schoolYear->name }}
        
        </template>
        
        
        <!-- Panel content -->
        
        
        <form method = "POST" action = "{{ route('school_year.update', $schoolYear->id) }}">
            
            
            {{ csrf_field() }}
            
            <input name = "_method" type = "hidden" value = "PATCH">
            
            <div class="col-md-6">
    
    
                <div class = "form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
        
        
                    <label for = "name">Libellé</label>
        
                    <input required type = "text" class = "form-control" value = "{{ $schoolYear->name }}" name = "name" id = "name"
                           placeholder = "Libéllé">
        
                    <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
        
                    <span id="lastname" class="sr-only">(required)</span>
        
                    @if ($errors->has('name'))
            
            
                        <span class = "help-block">


                        <strong>{{ $errors->first('name') }}</strong>


                    </span>
        
        
                    @endif
    
    
                </div>
                
                
            </div>
            
            <div class="col-md-7">
    
    
                <button type = "button" @click = "back" class = "btn btn-default">
        
        
                    <span class = "glyphicon glyphicon-circle-arrow-left"></span> Retour
    
    
                </button>
                
                
            </div>
            
            <button type = "submit" class = "btn btn-primary">
                
                
                Modifier
            
            
            </button>
        
        
        </form>
    
    
    </panel-default>


@endsection