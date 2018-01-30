@extends('layouts.master-print')


@section('content')
    
   <style>
       
       
       body {
    
    
           background-color: #fff;
    
           color: #000;
           
           
       }

       /* Print */

       #clfe-name {
    
    
           margin-top : -15px;
    
           margin-left : -40px;
    
           font-family: "Vladimir Script", serif ;
    
           font-size : 4em;
    
    
       }
       
   </style>
    
    <div class="row">
    
    
        <div class="col-xs-12">
    
    
           <div class="col-xs-2">
    
    
               <img class="img-responsive" src="{{ asset('images/clfe_260x260.png') }}"
                    width="120" height="120"/>
               
               
           </div>
            
            <h4 id="clfe-subname" class="col-xs-5 text-uppercase">
                Ecole Internationale
                
            </h4>
    
            <h3 id="clfe-name" class="col-xs-6">
                Clairefontaine
    
            </h3>
            

        </div>
        
        <br>
        
        <br>
        
        
        <div id="print" class="col-xs-12">
        
        
            <form>
            
            
                <div class="row"> <!-- Picture block -->
                
                
                    <div class="col-xs-12">
                    
                    
                        <img width="140" height="140" class="img-responsive img-circle center-block"
                             src="{{ asset(config('image.uploads_path') . '/' . $student->picture) }}">
                
                
                    </div>
            
            
                </div> <!-- End Picture block -->
            
                <div class="row"> <!-- Content block -->
                
                
                
                    <div class="col-xs-6">
                    
                    
                        <fieldset>
                        
                        
                            <legend>Etat Civil</legend> <!-- Etat Civil -->
                        
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Matricule :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->reg_number }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Registration number -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Nom :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->lastname }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Last name -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px" >Prénoms :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->firstname }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End First name -->
                        
                            <div class="form-group" >
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Date naiss. :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->birth_date }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End birth date -->
                        
                            <div class="form-group" >
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Lieu :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->birth_place }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Birth Place -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Sexe :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ ucfirst( $student->sex ) }} </p>
                            
                                </div>
                        
                        
                        
                            </div> <!-- End Sex -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Nationalités :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->nationalities }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Nationalité -->
                    
                    
                        </fieldset> <!-- End FieldSet Etat civil -->
                    
                        <fieldset>
                        
                        
                            <legend>Reponsables légaux</legend>
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Père :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->father_name }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Father name -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Prof. Père :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->father_job }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Father job -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Tél. Père :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->father_phones }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Father phones -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Mère :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->father_name }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Mother name -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Prof. Mère :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->motherr_job}} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Mother Job -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Tél. Mère :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->mother_phones }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End mother phone -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Tuteur :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->guardian_name }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Guardian name -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Tél. Tuteur :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->guardian_phones }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Guardian phone -->
                    
                    
                        </fieldset> <!-- End FieldSet Responsable légaux -->
                    
                        <fieldset>
                        
                            <legend>
                            
                                Localisation
                        
                            </legend>
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Lieu :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->living_place }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Living Place -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Adresse :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->address }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Adress -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Emails :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->emails }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End emails -->
                    
                    
                        </fieldset> <!-- End Localisation -->
                
                    </div>
                
                
                    <div class="col-xs-6">
                    
                    
                        <fieldset>
                        
                        
                            <legend>
                            
                                Scolarité
                        
                            </legend>
                        
                            <div class="form-group
                                        {{ $errors->has('subscription_date') ? 'has-error' : '' }}">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Date Inscrip. :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->subscription_date }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End subcription date -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Ecole origine :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->origin_school }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End origin school -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">Resp. Scol. :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->resp_schooling }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End resp o schoolarship -->
                    
                    
                        </fieldset> <!-- End schoolarship -->
                    
                        <fieldset>
                        
                        
                            <legend>
                            
                                Options d'inscription et CNED
                        
                            </legend>
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">LV2 :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->second_living_language }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End LV2 -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">ID CNED :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->cned_id }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Last name -->
                        
                            <div class="form-group">
                            
                            
                                <label class="col-xs-4 control-label" style="padding-top: 7.2px">MP CNED :</label>
                            
                                <div class="col-xs-8">
                                
                                    <p class="form-control-static"> {{ $student->cned_password }} </p>
                            
                                </div>
                        
                        
                            </div> <!-- End Last name -->
                    
                        </fieldset> <!-- End subcriptio feature -->
                    
                        <fieldset>
                        
                        
                            <legend>
                            
                                Elements du dossier
                        
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
    
                        @section('emergency-contact')
        
        
                            <fieldset>
            
            
                                <legend>
                
                                    Contacts en cas d'urgences
            
                                </legend>
            
                                @include('student.emergency-contact')
        
        
                            </fieldset>
    
    
                        @show
                
                
                    </div>
            
            
            
                </div>
                
        
            </form>
    
    
        </div>
        
        
    </div>
    



@endsection