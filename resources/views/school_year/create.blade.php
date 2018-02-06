@extends('layouts.admin_master')



@section('breadcrumb')


    <li>

        <a href="{{ route('home') }}">Accueil</a>

    </li>

    <li>

        Paramètres

    </li>

    <li>

        <a href="{{ url('/school-year') }}">Année scolaire</a>

    </li>

    <li>

        <a href="{{ url('/school-year/create') }}">Nouvelle année scolaire</a>

    </li>



@endsection


@section('work-section')


    <panel-default>


        <!-- Panel header -->


        <template slot="header">

            Nouvelle année scolaire

        </template>



        <!-- Panel content -->


        <form class="" method="POST" action="{{ route('school_year.store') }}" data-toggle="validator">


            {{ csrf_field() }}

            <div class="col-md-6">
    
    
                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
        
        
                    <label for="name" >Libellé</label>
        
                    <input required type="text" class="form-control"  name="name" id="name" placeholder="Libéllé">
        
                    <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
        
                    <span id="name" class="sr-only">(required)</span>
        
                    @if ($errors->has('name'))
            
            
                        <span class="help-block">


                        <strong>{{ $errors->first('name') }}</strong>


                    </span>
        
        
                    @endif
    
    
                </div>
                
                
            </div>

           <div class="col-md-7">
    
    
               <button type="submit" class="btn btn-primary">
        
        
                   Créer
    
    
               </button>
               
               
           </div>


        </form>



    </panel-default>


@endsection