@extends('layouts.master-print')


@section('content')
    
    <style>
    
    
        body{
    
    
            background-color: #fff;
    
            color: #000;
            
            font-size: 1.2em;
            
        }
        
        table.table-bordered{
            
        
            border:1px solid #000;
            
            margin-top:20px;
            
            color: #000;
    
            font-size: 1.2em;
            
        
        }
        
        table.table-bordered > thead > tr > th{
        
        
            border:1px solid #000;
    
            color: #000;
    
            font-size: 1.2em;
        
        
        }
        
        table.table-bordered > tbody > tr > td{
        
        
            border:1px solid #000;
    
            color: #000;
    
            font-size: 1.2em;
        
        
        }
        
        p {
    
            font-size: 1.3em;
            
        }
        
        
        
    
    </style>
    
    
    <div class="row col-xs-12" >
        
        
        <div class="ool-xs-12">
        
        
            <div class="col-xs-12 pull-right">
                
                <div class="col-xs-6">
                    
                    
                    <p>Responsable : {{ $classroom->teacher->firstname . ' ' . $classroom->teacher->lastname }}</p>
                    
                    
                </div>
                
                <div class="pull-right">
                
                   <p>
                       
                       {{ $classroom->level->academic_grade . ' - ' . $classroom->name .
                 ' - ' . $classroom->schoolYear->name}}
                   
                   </p>
    
                 
                </div>
                
                
                
            </div>
    
           
            
            
        </div>
    
        <div class="col-xs-12">
    
    
            <table class="table table-bordered">
        
        
                <thead>
        
        
                <tr>
            
            
                    <th>
                
                        <strong>
                    
                            #
                
                        </strong>
            
                    </th>
            
                    <th class="col-xs-6" >
                
                        <strong CLASS="text-uppercase">
                    
                            Nom & Prénoms
                
                        </strong>
            
                    </th>
            
                    <th class="col-xs-1">
                
                        <strong class="text-uppercase">
                    
                            Sexe
                
                        </strong>
            
                    </th>
            
                    <th class="col-xs-2">
                
                        <strong class="text-uppercase">
                    
                            Date de naissance
                
                        </strong>
            
                    </th>
            
                    <th class="col-xs-3" >
                
                        <strong class="text-uppercase">
                    
                            Nationalités
                
                        </strong>
            
                    </th>
        
        
                </tr>
        
        
                </thead>
        
                <tbody>
        
        
                @foreach($classroom->students as $student)
            
            
                    <tr >
                
                
                        <td >
                    
                            {{ $loop->iteration }}
                
                        </td>
                
                        <td >
                    
                            {{ $student->lastname . ' ' . $student->firstname }}
                
                        </td>
                
                        <td>
                    
                            {{ ucfirst($student->sex) }}
                
                        </td>
                
                        <td >
                    
                            {{ $student->birth_date }}
                
                        </td>
                
                        <td >
                    
                            {{ $student->nationalities }}
                
                        </td>
            
            
                    </tr>
        
        
                @endforeach
        
        
                </tbody>
    
    
    
            </table>
            
            
        </div>
        
        
    </div>
    
    
    
@endsection