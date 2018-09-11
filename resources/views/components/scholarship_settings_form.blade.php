<form method="POST" action="{{ route($action, $data) }}" data-toggle="validator"
      class="form-inline">

    {{ csrf_field() }}

    {{-- If a model is given for update we add PATCH method to the form--}}

    @if($scolarship)

        <input name="_method" type="hidden" value="PATCH">

    @endif

    <div class="col-md-3 form-group">

        <label for="level_id">

            Niveau

        </label>

        <select id="level_id" class="form-control selectpicker show-tick"
                name="level_id" title="Selectionner un niveau">

            @foreach($levels as $level)

                <option {{ $scholarship->$level->id = $level->id ? 'selected' : '' }}
                        value="{{ $level->id }}">{{ $level->name }}</option>

            @endforeach


        </select>

    </div>


</form>