@extends('layouts.admin_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
    
        <a href="{{ route('student.index') }}">Elèves</a>
    
    </li>
    
    <li>
        
        {{ $student->firstname . ' ' . $student->lastname }}
    
    </li>


@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot="header">
    
            {{ $student->firstname . ' ' . $student->lastname }}
        
        </template>
        
        
        
        <!-- Panel content -->
        
        
        <div class="col-md-12">
            
            
            <form method="POST" action="{{ route( 'student.update', $student->id ) }}" enctype="multipart/form-data">
                
                
                {{ csrf_field() }}
    
                <input name="_method" type="hidden" value="PATCH">
                
                <div>
                    
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        
                        
                        <li role="presentation" class="active"><a href="#general"
                                                                  aria-controls="home" role="tab"
                                                                  data-toggle="tab">Information Générales</a></li>
                        
                        <li role="presentation"><a href="#schoolarship"
                                                   aria-controls="profile" role="tab"
                                                   data-toggle="tab">Scolarité</a></li>
                        
                        {{--<li role="presentation"><a href="#medical"--}}
                        {{--aria-controls="messages" role="tab"--}}
                        {{--data-toggle="tab">Fiche Médical</a></li>--}}
                    
                    
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                        
                        
                        <div role="tabpanel" class="tab-pane fade in active" id="general">
                            
                            
                            <div class="col-md-6">
                                
                                
                                <fieldset>
                                    
                                    
                                    <legend>Etat Civil</legend>
                                    
                                    <div class="form-group {{ $errors->has('picture') ? 'has-error' : '' }}">
                                        
                                        <label for="picture">Photo de l'élève</label>
                                        
                                        <input type="file" id="picture" name="picture" class="filestyle" data-buttonText="Select. Photo"
                                               data-buttonName="btn-primary" data-iconName="fa fa-file-text" data-size="sm"
                                               data-buttonBefore="true">
                                        
                                        @if ($errors->has('picture'))
                                            
                                            
                                            <span class="help-block">


                                                 <strong>{{ $errors->first('picture') }}</strong>
        
        
                                            </span>
                                        
                                        @else
                                            
                                            
                                            <span class="help-block">


                                                 <strong>Type autorisé : PNG, JPEG. Taille Max : 1 Mo</strong>
        
        
                                            </span>
                                        
                                        
                                        @endif
                                        
                                    
                                    </div>
                                    
                                    <div class="form-group has-feedback
                                        {{ $errors->has('reg_number') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="reg_number" >Matricule</label>
                                        
                                        <input required type="text" value="{{$student->reg_number }}" class="form-control"
                                               name="reg_number" id="reg_number" placeholder="Matricule">
                                        
                                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
                                        
                                        <span id="reg_number" class="sr-only">(required)</span>
                                        
                                        @if ($errors->has('reg_number'))
                                            
                                            
                                            <span class="help-block">


                                                 <strong>{{ $errors->first('reg_number') }}</strong>
        
        
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Registration number -->
                                    
                                    <div class="form-group has-feedback
                                        {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="lastname" >Nom</label>
                                        
                                        <input required type="text" value="{{ $student->lastname }}" class="form-control"
                                               name="lastname" id="lastname" placeholder="Nom">
                                        
                                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
                                        
                                        <span id="lastname" class="sr-only">(required)</span>
                                        
                                        @if ($errors->has('lastname'))
                                            
                                            
                                            <span class="help-block">


                                        <strong>{{ $errors->first('lastname') }}</strong>


                                    </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Last name -->
                                    
                                    <div class="form-group has-feedback
                                        {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="lastname" >Prènoms</label>
                                        
                                        <input required type="text" value="{{ $student->firstname }}" class="form-control"
                                               name="firstname" id="firstname" placeholder="Prènoms">
                                        
                                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
                                        
                                        <span id="firstname" class="sr-only">(required)</span>
                                        
                                        @if ($errors->has('firstname'))
                                            
                                            
                                            <span class="help-block">


                                                <strong>{{ $errors->first('firstname') }}</strong>
        
        
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End First name -->
                                    
                                    <div class="form-group col-md-6
                                        {{ $errors->has('birth_date') ? 'has-error' : '' }}"
                                         style="padding-left: 0; padding-right: 0 ">
                                        
                                        
                                        <label for="birth_date" >Date de naissance</label>
                                        
                                        <div class="input-group date" data-provider="datepicker">
                                            
                                            
                                            <input required class="form-control" size="16" type="text" name="birth_date"
                                                   value="{{ $student->birth_date }}" id="birth_date" />
                                            
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
                                    
                                    <div class="form-group col-md-6 has-feedback
                                        {{ $errors->has('birth_place') ? 'has-error' : '' }}"
                                         style="padding-right: 0;">
                                        
                                        
                                        <label for="birth_place" >Lieu</label>
                                        
                                        <input required type="text" value="{{ $student->birth_place }}" class="form-control"
                                               name="birth_place" id="birth_place" placeholder="Lieu">
                                        
                                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
                                        
                                        <span id="birth_date" class="sr-only">(required)</span>
                                        
                                        @if ($errors->has('birth_place'))
                                            
                                            
                                            <span class="help-block">


                                                <strong>{{ $errors->first('birth_place') }}</strong>
            
            
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Birth Place -->
                                    
                                    <div class="form-group">
                                        
                                        
                                        <div>
                                            
                                            
                                            <label>
                                                
                                                Sexe
                                            
                                            </label>
                                        
                                        
                                        </div>
                                        
                                        <label class="radio-inline">
                                            
                                            
                                            <input type="radio" name="sex"
                                                   id="fille" value="fille" {{ $student->sex === 'fille' ? 'checked' : '' }}>
                                            
                                            Fille
                                        
                                        
                                        </label>
                                        
                                        <label class="radio-inline">
                                            
                                            
                                            <input type="radio" name="sex"
                                                   id="garçon" value="garçon" {{ $student->sex === 'garçon' ? 'checked' : '' }}>
                                            
                                            Garçon
                                        
                                        
                                        </label>
                                    
                                    
                                    
                                    </div> <!-- End Sex -->
                                    
                                    <div class="form-group has-feedback
                                        {{ $errors->has('nationalities') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="nationalities" >Nationalités</label>
                                        
                                        <input type="tel" class="form-control" required
                                               name="nationalities" id="nationalities" placeholder="Ivoirienne, Libanaise..."
                                               data-role="tagsinput" value="{{ $student->nationalities }}">
                                        
                                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
                                        
                                        <span id="nationalities" class="sr-only">(required)</span>
                                        
                                        @if ($errors->has('nationalities'))
                                            
                                            
                                            <span class="help-block">
    
    
                                                <strong>{{ $errors->first('nationalities') }}</strong>
    
    
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Nationalité -->
                                
                                
                                </fieldset> <!-- End FieldSet Etat civil -->
                                
                                <fieldset>
                                    
                                    
                                    <legend>Reponsables légaux</legend>
                                    
                                    <div class="form-group
                                        {{ $errors->has('father_name') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="father_name" >Nom du père</label>
                                        
                                        <input type="text" value="{{ $student->father_name }}" class="form-control"
                                               name="father_name" id="father_name" placeholder="Nom du père">
                                        
                                        @if ($errors->has('father_name'))
                                            
                                            
                                            <span class="help-block">


                                         <strong>{{ $errors->first('father_name') }}</strong>


                                    </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Father name -->
                                    
                                    <div class="form-group
                                        {{ $errors->has('father_job') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="father_job" >Profession du père</label>
                                        
                                        <input type="text" value="{{ $student->father_job }}" class="form-control"
                                               name="father_job" id="father_job" placeholder="Profession du père">
                                        
                                        @if ($errors->has('father_job'))
                                            
                                            
                                            <span class="help-block">


                                                <strong>{{ $errors->first('father_job') }}</strong>
        
        
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Father job -->
                                    
                                    <div class="form-group
                                        {{ $errors->has('father_phones') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="father_phones" >Téléphones du père</label>
                                        
                                        <input type="tel" class="form-control"
                                               name="father_phones" id="father_phones" placeholder="01010101,02020202..."
                                               data-role="tagsinput" value="{{ $student->father_phones }}">
                                        
                                        @if ($errors->has('father_phones'))
                                            
                                            
                                            <span class="help-block">
    
    
                                                <strong>{{ $errors->first('father_phones') }}</strong>
    
    
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Father phones -->
                                
                                
                                </fieldset> <!-- End FieldSet Responsable légaux -->
                            
                            
                            </div> <!-- End Left column-->
                            
                            <div class="col-md-6">
                                
                                
                                <fieldset>
                                    
                                    
                                    <legend>Reponsables légaux (suite)</legend>
                                    
                                    <div class="form-group
                                        {{ $errors->has('mother_name') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="mother_name" >Nom de la mère</label>
                                        
                                        <input type="text" value="{{ $student->mother_name }}" class="form-control"
                                               name="mother_name" id="father_name" placeholder="Nom de la mère">
                                        
                                        @if ($errors->has('mother_name'))
                                            
                                            
                                            <span class="help-block">


                                                 <strong>{{ $errors->first('mother_name') }}</strong>
        
        
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Mother name -->
                                    
                                    <div class="form-group
                                        {{ $errors->has('mother_job') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="mother_job" >Profession de la mère</label>
                                        
                                        <input type="text" value="{{ $student->mother_job }}" class="form-control"
                                               name="mother_job" id="mother_job" placeholder="Profession de la mère">
                                        
                                        @if ($errors->has('mother_job'))
                                            
                                            
                                            <span class="help-block">


                                                <strong>{{ $errors->first('mother_job') }}</strong>
        
        
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Mother Job -->
                                    
                                    <div class="form-group
                                        {{ $errors->has('mother_phones') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="mother_phones" >Téléphones de la mère</label>
                                        
                                        <input type="tel" class="form-control"
                                               name="mother_phones" id="mother_phones" placeholder="01010101,02020202..."
                                               data-role="tagsinput" value="{{ $student->mother_phones }}">
                                        
                                        @if ($errors->has('mother_phones'))
                                            
                                            
                                            <span class="help-block">
    
    
                                                <strong>{{ $errors->first('mother_phones') }}</strong>
    
    
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End mother phone -->
                                    
                                    <div class="form-group
                                        {{ $errors->has('guardian_name') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="guardian_name" >Nom du tuteur</label>
                                        
                                        <input type="text" value="{{ $student->guardian_name }}" class="form-control"
                                               name="guardian_name" id="guardian_name" placeholder="Nom du tuteur">
                                        
                                        @if ($errors->has('guardian_name'))
                                            
                                            
                                            <span class="help-block">


                                                 <strong>{{ $errors->first('guardian_name') }}</strong>
        
        
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Guardian name -->
                                    
                                    <div class="form-group
                                        {{ $errors->has('guardian_phones') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="guardian_phones" >Téléphones du tuteur</label>
                                        
                                        <input type="tel" class="form-control"
                                               name="guardian_phones" id="guardian_phones" placeholder="01010101,02020202..."
                                               data-role="tagsinput" value="{{ $student->guardian_phones }}">
                                        
                                        @if ($errors->has('guardian_phones'))
                                            
                                            
                                            <span class="help-block">
    
    
                                                <strong>{{ $errors->first('guardian_phones') }}</strong>
    
    
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Guardian phone -->
                                
                                
                                </fieldset> <!-- End FieldSet Responsable légaux (suite)-->
                                
                                <fieldset>
                                    
                                    <legend>
                                        
                                        Localisation
                                    
                                    </legend>
                                    
                                    <div class="form-group
                                        {{ $errors->has('living_place') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="living_place" >Lieu de résidence</label>
                                        
                                        <input type="text" value="{{ $student->living_place }}" class="form-control"
                                               name="living_place" id="living_place" placeholder="Lieu de résidence">
                                        
                                        @if ($errors->has('living_place'))
                                            
                                            
                                            <span class="help-block">


                                                 <strong>{{ $errors->first('living_place') }}</strong>
        
        
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Living Place -->
                                    
                                    <div class="form-group
                                        {{ $errors->has('address') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="address" >Adresse</label>
                                        
                                        <input type="text" value="{{ $student->address }}" class="form-control"
                                               name="address" id="address" placeholder="Adresse">
                                        
                                        @if ($errors->has('address'))
                                            
                                            
                                            <span class="help-block">


                                                 <strong>{{ $errors->first('address') }}</strong>
        
        
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Adress -->
                                    
                                    <div class="form-group
                                        {{ $errors->has('emails') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="emails" >Emails</label>
                                        
                                        <input type="text" class="form-control"
                                               name="emails" id="emails" placeholder="test@example.fr,test2@exemple.fr..."
                                               data-role="tagsinput" value="{{ $student->emails }}">
                                        
                                        @if ($errors->has('emails'))
                                            
                                            
                                            <span class="help-block">
    
    
                                                <strong>{{ $errors->first('emails') }}</strong>
    
    
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End mother phone -->
                                
                                
                                </fieldset> <!-- End Localisation -->
                            
                            
                            </div> <!-- End right column -->
                        
                        
                        
                        </div> <!-- End Info Grl tab -->
                        
                        <div role="tabpanel" class="tab-pane fade" id="schoolarship">
                            
                            
                            <div class="col-md-6">
                                
                                
                                <fieldset>
                                    
                                    
                                    <legend>
                                        
                                        Scolarité
                                    
                                    </legend>
                                    
                                    <div class="form-group
                                        {{ $errors->has('subscription_date') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="subscription_date" >Date d'inscription</label>
                                        
                                        <div class="input-group date" data-provider="datepicker">
                                            
                                            
                                            <input required class="form-control" size="16" type="text" name="subscription_date"
                                                   value="{{ $student->subscription_date }}" id="subscription_date" readonly>
                                            
                                            <div class="input-group-addon">
                                                
                                                
                                                <span class="glyphicon glyphicon-th"></span>
                                            
                                            
                                            </div>
                                        
                                        
                                        </div>
                                        
                                        
                                        
                                        @if ($errors->has('subscription_date'))
                                            
                                            
                                            <span class="help-block">


                                                <strong>{{ $errors->first('subscription_date') }}</strong>
                        
                        
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End subcription date -->
                                    
                                    <div class="form-group
                                        {{ $errors->has('origin_school') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="origin_school" >Ecole d'origine</label>
                                        
                                        <input type="text" value="{{$student->origin_school }}" class="form-control"
                                               name="origin_school" id="origin_school" placeholder="Ecole d'origine">
                                        
                                        
                                        @if ($errors->has('origin_school'))
                                            
                                            
                                            <span class="help-block">


                                                 <strong>{{ $errors->first('origin_school') }}</strong>
        
        
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End origin school -->
                                    
                                    <div class="form-group
                                        {{ $errors->has('resp_schooling') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="resp_schooling" >Responsable de la scolarité</label>
                                        
                                        <select id = "resp_schooling" class="form-control selectpicker show-tick"
                                                name="resp_schooling" data-header="Sélectionner un responsable">
    
    
                                            <option {{ $student->resp_schooling === 'Père et Mère' ? 'selected' : '' }}
                                                    value="Père et Mère">Père et Mère</option>
                                            
                                            <option {{ $student->resp_schooling === 'Père' ? 'selected' : '' }}
                                                    value="Père">Père</option>
                                            
                                            <option {{ $student->resp_schooling === 'Mère' ? 'selected' : '' }}
                                                    value="Mère">Mère</option>
                                            
                                            <option {{ $student->resp_schooling === 'Tuteur' ? 'selected' : '' }}
                                                    value="Tuteur">Tuteur</option>
                                        
                                        
                                        </select>
                                        
                                        @if ($errors->has('resp_schooling'))
                                            
                                            
                                            <span class="help-block">
        
        
                                                <strong>{{ $errors->first('resp_schooling') }}</strong>
                            
                            
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End resp o schoolarship -->
                                
                                
                                </fieldset> <!-- End schoolarship -->
                                
                                <fieldset>
                                    
                                    
                                    <legend>
                                        
                                        Options d'inscription et CNED
                                    
                                    </legend>
                                    
                                    <div class="form-group
                                        {{ $errors->has('second_living_language') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="second_living_language" >Langue vivante 2</label>
                                        
                                        <select id = "second_living_language" class="form-control selectpicker show-tick"
                                                name="second_living_language" data-header="Sélectionner une langue"
                                                title="Selectionner une langue">
                                            
                                            
                                            <option {{ $student->second_living_language === 'Allemand' ? 'selected' : '' }}
                                                    value="Allemand">Allemand</option>
                                            
                                            <option {{ $student->second_living_language === 'Espagnol' ? 'selected' : '' }}
                                                    value="Espagnol">Espagnol</option>
                                        
                                        
                                        </select>
                                        
                                        @if ($errors->has('second_living_language'))
                                            
                                            
                                            <span class="help-block">
    
    
                                                <strong>{{ $errors->first('second_living_language') }}</strong>
                            
                            
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End resp o schoolarship -->
                                    
                                    <div class="form-group
                                        {{ $errors->has('cned_id') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="cned_id" >Identifiant CNED</label>
                                        
                                        <input type="text" value="{{ $student->cned_id }}" class="form-control"
                                               name="cned_id" id="cned_id" placeholder="Identifiant CNED">
                                        
                                        @if ($errors->has('cned_id'))
                                            
                                            
                                            <span class="help-block">


                                                <strong>{{ $errors->first('cned_id') }}</strong>
        
        
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Last name -->
                                    
                                    <div class="form-group
                                        {{ $errors->has('cned_password') ? 'has-error' : '' }}">
                                        
                                        
                                        <label for="cned_password" >Mot de passe CNED</label>
                                        
                                        <input type="text" value="{{ $student->cned_password }}" class="form-control"
                                               name="cned_password" id="cned_password" placeholder="Mot de passe CNED">
                                        
                                        @if ($errors->has('cned_password'))
                                            
                                            
                                            <span class="help-block">


                                                <strong>{{ $errors->first('cned_password') }}</strong>
        
        
                                            </span>
                                        
                                        
                                        @endif
                                    
                                    
                                    </div> <!-- End Last name -->
                                
                                </fieldset> <!-- End subcriptio feature -->
                            
                            
                            </div>
                            
                            <div class="col-md-6">
                                
                                
                                <fieldset>
                                    
                                    
                                    <legend>
                                        
                                        Eléments du dossier
                                    
                                    </legend>
                                    
                                    <div class="form-group">
                                        
                                        
                                        <label class="checkbox-inline">
                                            
                                            
                                            <input type="checkbox" name="gave_id_picture"
                                                   id="gave_id_picture" value="1"
                                                    {{ $student->gave_id_picture === 1 ? 'checked' : '' }}> Photo d'identité
                                        
                                        
                                        </label>
                                        
                                        <label class="checkbox-inline pull-right">
                                            
                                            
                                            <input type="checkbox" name="gave_birth_act"
                                                   id="gave_birth_act" value="1"
                                                    {{ $student->gave_birth_act === 1 ? 'checked' : '' }}>
                                            
                                            Acte de naissance
                                        
                                        
                                        </label>
                                    
                                    
                                    </div> <!-- ID, BIrt Act -->
                                    
                                    <div class="form-group">
                                        
                                        
                                        <label class="checkbox-inline">
                                            
                                            
                                            <input type="checkbox" name="gave_vaccination_notebook"
                                                   id="gave_vaccination_notebook" value="1"
                                                    {{ $student->gave_vaccination_notebook === 1 ? 'checked' : '' }}>
                                            
                                            Carnet de vaccination
                                        
                                        
                                        </label>
                                        
                                        <label class="checkbox-inline pull-right">
                                            
                                            
                                            <input type="checkbox" name="gave_cancellation_certificate"
                                                   id="gave_cancellation_certificate" value="1"
                                                    {{ $student->gave_cancellation_certificate === 1 ? 'checked' : '' }}>
                                            
                                            Certificat de radiation
                                        
                                        
                                        </label>
                                        
                                    
                                    </div> <!-- Vaccination, Cancellation -->
    
                                    <div class="form-group">
        
        
                                        <label class="checkbox-inline">
            
            
                                            <input type="checkbox" name="gave_gradebook"
                                                   id="gave_gradebook" value="1"
                                                    {{ $student->gave_gradebook === 1 ? 'checked' : '' }}>
            
                                            Livret de notes
        
        
                                        </label>
    
    
                                    </div> <!-- Gradebook -->
                                
                                
                                </fieldset> <!-- End subscription items -->
                                
                                <fieldset>
                                    
                                    
                                    <legend>
                                        
                                        Divers
                                    
                                    </legend>
                                    
                                    <div class="checkbox">
                                        
                                        
                                        <label class="control-label">
                                            
                                            
                                            <input type="checkbox" name="is_image_right_allowed"
                                                   id="is_image_right_allowed" value="1"
                                                    {{ $student->is_image_right_allowed === 1 ? 'checked' : '' }}>
                                            
                                            Autorisation d'exploitation d'image
                                        
                                        
                                        </label>
                                    
                                    
                                    </div> <!-- Image right -->
                                    
                                    <div class="checkbox">
                                        
                                        
                                        <label class="control-label">
                                            
                                            
                                            <input type="checkbox" name="is_special_program"
                                                   id="is_special_program" value="1"
                                                    {{ $student->is_special_program === 1 ? 'checked' : '' }}>
                                            
                                            Programme spécial
                                        
                                        
                                        </label>
                                    
                                    
                                    </div> <!-- Special program -->
                                    
                                    <div class="checkbox">
                                        
                                        
                                        <label class="control-label">
                                            
                                            
                                            <input type="checkbox" name="is_removed"
                                                   id="is_removed" value="1"
                                                    {{ $student->is_removed === 1 ? 'checked' : '' }}>
                                            
                                            Radié
                                        
                                        
                                        </label>
                                    
                                    
                                    </div> <!-- Removed -->
                                
                                
                                </fieldset>
                            
                            
                            </div>
                        
                        
                        
                        </div> <!-- End Info Scolarité tab -->
                        
                        {{--<div role="tabpanel" class="tab-pane fade" id="medical">--}}
                        {{----}}
                        {{----}}
                        {{-- TODO: Medical Sheet Fields --}}
                        {{----}}
                        {{----}}
                        {{--</div> <!-- End Info Medical tab -->--}}
                    
                    
                    </div> <!-- End Info tab -->
                
                </div>
                
                
                <div class="col-md-12">
                    
                    <hr>
    
                    <button type="button" @click="back" class="btn btn-default">
        
        
                        <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
    
    
                    </button>
                    
                    <button type="submit" class="btn btn-primary">
                        
                        
                        Modifier
                    
                    
                    </button>
                
                
                </div>
            
            
            </form>
        
        
        </div>
    
    
    
    </panel-default>


@endsection