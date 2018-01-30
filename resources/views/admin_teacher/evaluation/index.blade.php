@extends('layouts.teacher.teacher_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href = "{{ route('home') }}">Accueil</a>
    
     </li>
    
    <li>
        
        <a href = "{{ route('evaluation.index') }}">Evaluations</a>
    
    </li>


@endsection


@section('work-section')
    
    
    <div>
        
        
        <panel-default id = "toggle">
            
            
            <!-- Panel header -->
            
            <template slot = "header">
                
                <span class = "glyphicon glyphicon-plus"></span> &nbsp; Nouvelle Evaluation
                
                <span style = "cursor: pointer" @click = "hideShowNew"
                      class = "pull-right glyphicon glyphicon-eye-close toggle-button"></span>
            
            </template>
            
            
            <!-- Panel content -->
            
            <form id="evaluationForm">
                
                
                {{ csrf_field() }}
                
                <div id = "evaluation_date" class = "form-group col-md-2
                        {{ $errors->has('evaluation_date') ? 'has-error' : '' }}">
                    
                    
                    <label for = "evaluation_date">
                        
                        Date
                        
                        <span class="text-danger">*</span>
                    
                    </label>
                    
                    <div class = "input-group date" data-provider = "datepicker">
                        
                        
                        <input required class = "form-control" type = "text" name = "evaluation_date"
                               value = "" id = "evaluation_date" >
                        
                        <div class = "input-group-addon">
                            
                            
                            <span class = "glyphicon glyphicon-th"></span>
                        
                        
                        </div>
                    
                    
                    </div>
                    
                
                </div> <!-- End evaluation date -->
                
                <div id = "classroom_id" class = "form-group col-md-2
                        {{ $errors->has('classroom_id') ? 'has-error' : '' }}">
                    
                    
                    <label for = "classroom_id">
                        
                        Classe
    
                        <span class="text-danger">*</span>
                        
                    </label>
                    
                    <select required id = "classroom_id" title = "Classe..."
                            class = "form-control selectpicker show-tick" name = "classroom_id">
                        
                        
                        @foreach($classrooms->unique() as $classroom)
                            
                            
                            <option value = "{{ $classroom->id }}">{{ $classroom->name }}</option>
                        
                        
                        @endforeach
                    
                    
                    </select>
                    
                    
                </div> <!-- End classroom -->
                
                <div  id = "subject_id" class = "form-group col-md-3
                    {{ $errors->has('subject_id') ? 'has-error' : '' }}">
                    
                    
                    <label for = "classroom_id">
                        
                        Matière
    
                        <span class="text-danger">*</span>
                        
                    </label>
                    
                    <select required id = "subject_id" class = "form-control selectpicker show-tick"
                            name = "subject_id" title="Matière">
                        
                        
                        @foreach($subjects as $subject)
                            
                            
                            <option value = "{{ $subject->id }}"> {{ $subject->name }} </option>
                        
                        
                        @endforeach
                    
                    
                    </select>
                    
                </div> <!-- End Subject -->
                
                <div id="coefficient" class = "form-group col-md-1
                        {{ $errors->has('coefficient') ? 'has-error' : '' }}">
                    
                    
                    <label for = "coefficient">Coeff.</label>
                    
                    <input type = "number" class = "form-control" placeholder="1"
                           name = "coefficient" id = "coefficient" min="0">
                           
                
                </div> <!-- End coefficient -->
                
                <div id="school_year_period_id" class = "form-group col-md-2
                        {{ $errors->has('school_year_period_id') ? 'has-error' : '' }}">
                    
                    
                    <label for = "school_year_period_id">
                        
                        Période
    
                        <span class="text-danger">*</span>
                        
                    </label>
                    
                    <select required id = "school_year_period_id" title = "Période..."
                            class = "form-control selectpicker show-tick" name = "school_year_period_id">
                        
                        
                        @foreach($schoolYearPeriods as $schoolYearPeriod )
                            
                            
                            <option value = "{{ $schoolYearPeriod->id }}">{{ $schoolYearPeriod->name }}</option>
                        
                        
                        @endforeach
                    
                    
                    </select>
                    
                
                </div> <!-- End school year period -->
                
                <div class = "form-group col-md-2
                        {{ $errors->has('comment') ? 'has-error' : '' }}">
                    
                    
                    <label for = "comment">Commentaires</label>
                    
                    <input type = "text" class = "form-control"
                           name = "comment" id = "comment">
                    
                
                </div> <!-- End comment -->
                
                <div class = "col-md-2">
                    
                    
                    <button @click="submitEvaluationForm" class = "btn btn-primary" type = "button">
                        
                        Ajouter
                    
                    </button>
                
                
                </div>
            
            
            </form>
        
        
        </panel-default>
    
    
    </div>
    
    <div>
        
            
        <panel-default>
            
            
            <!-- Panel header -->
            
            
            <template slot = "header">
                
                <span class = "glyphicon glyphicon-star-empty"></span> &nbsp; Evaluation
                
                <span class = "pull-right label label-success"> {{ App\Evaluation::all()->count() }}</span>
            
            </template>
            
            
            <!-- Panel content -->
            
            <!-- Classes list -->
            
           <div id="list">
               
               
               @section('list')
            
                    <table class = "table table-responsive table-hover">
                
                
                        <thead>
                        
                        
                            <tr>
                                
                                
                                <th>
                                    
                                    <strong>
                                        
                                        #
                                    
                                    </strong>
                                
                                </th>
                                
                                <th class = "col-md-2">
                                    
                                    <strong>
                                        
                                        Date
                                    
                                    </strong>
                                
                                </th>
                                
                                <th class = "col-md-2">
                                    
                                    <strong>
                                        
                                        Classe
                                    
                                    </strong>
                                
                                </th>
                                
                                <th class = "col-md-3">
                                    
                                    <strong>
                                        
                                        Matière
                                    
                                    </strong>
                                
                                </th>
                                
                                <th class = "col-md-1">
                                    
                                    <strong>
                                        
                                        Coefficient
                                    
                                    </strong>
                                
                                </th>
    
                                <th class="col-md-2">
        
                                    <strong>
            
                                        Période
        
                                    </strong>
    
                                </th>
                                
                                <th class = "col-md-2">
                                    
                                    <strong>
                                        
                                        Commentaires
                                    
                                    </strong>
                                
                                </th>
                                
                                <th>
                                
                                </th>
                               
                                <th>
    
                                </th>
                                
                                <th>
        
                                </th>
                                
                            </tr>
                        
                        
                        </thead>
                        
                        <tbody>
                        
                        
                            @foreach($evaluations as $evaluation)
                                
                                
                                <tr>
                                    
                                    
                                    <td>
                                        
                                        {{ $evaluation->id }}
                                    
                                    </td>
                                    
                                    <td>
                                        
                                        {{ $evaluation->evaluation_date }}
                                    
                                    </td>
                                    
                                    <td>
                                        
                                        {{ $evaluation->classroom->name }}
                                    
                                    </td>
                                    
                                    <td>
                                        
                                        {{ $evaluation->subject->name }}
                                    
                                    </td>
    
                                    <td>
        
                                        {{ $evaluation->coefficient }}
    
                                    </td>
    
                                    <td>
        
                                        {{ $evaluation->schoolYearPeriod->name }}
    
                                    </td>
                                    
                                    <td>
                                        
                                        {{ $evaluation->comment }}
                                    
                                    </td>
                                    
                                    <td>
                                        
                                        
                                        <a href = "#"
                                           data-toggle="modal" type="button"
                                           data-target="#evaluationEditForm{{$evaluation->id}}">
                                            
                                            <span data-toggle = "tooltip" title = "Modifier"
                                                  data-placement = "top"
                                                  class = "glyphicon glyphicon-edit text-primary"></span>
                                        
                                        </a>
    
                                        <div class="modal fade" id="evaluationEditForm{{$evaluation->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="evaluationEditForm{{$evaluation->id}}">
        
        
                                            <div class="modal-dialog" role="document">
            
            
                                                <div class="modal-content">
                
                
                                                    <div class="modal-header">
                    
                    
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                                                        <h4 class="modal-title" id="modal{{$evaluation->id}}">Modifier l'évaluation de {{ $evaluation->subject->name }} du {{ $evaluation->evaluation_date   }}</h4>
                
                
                                                    </div>
                
                                                    <div class="modal-body">
                    
                    
                                                        <div class="row">
                        
                        
                                                            <form id="evaluationEditForm{{ $evaluation->id }}">
                                                                
                            
                                                                <div class="col-md-6">
                                
                                
                                                                    <div id = "evaluation_date" class = "form-group
                                                                        {{ $errors->has('evaluation_date') ? 'has-error' : '' }}">
                                    
                                    
                                                                        <label for = "evaluation_date">
                                        
                                                                            Date
                                        
                                                                            <span class="text-danger">*</span>
                                    
                                                                        </label>
                                    
                                                                        <div class = "input-group date" data-provider = "datepicker">
                                        
                                        
                                                                            <input required class = "form-control" type = "text" name = "evaluation_date"
                                                                                   value = "{{ $evaluation->evaluation_date }}" id = "evaluation_date" >
                                        
                                                                            <div class = "input-group-addon">
                                            
                                            
                                                                                <span class = "glyphicon glyphicon-th"></span>
                                        
                                        
                                                                            </div>
                                    
                                    
                                                                        </div>
                                
                                
                                                                    </div> <!-- End evaluation date -->
                                
                                                                    <div id = "classroom_id" class = "form-group
                                                                        {{ $errors->has('classroom_id') ? 'has-error' : '' }}">
                                    
                                    
                                                                        <label for = "classroom_id">
                                        
                                                                            Classe
                                        
                                                                            <span class="text-danger">*</span>
                                    
                                                                        </label>
                                    
                                                                        <select required id = "classroom_id" title = "Classe..."
                                                                                class = "form-control selectpicker show-tick" name = "classroom_id">
                                        
                                        
                                                                            @foreach($classrooms->unique() as $classroom)
                                            
                                            
                                                                                <option {{ $evaluation->classroom_id === $classroom->id ? 'selected' : '' }}
                                                                                        value = "{{ $classroom->id }}">{{ $classroom->name }}</option>
                                        
                                        
                                                                            @endforeach
                                    
                                    
                                                                        </select>
                                
                                
                                                                    </div> <!-- End classroom -->
                                
                                                                    <div  id = "subject_id" class = "form-group
                                                                        {{ $errors->has('subject_id') ? 'has-error' : '' }}">
                                    
                                    
                                                                        <label for = "classroom_id">
                                        
                                                                            Matière
                                        
                                                                            <span class="text-danger">*</span>
                                    
                                                                        </label>
                                    
                                                                        <select required id = "subject_id" class = "form-control selectpicker show-tick"
                                                                                name = "subject_id" title="Matière">
                                        
                                        
                                                                            @foreach($subjects as $subject)
                                            
                                            
                                                                                <option {{ $evaluation->subject_id === $subject->id ? 'selected' : '' }}
                                                                                        value = "{{ $subject->id }}"> {{ $subject->name }} </option>
                                        
                                        
                                                                            @endforeach
                                    
                                    
                                                                        </select>
                                
                                
                                                                    </div> <!-- End Subject -->
                            
                            
                                                                </div>
                            
                                                                <div class="col-md-6">
                                
                                
                                                                    <input id="id" name = "id"
                                                                           type="hidden" value="{{ $evaluation->id }}">
                                                                    
                                                                    <div id="coefficient" class = "form-group
                                                                        {{ $errors->has('coefficient') ? 'has-error' : '' }}">
                                    
                                    
                                                                        <label for = "coefficient">Coefficient</label>
                                    
                                                                        <input type = "number" class = "form-control" placeholder="1" min="0"
                                                                               name = "coefficient" id = "coefficient" value = "{{ $evaluation->coefficient }}">
                                
                                
                                                                    </div> <!-- End coefficient -->
                                
                                                                    <div id="school_year_period_id" class = "form-group
                                                                        {{ $errors->has('school_year_period_id') ? 'has-error' : '' }}">
                                    
                                    
                                                                        <label for = "school_year_period_id">
                                        
                                                                            Période
                                        
                                                                            <span class="text-danger">*</span>
                                    
                                                                        </label>
                                    
                                                                        <select required id = "school_year_period_id" title = "Période..."
                                                                                class = "form-control selectpicker show-tick" name = "school_year_period_id">
                                        
                                        
                                                                            @foreach($schoolYearPeriods as $schoolYearPeriod )
                                            
                                            
                                                                                <option {{ $evaluation->school_year_period_id === $schoolYearPeriod->id ? 'selected' : '' }}
                                                                                        value = "{{ $schoolYearPeriod->id }}">{{ $schoolYearPeriod->name }}</option>
                                        
                                        
                                                                            @endforeach
                                    
                                    
                                                                        </select>
                                
                                
                                                                    </div> <!-- End school year period -->
                                
                                                                    <div class = "form-group
                                                                        {{ $errors->has('comment') ? 'has-error' : '' }}">
                                    
                                    
                                                                        <label for = "comment">Commentaires</label>
                                    
                                                                        <input type = "text" class = "form-control"
                                                                               name = "comment" id = "comment" value = "{{ $evaluation->comment }}">
                                
                                
                                                                    </div> <!-- End comment -->
                            
                            
                                                                </div>
                        
                        
                                                            </form>
                    
                    
                                                        </div>
                
                
                                                    </div>
                
                                                    <div class="modal-footer">
                    
                    
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Annuler</button>
                    
                                                        <button @click="submitEvaluationEditForm"
                                                                type="button" class="btn btn-primary">Modifier</button>
                
                
                                                    </div>
            
            
                                                </div>
        
        
                                            </div>
    
    
                                        </div>
                                    
                                        
                                    </td>
    
                                    <td>
        
                                        <a href = "{{ route('evaluation.show', $evaluation->id) }}"
                                           title = "Saisir les notes"
                                           data-toggle = "tooltip" data-placement = "top">
            
                                            <span class = "glyphicon glyphicon-star text-warning"></span>
        
                                        </a>
    
                                    </td>
    
                                    <td>
        
                                        <a @click.prevent="deleteForm($event)"
                                           href = "#"
                                           title = "Supprimer l'évaluation"
                                           data-toggle = "tooltip" data-placement = "top">
            
                                            <span class = "glyphicon glyphicon-remove text-danger"></span>
    
                                            {{--Form for requesting school year deletion --}}
    
                                            <form action="{{ route('evaluation.destroy', $evaluation->id) }}"
                                                  method="POST">
        
        
                                                {{ csrf_field() }}
        
                                                <input name="_method" type="hidden" value="DELETE">
    
    
                                            </form>
        
                                        </a>
    
                                    </td>
                                
                                
                                </tr>
                            
                            
                            @endforeach
                            
                        
                        </tbody>
                    
                    
                    </table>

               @show
           
               
           </div>
        
        
        </panel-default>
            
            
    </div>
    
    {{ $evaluations->links() }}


    


@endsection