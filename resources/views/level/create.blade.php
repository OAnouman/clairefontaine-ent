@extends('layouts.admin_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
    
        <a href="{{ route('level.index') }}">Niveaux</a>
    
    </li>
    
    <li>
        
        <a href="{{ route('level.create') }}">Nouveau niveau</a>
    
    </li>



@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot="header">
    
            Nouveau niveau
        
        </template>
        
        
        
        <!-- Panel content -->
        
        
        <div class="col-md-6">
            
            
            <form method="POST" action="{{ route('level.store') }}" data-toggle="validator">
                
                
                {{ csrf_field() }}
                
                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    
                    
                    <label for="name" >Libellé</label>
                    
                    <input required type="text" value="{{ old('name') }}" class="form-control"
                           name="name" id="name" placeholder="Libéllé">
    
                    <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
    
                    <span id="name" class="sr-only">(required)</span>
                    
                    @if ($errors->has('name'))
                        
                        
                        <span class="help-block">


                        <strong>{{ $errors->first('name') }}</strong>


                    </span>
                    
                    
                    @endif
                
                
                </div>
                
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    
                    
                    <label for="academic_grade" >Cycle</label>
                    
                    <select required id = "academic_grade" class="form-control selectpicker show-tick"
                            name="academic_grade" data-header="Sélectionner un cycle">
                        
                        
                        <option value="Maternelle">Maternelle</option>
                        
                        <option value="Primaire">Primaire</option>
                        
                        <option value="Secondaire">Secondaire</option>
                        
                        
                    </select>
                    
                    @if ($errors->has('academic_grade'))
                        
                        
                        <span class="help-block">


                        <strong>{{ $errors->first('academic_grade') }}</strong>


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