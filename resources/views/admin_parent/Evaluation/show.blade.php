@extends('layouts.parent.parent_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}"> <span class="glyphicon glyphicon-dashboard"></span> Tableau de bord </a>
        
    </li>
    
    <li> <span class="glyphicon glyphicon-star-empty"></span> Evaluations </li>

    <li>
        
            <span class="glyphicon glyphicon-calendar"></span> {{ $schoolYearPeriod->name }}

    </li>

@endsection


@section('work-section')
    
    
    <div class="row heading">
        
        <div class="col-md-8">
            
            <h3>
                
                Evaluations <br> <small>Récapitulatif de vos notes du {{ $schoolYearPeriod->name }}</small>
            
            </h3>
        
        </div>
        
        <div class="col-md-4 pull-right">
            
            <h3 class="text-right"> {{ $student->classrooms()->latest()->first()->name }} </h3>
        
        </div>
    
    
    </div>
    
    <div class="row content">
        
        
        <!--
        
            Display table if grades count > 0,
            
            Otherwise we just display empty
            
            grades message
        
        -->
        
        
        @if( $grades->count() > 0)
            
        
            {{--<h4 class="sub-heading">Note du </h4>--}}
        
            <!-- Filter form -->
        
            <div>
    
                <form action="{{ route('parent.evaluation',
                    [$schoolYearPeriod->school_year_id,$student->classrooms()->latest()->first()->id]) }}"
                      method="GET">
        
                    <div id = "" class = "form-group col-xs-4">
            
                        <label for="subject_id">Filtrer par  </label>
                        
                        
                        <select required id = "subject_id" title = "Matière..."
                                data-width="fit" class = "form-control selectpicker show-tick subject-select"
                                name = "subject_id" @change="filterGradeBySubject($event)">
                            
                
                            @foreach($subjects as $subject)
        
                                
        
                                <option {{ request()->subject_id == $subject->id ? 'selected' : '' }}
                                        value =" {{ $subject->id }}"> {{ $subject->name }}</option>
                                
                                
                            @endforeach
            
            
                        </select>
        
        
                    </div>
    
                </form>
                
            </div>
        
            <!-- Grades list -->
        
            <table class="table table-hover table-responsive">
            
                <thead class="text-uppercase">
            
            
                <tr>
                
                
                    <th> # </th>
                
                    <th class="col-md-2">
                    
                        Date
                
                    </th>
                
                    <th class="col-md-3">
                    
                        Matière
                
                    </th>
                
                    <th class="col-md-1">
                    
                        Note
                
                    </th>
                
                    <th class="col-md-5">
                    
                        Commentaires
                
                    </th>
            
                </tr>
            
            
                </thead>
            
                <tbody>
            
            
                @foreach( $grades as $grade)
                
                
                    <tr>
                    
                    
                        <td> {{ $loop->iteration }} </td>
                    
                        <td> {{ \Carbon\Carbon::createFromFormat('Y-m-d',$grade->evaluation_date)->format('d-m-y') }}</td>
                    
                        <td> {{ $grade->subject }}</td>
                    
                        @if( $grade->value >= 0 && $grade->value <= 7)
                        
                        
                            <td>
                            
                                
                                <span class="label label-danger grade-label">
                                    
                                    {{ $grade->value }}
                                
                                </span>
                        
                        
                            </td>
                    
                    
                        @elseif ( $grade->value >= 8 && $grade->value <= 9 )
                        
                            <td>
                            
                                
                                <span class="label label-warning grade-label">
                                    
                                    {{ $grade->value }}
                                
                                </span>
                        
                        
                            </td>
                    
                        @elseif ( $grade->value >= 10 && $grade->value <= 12)
                        
                        
                            <td>
                            
                                
                                <span class="label label-info grade-label">
                                    
                                    {{ $grade->value }}
                                
                                </span>
                        
                        
                            </td>
                    
                    
                        @elseif ( $grade->value >= 13 && $grade->value <= 15 )
                        
                        
                            <td>
                            
                                
                                <span class="label label-primary grade-label">
                                    
                                    {{ $grade->value }}
                                
                                </span>
                        
                        
                            </td>
                    
                    
                        @else
                        
                        
                            <td>
                            
                                
                                <span class="label label-success grade-label">
                                    
                                    {{ $grade->value }}
                                
                                </span>
                        
                        
                            </td>
                    
                    
                        @endif
                    
                        <td> {{ $grade->comments }}</td>
                
                
                    </tr>
            
            
                @endforeach
                
            
                </tbody>
        
        
            </table>
            
            {{ $grades->links() }}
            
            
        @else
    
            <h3 class="text-info placeholder text-center">
                
                <i class="fa fa-ban" aria-hidden="true"></i>
                
                Vous n'avez aucune note pour cette période !
            
            </h3>
            
        @endif
    
    
    </div>


@endsection