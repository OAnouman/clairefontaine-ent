@extends('layouts.parent.parent_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}"> <span class="glyphicon glyphicon-dashboard"></span> Tableau de bord</a>
    
    </li>

    <li>
    
        <i class="fa fa-user" aria-hidden="true"></i> Mon profil

    </li>


@endsection


@section('work-section')
    
    
    <div class="row heading">
        
        <div class="col-md-8">
            
            <h3>
                
              Mon profil <br> <small>Consulter votre fiche scolaire</small  >
            
            </h3>
        
        </div>
        
        <div class="col-md-4 pull-right">
            
            <h3 class="text-right"> {{ $student->classrooms()->latest()->first()->name }} </h3>
        
        </div>
    
    
    </div>
    
    <div class="row content">
    
    
        <div class="col-md-12">
        
        
            <form>
            
            
                <div class="row profile-picture"> <!-- Picture block -->
                
                
                    <div class="col-md-12">
                    
                    
                        <img width="140" height="140" class="img-responsive img-circle center-block"
                             src="{{ asset(config('image.uploads_path') . '/' . $student->picture) }}">
                
                
                    </div>
            
            
                </div> <!-- End Picture block -->
            
                <div class="row"> <!-- Content block -->
                
                
                
                    <div class="col-md-6">
                    
                    
                        <fieldset>
                        
                        
                            <legend>Etat Civil</legend> <!-- Etat Civil -->
                        
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Matricule :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->reg_number }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Registration number -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Nom :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->lastname }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Last name -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px" >Prénoms :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->firstname }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End First name -->
                        
                            <div class="form-group" >
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Date naiss. :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->birth_date }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End birth date -->
                        
                            <div class="form-group" >
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Lieu :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->birth_place }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Birth Place -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Sexe :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ ucfirst( $student->sex ) }} </p>
                            
                                </div>
                        
                        
                        
                            </div> <!-- End Sex -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Nationalités :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->nationalities }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Nationalité -->
                    
                    
                        </fieldset> <!-- End FieldSet Etat civil -->
                    
                        <fieldset>
                        
                        
                            <legend>Reponsables légaux</legend>
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Père :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->father_name }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Father name -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Prof. Père :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->father_job }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Father job -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Tél. Père :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->father_phones }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Father phones -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Mère :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->father_name }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Mother name -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Prof. Mère :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->motherr_job}} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Mother Job -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Tél. Mère :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->mother_phones }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End mother phone -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Tuteur :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->guardian_name }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Guardian name -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Tél. Tuteur :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->guardian_phones }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Guardian phone -->
                    
                    
                        </fieldset> <!-- End FieldSet Responsable légaux -->
                    
                        <fieldset>
                        
                            <legend>
                            
                                Localisation
                        
                            </legend>
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Lieu :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->living_place }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Living Place -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Adresse :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->address }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Adress -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Emails :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->emails }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End emails -->
                    
                    
                        </fieldset> <!-- End Localisation -->
                
                    </div>
                
                
                    <div class="col-md-6">
                    
                    
                        <fieldset>
                        
                        
                            <legend>
                            
                                Scolarité
                        
                            </legend>
                        
                            <div class="form-group
                                        {{ $errors->has('subscription_date') ? 'has-error' : '' }}">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Date Inscrip. :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->subscription_date }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End subcription date -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Ecole origine :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->origin_school }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End origin school -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Resp. Scol. :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->resp_schooling }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End resp o schoolarship -->
                    
                    
                        </fieldset> <!-- End schoolarship -->
                    
                        <fieldset>
                        
                        
                            <legend>
                            
                                Options d'inscription et CNED
                        
                            </legend>
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">LV2 :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->second_living_language }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End LV2 -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">ID CNED :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->cned_id }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End CNED ID -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">MP CNED :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->cned_password }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End CNED password -->
                    
                        </fieldset> <!-- End subcriptio feature -->
                    
                        <fieldset>
                        
                        
                            <legend>
                            
                                Eléments du dossier
                        
                            </legend>
                        
                            <div class="form-group">
                            
                            
                                <label class="checkbox-inline control-label">
                                
                                
                                    <input type="checkbox"  disabled
                                            {{ $student->gave_id_picture === 1 ? 'checked' : '' }}> Photo d'identité
                            
                            
                                </label>
                            
                                <label class="checkbox-inline pull-right control-label">
                                
                                
                                    <input type="checkbox" disabled
                                            {{ $student->gave_birth_act === 1 ? 'checked' : '' }}>
                                
                                    Acte de naissance
                            
                            
                                </label>
                        
                        
                            </div> <!-- ID, BIrt Act -->
                        
                            <div class="form-group">
                            
                            
                                <label class="checkbox-inline control-label">
                                
                                
                                    <input type="checkbox" disabled
                                            {{ $student->gave_vaccination_notebook === 1 ? 'checked' : '' }}>
                                
                                    Carnet de vaccination
                            
                            
                                </label>
                            
                                <label class="checkbox-inline pull-right control-label">
                                
                                
                                    <input type="checkbox" disabled
                                            {{ $student->gave_cancellation_certificate === 1 ? 'checked' : '' }}>
                                
                                    Certificat de radiation
                            
                            
                                </label>
                        
                        
                            </div> <!-- Vaccination , cancellation -->
                        
                            <div class="form-group">
                            
                            
                                <label class="checkbox-inline control-label">
                                
                                
                                    <input type="checkbox" disabled
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
                                
                                
                                    <input type="checkbox" disabled
                                            {{ $student->is_image_right_allowed === 1 ? 'checked' : '' }}>
                                
                                    Autorisation d'exploitation d'image
                            
                            
                                </label>
                        
                        
                            </div> <!-- Image right -->
                        
                            <div class="checkbox">
                            
                            
                                <label class="control-label">
                                
                                
                                    <input type="checkbox" disabled
                                            {{ $student->is_special_program === 1 ? 'checked' : '' }}>
                                
                                    Programme spécial
                            
                            
                                </label>
                        
                        
                            </div> <!-- Special program -->
                        
                            <div class="checkbox">
                            
                            
                                <label>
                                
                                
                                    <input type="checkbox" disabled
                                            {{ $student->is_removed === 1 ? 'checked' : '' }}>
                                
                                    Radié
                            
                            
                                </label>
                        
                        
                            </div> <!-- Removed -->
                    
                    
                        </fieldset> <!-- End Divers -->
                    
                        <fieldset> <!-- Account -->
                        
                        
                            <legend>
                            
                                Compte ENT
                        
                            </legend>
                        
                            <div class="form-group">
                            
                            
                                <label class="col-md-4 control-label" style="padding-top: 7.2px">Login :</label>
                            
                                <div class="col-md-8">
                                
                                    <p class="form-control-static"> {{ $student->username }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Last name -->
                    
                    
                        </fieldset> <!-- End Account -->
                
                
                    </div>
            
            
                </div>
        
        
        
        
            </form>
        
            {{-- Emergency contact section --}}
        
            <div id="emergency" class="row">
            
            
                @section('emergency-contact')
                
                
                    <fieldset class="col-md-6">
                    
                    
                        <legend>
                        
                            Contacts en cas d'urgences
                    
                        </legend>
                
                    @include('student.emergency-contact')
                
                    <!-- Button trigger modal -->
                    
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#emergencyFormModal">
                        
                        
                            Ajouter
                    
                    
                        </button>
                
                
                    </fieldset>
            
            
                @show
        
        
            </div>
        
            <hr>
    
            {{-- Button section --}}
    
            <div class="row">
                
        
                <div class=" pull-right">
            
            
                    <a href="" class="btn btn-danger" role="button">
    
    
                        <i class="fa fa-comment-o" aria-hidden="true"></i> Demander une modification
            
            
                    </a>
        
        
                </div>
    
    
            </div>
        
            <!-- Modal -->
        
            <div class="modal fade" id="emergencyFormModal" tabindex="-1"
                 role="dialog" aria-labelledby="myModalLabel">
            
            
                <div class="modal-dialog" role="document">
                
                
                    <div class="modal-content">
                    
                    
                        <div class="modal-header">
                        
                        
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                            <h4 class="modal-title" id="myModalLabel">Ajouter un contact</h4>
                    
                    
                        </div>
                    
                        <div class="modal-body">
                        
                        
                            <form id="emergencyContactForm" action="" method="POST">
                            
                            
                                <div id="name-div" class="form-group has-feedback
                                                {{ $errors->has('name') ? 'has-error' : '' }}">
                                
                                
                                    <label for="name" >Nom et prénoms</label>
                                
                                    <input required type="text" value="{{ old('name') }}" class="form-control"
                                           name="name" id="name" placeholder="Nom et prénoms">
                                
                                    <span class="glyphicon glyphicon-asterisk form-control-feedback"
                                          aria-hidden="true"></span>
                                
                                    <span id="name" class="sr-only">(required)</span>
                                
                                    @if ($errors->has('name'))
                                    
                                    
                                        <span class="help-block">


                                             <strong>{{ $errors->first('name') }}</strong>
    
    
                                        </span>
                                
                                
                                    @endif
                            
                            
                                </div> <!-- End name -->
                            
                                <div id="link-div" class="form-group has-feedback
                                                {{ $errors->has('link') ? 'has-error' : '' }}">
                                
                                
                                    <label for="link" >Lien avec l'élève</label>
                                
                                    <input required type="text" value="{{ old('link') }}" class="form-control"
                                           name="link" id="link" placeholder="Lien avec l'élève">
                                
                                    <span class="glyphicon glyphicon-asterisk form-control-feedback"
                                          aria-hidden="true"></span>
                                
                                    <span id="link" class="sr-only">(required)</span>
                                
                                    @if ($errors->has('link'))
                                    
                                    
                                        <span class="help-block">


                                             <strong>{{ $errors->first('link') }}</strong>
    
    
                                        </span>
                                
                                
                                    @endif
                            
                            
                                </div> <!-- End link -->
                            
                                <div id="phones-div" class="form-group has-feedback
                                                {{ $errors->has('phones') ? 'has-error' : '' }}">
                                
                                
                                    <label for="phones" >Téléphones</label>
                                
                                    <input required type="text" value="{{ old('phones') }}" class="form-control"
                                           name="phones" id="phones" placeholder="Téléphones" data-role="tagsinput">
                                
                                    <span class="glyphicon glyphicon-asterisk form-control-feedback"
                                          aria-hidden="true"></span>
                                
                                    <span id="phones" class="sr-only">(required)</span>
                                
                                    @if ($errors->has('phones'))
                                    
                                    
                                        <span class="help-block">


                                             <strong>{{ $errors->first('phones') }}</strong>
    
    
                                        </span>
                                
                                
                                    @endif
                            
                            
                                </div> <!-- End phones -->
                            
                                <input type="hidden" name="student_id" value="{{ $student->id }}"/>
                        
                        
                        
                            </form>
                    
                    
                        </div>
                    
                        <div class="modal-footer">
                        
                        
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        
                            <button @click="submitEmergencyForm" type="button"
                                    class="btn btn-primary"> Ajouter </button>
                    
                    
                        </div>
                
                
                    </div>
            
            
                </div>
        
        
            </div>
    
    
        </div>
    
    
    </div>


@endsection