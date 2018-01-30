@extends('layouts.admin_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
        
        <a href="{{ route('subject.index') }}">Matières</a>
    
    </li>
    
    <li>
        
        <a href="{{ route('subject.create') }}">Nouvelle matièreu</a>
    
    </li>



@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot="header">
            
            Nouvelle matière
        
        </template>
        
        
        
        <!-- Panel content -->
        
        
        <div class="col-md-6">
            
            
            <form method="POST" action="{{ route('subject.store') }}">
                
                
                {{ csrf_field() }}
                
                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    
                    
                    <label for="name" >Libellé</label>
                    
                    <input required type="text" value="{{ old('name') }}"
                           class="form-control"  name="name" id="name" placeholder="Libéllé">
    
                    <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
    
                    <span id="name" class="sr-only">(required)</span>
                    
                    @if ($errors->has('name'))
                        
                        
                        <span class="help-block">


                        <strong>{{ $errors->first('name') }}</strong>


                    </span>
                    
                    
                    @endif
                
                
                </div>
                
                <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                    
                    
                    <label for="category">Catégorie</label>
    
                    <select class="selectpicker show-tick form-control" name="category"
                            id="category" data-header="Selectionner une catégorie">
                        
                        
                        <option value="Littéraire">Littéraire</option>
                        
                        <option value="Scientifique">Scientifique</option>
                        
                        <option value="Artistique">Artistique</option>
                        
                        <option value="Autres">Autres</option>
                        
                    
                    </select>


                @if ($errors->has('category'))
                        
                        
                        <span class="help-block">


                        <strong>{{ $errors->first('category') }}</strong>


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