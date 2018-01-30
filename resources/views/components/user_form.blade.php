<form method="POST" action="{{ route($action, $data) }}">
    
    
    {{ csrf_field() }}
    
    @if ($user)
        
        <input name="_method" type="hidden" value="PATCH">
        
    @endif
    
    <div class="col-md-6">
    
    
        <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
        
        
            <label for="lastname" class="control-label">Nom</label>
        
        
            <input id="lastname" type="text" class="form-control"
                   name="lastname" value="{{ $user ? $user->lastname : old('lastname') }}" required autofocus>
        
            @if ($errors->has('name'))
            
            
                <span class="help-block">


                <strong>{{ $errors->first('lastname') }}</strong>


            </span>
        
        
            @endif
    
    
        </div>
    
        <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
        
        
            <label for="firstname" class="control-label">Prènoms</label>
        
        
            <input id="firstname" type="text" class="form-control" name="firstname"
                   value="{{ $user ? $user->firstname : old('firstname') }}" required autofocus>
        
            @if ($errors->has('firstname'))
            
            
                <span class="help-block">


                <strong>{{ $errors->first('firstname') }}</strong>


            </span>
        
        
            @endif
    
    
        </div>
    
    
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        
        
            <label for="email" class="control-label">Adresse mail</label>
        
        
            <input id="email" type="email" class="form-control" name="email"
                   value="{{ $user ? $user->email : old('email') }}" required>
        
            @if ($errors->has('email'))
            
            
                <span class="help-block">


                <strong>{{ $errors->first('email') }}</strong>


            </span>
        
        
            @endif
    
    
        </div>
        
        
    </div>
    
    
    <div class="col-md-6">
        
        
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            
            
            <label for="password" class="control-label">Mot de passe</label>
            
            
            <input id="password" type="password" class="form-control" name="password" {{ $user ? '' : 'required' }}>
            
            @if ($errors->has('password'))
                
                
                <span class="help-block">


                    <strong>{{ $errors->first('password') }}</strong>


                </span>
            
            
            @endif
        
        
        </div>
        
        <div class="form-group">
            
            
            <label for="password-confirm" class="control-label">Confirmer le mot de passe</label>
            
            
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" {{ $user ? '' : 'required' }}>
        
        
        </div>
        
        <div class="form-group">
            
            
            <label for="account_type" class="control-label">Type de compte</label>
            
            
            <select id = "account_type" class="form-control selectpicker show-tick"
                    name="account_type" title="Selectionner un profil">
                
                <option {{ $user ? ($user->account_type === 'administrateur' ? 'selected ' : '') : ''  }}
                        value="administrateur">Administrateur</option>
                
                <option {{ $user ? ($user->account_type === 'personnel' ? 'selected ' : '') : ''  }}
                        value="personnel">Personnel</option>
                
                <option {{ $user ? ($user->account_type === 'professeur' ? 'selected ' : '') : ''  }}
                        value="professeur">Professeur</option>
                
                <option {{ $user ? ($user->account_type === 'eleve_parent' ? 'selected ' : '') : ''  }}
                        value="eleve_parent">Elève/Parent</option>
            
            </select>
            
            @if ($errors->has('account_type'))
                
                
                <span class="help-block">


                    <strong>{{ $errors->first('account_type') }}</strong>


                </span>
            
            
            @endif
        
        
        </div>
    
    
    </div>
    
    
    <div class="col-md-7">
        
        
        {!! $button !!}
    
    
    </div>

</form>