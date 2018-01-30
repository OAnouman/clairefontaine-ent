@extends('layouts.admin_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
    
        <a href="{{ route('student.index') }}">Elèves</a>
    
    </li>
    
    <li>
        
        Importer les donnèes
    
    </li>



@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot="header">
            
            Importer des données
        
        </template>
        
        
        
        <!-- Panel content -->
        
        
        <div class="col-md-6">
            
            
            <form method="POST" action="{{ route('student.import_csv') }}" enctype="multipart/form-data">
                
                
                {{ csrf_field() }}
                
                <div class="form-group {{ $errors->has('csv') ? 'has-error' : '' }}">
                    
                    
                    <label for="csv"> Fichier CSV </label>
    
                    <input type="file" id="csv" name="csv" class="filestyle" data-buttonText="Select. CSV"
                        data-buttonName="btn-primary" data-iconName="fa fa-file-text" data-size="sm"
                        data-buttonBefore="true">
                    
                    @if ($errors->has('csv'))
                        
                        
                        <span class="help-block">


                            <strong>{{ $errors->first('csv') }}</strong>
    
    
                        </span>
                    
                    
                    @endif
                
                
                </div>
                
                <button data-loading-text="Importation en cours..."
                        @click="loadingState($event)" type="submit" class="btn btn-primary">
                    
                    
                    Importer
                
                
                </button>
            
            
            </form>
        
        
        </div>
    
    
    
    </panel-default>


@endsection