@extends('layouts.admin_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        Paramètres
    
    </li>
    
    <li>
        
        <a href="{{ route('teacher.index') }}">Enseignants</a>
    
    </li>
    
    <li>
        
        <a href="{{ route('teacher.create') }}">Nouvel enseignant</a>
    
    </li>



@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot="header">
    
            Nouvel enseignant
        
        </template>
        
        
        
        <!-- Panel content -->
        
        
        <form class="" method="POST" action="{{ route('teacher.store') }}">
            
            
            <div class="col-md-6">
    
    
                {{ csrf_field() }}
    
                <fieldset>
                    
                
                    <legend>Etat civil</legend>
                   
                    <div class="form-group has-feedback {{ $errors->has('lastname') ? 'has-error' : '' }}">
        
        
                        <label for="lastname" >Nom</label>
            
                        <input required type="text" class="form-control"  name="lastname"
                               id="lastname" placeholder="Nom" value="{{ old('lastname') }}">
    
    
                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
    
                        <span id="lastname" class="sr-only">(required)</span>
            
                        @if ($errors->has('lastname'))
                
                
                            <span class="help-block">
    
    
                            <strong>{{ $errors->first('lastname') }}</strong>
    
    
                        </span>
            
            
                        @endif
    
    
                    </div> <!-- End last name -->
    
                    <div class="form-group has-feedback {{ $errors->has('firstname') ? 'has-error' : '' }}">
        
        
                        <label for="firstname" >Prénoms</label>
            
                        <input required type="text" class="form-control"  name="firstname"
                               id="firstname" placeholder="Prénoms" value="{{ old('firstname') }}">
    
    
                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
    
                        <span id="firstname" class="sr-only">(required)</span>
            
                        @if ($errors->has('firstname'))
                
                
                            <span class="help-block">
    
    
                            <strong>{{ $errors->first('firstname') }}</strong>
    
    
                        </span>
            
            
                        @endif
    
    
                     </div> <!-- End first name -->
    
                    <div class="form-group
                        {{ $errors->has('birth_date') ? 'has-error' : '' }}">
        
        
                        <label for="birth_date" >Date de naissance</label>
        
                        <div class="input-group date" data-provider="datepicker">
            
            
                            <input class="form-control" size="16" type="text" name="birth_date"
                                   value="{{ old('birth_date') }}" id="birth_date">
            
                            <div class="input-group-addon">
                
                
                                <span class="glyphicon glyphicon-th"></span>
            
            
                            </div>
        
        
                        </div>
        
        
        
                        @if ($errors->has('birth_date'))
            
            
                            <span class="help-block">


                        <strong>{{ $errors->first('birth_date') }}</strong>


                    </span>
        
        
                        @endif
    
    
                    </div> <!-- End birth date -->
                
                
                </fieldset>
                
                <fieldset>
                    
                    <legend>Localisation</legend>
    
                    <div class="form-group
                        {{ $errors->has('adress') ? 'has-error' : '' }}">
        
        
                        <label for="adress" >Adresse</label>
        
                        <input type="text" class="form-control"
                               name="adress" id="adress" value="{{ old('adress') }}">
        
                        @if ($errors->has('adress'))
            
            
                            <span class="help-block">
    
    
                            <strong>{{ $errors->first('adress') }}</strong>
    
    
                        </span>
        
        
                        @endif
    
    
                    </div> <!-- End address -->
    
                    <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
        
        
                        <label for="mobile" >Mobile</label>
        
                        <input type="tel" class="form-control" value="{{ old('mobile') }}"
                               name="mobile" id="mobile" placeholder="00000000">
        
                        @if ($errors->has('mobile'))
            
            
                            <span class="help-block">
    
    
                            <strong>{{ $errors->first('mobile') }}</strong>
    
    
                        </span>
        
        
                        @endif
    
    
                    </div> <!-- End mobile -->
    
                    <div class="form-group {{ $errors->has('other_phoone') ? 'has-error' : '' }}">
        
        
                        <label for="other_phoone" >Autres numéros</label>
        
                        <input type="tel" class="form-control"
                               name="other_phoone" id="other_phoone" placeholder="07895262,"
                               data-role="tagsinput" value="{{ old('other_phoone') }}">
        
                        @if ($errors->has('other_phoone'))
            
            
                            <span class="help-block">
    
    
                            <strong>{{ $errors->first('other_phoone') }}</strong>
    
    
                        </span>
        
        
                        @endif
    
    
                    </div> <!-- End other phone -->
                    
                    
                </fieldset>
                
            </div> <!-- End left column -->
            
            <div class="col-md-6">
                
                <fieldset>
                    
                    
                    <legend>Compte</legend>
    
                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
        
        
                        <label for="email" >E-mail</label>
        
                        <input required type="email" class="form-control" value="{{ old('email') }}"
                               name="email" id="email" placeholder="email@exemple.ci">
    
    
                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
    
                        <span id="reg_number" class="sr-only">(required)</span>
        
                        @if ($errors->has('email'))
            
            
                            <span class="help-block">


                        <strong>{{ $errors->first('email') }}</strong>


                    </span>
        
        
                        @endif
    
    
                    </div>
    
                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
        
        
                        <label for="password" >Mot de passe</label>
        
                        <input required type="password" class="form-control"
                               name="password" id="password">
    
    
                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
    
                        <span id="reg_number" class="sr-only">(required)</span>
        
                        @if ($errors->has('password'))
            
            
                            <span class="help-block">


                        <strong>{{ $errors->first('password') }}</strong>


                    </span>
        
        
                        @endif
    
    
                    </div>
    
                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
        
        
                        <label for="password_confirmation" >Confirmer le mot de passe</label>
        
                        <input required type="password" class="form-control"
                               name="password_confirmation" id="password_confirmation">
    
    
                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
    
                        <span id="reg_number" class="sr-only">(required)</span>
        
                        @if ($errors->has('password_confirmation'))
            
            
                            <span class="help-block">


                        <strong>{{ $errors->first('password_confirmation') }}</strong>


                    </span>
        
        
                        @endif
    
    
                    </div>
                    
                    
                </fieldset>
    
                <fieldset>
                   
                   
                   <legend>Professionnel</legend>
    
                    <div class="form-group
                        {{ $errors->has('hire_date') ? 'has-error' : '' }}">
        
        
                        <label for="hire_date" >Date d'embauche</label>
        
                        <div class="input-group date" data-provider="datepicker">
            
            
                            <input class="form-control" size="16" type="text" name="hire_date"
                                   value="{{ old('hire_date') }}" id="hire_date" readonly>
            
                            <div class="input-group-addon">
                
                
                                <span class="glyphicon glyphicon-th"></span>
            
            
                            </div>
        
        
                        </div>
        
        
        
                        @if ($errors->has('hire_date'))
            
            
                            <span class="help-block">


                        <strong>{{ $errors->first('hire_date') }}</strong>


                    </span>
        
        
                        @endif
    
    
                    </div> <!-- End hire data -->
    
                    <div class="form-group
                        {{ $errors->has('leaving_date') ? 'has-error' : '' }}">
        
        
                        <label for="leaving_date" >Date de depart</label>
        
                        <div class="input-group date" data-provider="datepicker">
            
            
                            <input class="form-control" size="16" type="text" name="leaving_date"
                                   value="{{ old('leaving_date') }}" id="leaving_date" readonly>
            
                            <div class="input-group-addon">
                
                
                                <span class="glyphicon glyphicon-th"></span>
            
            
                            </div>
        
        
                        </div>
        
        
        
                        @if ($errors->has('leaving_date'))
            
            
                            <span class="help-block">


                                <strong>{{ $errors->first('leaving_date') }}</strong>
        
        
                            </span>
        
        
                        @endif
    
    
                    </div> <!-- End leaving date -->
                   
                   
                </fieldset>
               
            
            </div> <!-- End right column -->
            
            <div class="col-md-7">
                
                
                <button type="submit" class="btn btn-primary">
                
                
                    Créer
            
            
                </button>
            
                
            </div>
        
        
        </form>
    
    
    
    </panel-default>


@endsection