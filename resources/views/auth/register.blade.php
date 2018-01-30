@extends('layouts.master')

@section('content')

    <div class="container">


        <div class="row">


            <div class="col-md-8 col-md-offset-2">


                <div class="panel panel-default">


                    <div class="panel-heading">Creer un nouvel utiliateur</div>

                    <div class="panel-body">


                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">


                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">


                                <label for="lastname" class="col-md-4 control-label">Nom</label>

                                <div class="col-md-6">


                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                    @if ($errors->has('name'))


                                        <span class="help-block">


                                            <strong>{{ $errors->first('lastname') }}</strong>


                                        </span>


                                    @endif


                                </div>


                            </div>

                            <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">


                                <label for="firstname" class="col-md-4 control-label">Prènoms</label>

                                <div class="col-md-6">


                                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                    @if ($errors->has('firstname'))


                                        <span class="help-block">


                                            <strong>{{ $errors->first('firstname') }}</strong>


                                        </span>


                                    @endif


                                </div>


                            </div>


                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">


                                <label for="email" class="col-md-4 control-label">Adresse mail</label>

                                <div class="col-md-6">


                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))


                                        <span class="help-block">


                                            <strong>{{ $errors->first('email') }}</strong>


                                        </span>


                                    @endif


                                </div>


                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">


                                <label for="password" class="col-md-4 control-label">Mot de passe</label>

                                <div class="col-md-6">


                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))


                                        <span class="help-block">


                                            <strong>{{ $errors->first('password') }}</strong>


                                        </span>


                                    @endif


                                </div>


                            </div>

                            <div class="form-group">


                                <label for="password-confirm" class="col-md-4 control-label">Confirmer le mot de passe</label>

                                <div class="col-md-6">


                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>


                                </div>


                            </div>

                            <div class="form-group">


                                <label for="account_type" class="col-md-4 control-label">Type de compte</label>

                                <div class="col-md-6">


                                    <select id = "account_type" class="form-control selectpicker show-tick"
                                            name="account_type" data-header="Selectionner un profil">

                                        <option value="administrateur">Administrateur</option>

                                        <option value="personel">Personnel</option>

                                        <option value="professeur">Professeur</option>

                                        <option value="eleve_parent">Elève/Parent</option>

                                    </select>

                                    @if ($errors->has('account_type'))


                                        <span class="help-block">


                                            <strong>{{ $errors->first('account_type') }}</strong>


                                        </span>


                                    @endif

                                </div>


                            </div>

                            <div class="form-group">


                                <div class="col-md-6 col-md-offset-4">


                                    <button type="submit" class="btn btn-primary">


                                        Créer


                                    </button>


                                </div>


                            </div>


                        </form>


                    </div>


                </div>


            </div>


        </div>


    </div>


@endsection
