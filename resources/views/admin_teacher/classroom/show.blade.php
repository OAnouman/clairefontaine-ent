@extends('layouts.teacher.teacher_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
        
        <a href="{{ route('home') }}">Mes Classes</a>
    
    </li>
    
    <li>
        
        <a href="{{ route('home') }}"> {{ $classroom->name }}</a>
    
    </li>


@endsection


@section('work-section')
    
    
    <div class="col-md-12 classroom-header">
    
    
        <!--
       
           Overview panels :
           
           1st : Planning Panel
           
           2nd : Evaluation Planning Panel
           
           3rd : Stats Panel
       
       -->
    
        <div >
        
            <panel-default>
            
            
                <!-- Panel header -->
            
            
                <template slot = "header">
                
                    <span class="glyphicon glyphicon-time"></span> &nbsp; Horaires
            
                </template>
        
        
                Aucun horaire disponible
        
        
            </panel-default>
    
        </div>
    
        <div>
        
            <panel-default>
            
            
                <!-- Panel header -->
            
            
                <template slot = "header">
                
                    <span class="glyphicon glyphicon-star-empty"></span> &nbsp;
                    
                    Evaluations récentes &nbsp;
                    
                    <span class="label label-success pull-right"> {{ $classroom->evaluations()->count() }}</span>
            
                </template>
        
        
                <!-- Panel body -->
                
                <ul class="list-unstyled">
                    
                    
                    @foreach($classroom->evaluations()->latest()->take(3)->get() as $evaluation)
                    
                    
                        <li>
                            
                            
                            <a href="#" data-toggle="popover"
                               title="<strong>Evaluation du {{ $evaluation->evaluation_date }}</strong>"
                               data-content="
                                      <strong>Commentaires</strong> : {{ $evaluation->comment }} <br>
                                      <a href={{ route('evaluation.show', $evaluation->id) }}>Plus...</a>
                                    " data-html="true"
                               data-trigger="focus" class="text-primary">
                                
                                <span class="glyphicon glyphicon-hand-right"></span> &nbsp;
                                
                                {{ $evaluation->evaluation_date }} - {{ $evaluation->subject->name }}
                                
                            </a>
                        
                        
                        </li>
                    
                    
                    @endforeach
                    
                    <li> <a href="{{ route('evaluation.index') }}">Voir plus...</a> </li>
                    
                    
                </ul>
        
        
            </panel-default>
    
        </div>
    
        <div>
        
            <panel-default>
            
            
                <!-- Panel header -->
            
            
                <template slot = "header">
                
                    <span class="glyphicon glyphicon-stats"></span> &nbsp; Statistiques
            
                </template>
        
               @if ( Auth()->user()->userable->subjects( $classroom->id)->count() <= 1 )
        
                   
                    @php
            
                        if ($classroom->evaluations->count() > 0)
                        {
                        
                            $subject_id = Auth()->user()->userable->subjects($classroom->id)->first()->pivot->subject_id;
            
                            $bestStudent = App\Subject::find($subject_id)->bestStudent($classroom->id);
                        
                            $worstStudent = App\Subject::find($subject_id)->worstStudent($classroom->id);
                        
                        }
                       
        
                    @endphp
                
                    @if ($classroom->evaluations->count() > 0)
            
            
                        <p>
                
                            <span class="glyphicon glyphicon-thumbs-up text-success"></span>
                
                            {{ key($bestStudent) . ' - Note moy. : ' .$bestStudent[key($bestStudent)] }}
            
                        </p>
            
                        <p>
                
                            <span class="glyphicon glyphicon-thumbs-down text-danger"></span>
                
                            {{ key($worstStudent) . ' - Note moy. : ' . $worstStudent[key($worstStudent)] }}
            
                        </p>
                        
                    @else
                        
                        
                        <p>Aucune statistique disponibles ! </p>
                        
                    @endif
                   
                
                
                
                @else
                
                
                
                
               @endif
                
               
        
        
            </panel-default>
    
        </div>
        
        
    </div>

    <div class="col-md-12">
    
    
        <panel-default>
        
        
            <!-- Panel header -->
            
            <template slot = "header">
            
                <span class="glyphicon glyphicon-folder-open"></span> &nbsp; {{ $classroom->name }}
                
                <span class="pull-right label label-success"> {{ $classroom->students()->count() }}</span>
        
            </template>
        
        
            <!-- Panel content -->
        
        
            <!-- Students list -->
        
            <table class="table table-responsive table-hover">
            
            
                <thead>
            
            
                <tr>
                
                
                    <th class="col-md-1">
                    
                        <strong>
                        
                            #
                    
                        </strong>
                
                    </th>
                
                    <th class="col-md-1">
                    
                        <strong>
                        
                            Matricule
                    
                        </strong>
                
                    </th>
                
                    <th class="col-md-5">
                    
                        <strong>
                        
                            Nom Prènoms
                    
                        </strong>
                
                    </th>
                
                    <th class="col-md-2">
                    
                        <strong>
                        
                            Date de Naissance
                    
                        </strong>
                
                    </th>
                
                    <th class="col-md-1">
                    
                        <strong>
                        
                            N° Père
                    
                        </strong>
                
                    </th>
                
                    <th class="col-md-1">
                    
                        <strong>
                        
                            N° Mère
                    
                        </strong>
                
                    </th>
                
                    <th>
                
                    </th>
                    
                </tr>
            
            
                </thead>
            
                <tbody>
            
            
                @foreach($students as $student)
                
                
                    <tr>
                    
                    
                        <td>
                        
                            {{ $loop->iteration }}
                    
                        </td>
                    
                        <td>
                        
                            {{ $student->reg_number }}
                    
                        </td>
                    
                        <td>
                        
                            {{ $student->lastname . ' ' . $student->firstname }}
                    
                        </td>
                    
                        <td>
                        
                            {{ $student->birth_date }}
                    
                        </td>
                    
                        <td>
                        
                            {{ $student->getFirstFatherNumber()}}
                    
                        </td>
                    
                        <td>
                        
                            {{ $student->getFirstMotherNumber() }}
                    
                        </td>
                    
                        <td>
                        
                            <a href="{{ route('message_center.show', $student->id) }}" title="Envoyer un message à l'élève"
                               data-toggle="tooltip"  data-placement="top"
                               @click.prevent="sendMessageToStudent($event)">
                            
                                <span class="glyphicon glyphicon-comment text-primary"></span>
    
                                <form action="{{ route('message_center.store') }}"
                                      method="POST">
        
        
                                    {{ csrf_field() }}
        
                                    <input name="recipient_id" type="hidden" value="{{ $student->user->id }}">
    
    
                                </form>
                        
                            </a>
                    
                        </td>
                        
                
                    </tr>
            
            
                @endforeach
            
            
                </tbody>
                
        
            </table>
    
            
        </panel-default>


    </div>


@endsection