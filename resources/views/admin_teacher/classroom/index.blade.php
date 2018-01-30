@extends('layouts.teacher.teacher_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>
    
    <li>
    
        <a href="{{ route('home') }}">Mes Classes</a>
    
    </li>


@endsection


@section('work-section')
    
    
    <panel-default>
        
        
        <!-- Panel header -->
        
        
        <template slot = "header">
            
            <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Mes Classes
    
            <span class="pull-right label label-success"> {{ count($classrooms) }}</span>
        
        </template>
        
        
        <!-- Panel content -->
        
        <!-- Classes list -->
        
        <table class="table table-responsive table-hover">
            
            
            <thead>
            
                
                <tr>
                    
                    
                    <th class="col-md-1">
                    
                        <strong>
                            
                            #
                            
                        </strong>
                    
                    </th>
    
                    <th class="col-md-2">
        
                        <strong>
            
                            Libellé
        
                        </strong>
    
                    </th>
    
                    <th class="col-md-4">
        
                        <strong>
            
                            Professeur Principal
        
                        </strong>
    
                    </th>
                    
                    <th class="col-md-3">
        
                        <strong>
            
                            Matière
        
                        </strong>
    
                    </th>
    
                    <th class="col-md-1">
        
                        <strong>
            
                            Effectif
        
                        </strong>
    
                    </th>
    
                    <th class="col-md-1">
                    
                    </th>
                    
                </tr>
            
            
            </thead>
            
            <tbody>
            
            
                @foreach($classrooms as $classroom)
                
                
                    <tr>
                    
                        
                        <td>
                            
                            {{ $loop->iteration }}
                            
                        </td>
                        
                        <td>
                            
                            {{ $classroom->name }}
                            
                        </td>
                        
                        <td>
                        
                            {{ $classroom->teacher->firstname . ' ' . $classroom->teacher->lastname }}
                        
                        </td>
    
                        <td>
        
                            {{ App\Subject::find($classroom->pivot->subject_id)->name }}
    
                        </td>
                        
                        <td>
                            
                            {{ $classroom->students()->count() }}
                            
                        </td>
    
                        <td>
        
                            <a href="{{ route('teacher_classroom.show', $classroom->id) }}" title="Voir la liste"
                               data-toggle="tooltip"  data-placement="top">
                                
                                <span class="glyphicon glyphicon-eye-open text-primary"></span>
                                
                            </a>
    
                        </td>
                        
                        
                        
                    </tr>
                    
                
                @endforeach
            
            
            </tbody>
            
        </table>
    
    
    
    
    
    </panel-default>


@endsection