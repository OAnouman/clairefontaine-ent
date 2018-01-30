@extends('layouts.admin_master')



@section('breadcrumb')


    <li>

        <a href="{{ route('home') }}">Accueil</a>

    </li>

    <li>

        Paramètres

    </li>

    <li>

        Découpage annuel

    </li>

    <li>

        {{ $schoolYearPeriod->name . ' - ' . $schoolYearPeriod->schoolYear->name }}

    </li>



@endsection


@section('work-section')


    <panel-default>


        <!-- Panel header -->


        <template slot="header">

            {{ $schoolYearPeriod->name . ' - ' . $schoolYearPeriod->schoolYear->name }}

        </template>



        <!-- Panel content -->


        <div class="col-md-6">


            <form class="" method="POST" action="{{ route('school_year_period.update', $schoolYearPeriod->id) }}">


                {{ csrf_field() }}
    
                <input name="_method" type="hidden" value="PATCH">
                
                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">


                    <label for="name" >Libellé</label>

                    <input required type="text" value="{{ $schoolYearPeriod->name }}" class="form-control"
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


                    <label for="school_year_id" >Année scolaire</label>

                    <select required id = "school_year_id" class="form-control selectpicker show-tick"
                            name="school_year_id" data-header="Sélectionner l'année scolaire">
                        

                        @foreach($schoolYears as $schoolYear )


                            <option value="{{ $schoolYear->id }}"
                                    {{ $schoolYearPeriod->schoolYear->name === $schoolYear->name ? 'selected' : ''}}>


                                {{ $schoolYear->name }}


                            </option>


                        @endforeach


                    </select>

                    @if ($errors->has('school_year_id'))


                        <span class="help-block">


                        <strong>{{ $errors->first('school_year_id') }}</strong>


                    </span>


                    @endif


                </div>

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">


                    <label for="index" >Index</label>

                    <input required type="text" value="{{ $schoolYearPeriod->index }}" class="form-control"
                           name="index" id="index" placeholder="Index">
    
                    <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
    
                    <span id="index" class="sr-only">(required)</span>

                    @if ($errors->has('index'))


                        <span class="help-block">


                        <strong>{{ $errors->first('index') }}</strong>


                    </span>


                    @endif


                </div>

                <button type="button" @click="back" class="btn btn-default">


                    <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour


                </button>

                <button type="submit" class="btn btn-primary">


                    Modofier


                </button>


            </form>


        </div>



    </panel-default>


@endsection