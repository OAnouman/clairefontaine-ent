@extends('layouts.parent.parent_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}"> <span class="glyphicon glyphicon-dashboard"></span> Tableau de bord</a>
    
    </li>


@endsection


@section('work-section')


    <div class="row heading">
    
        <div class="col-md-8">
    
            <h3>
        
                Tableau de bord <br> <small>Vue d'ensemble des vos performances</small>
    
            </h3>
            
        </div>
        
        <div class="col-md-4 pull-right">

            <h3 class="text-right"> {{ $student->classrooms()->count() ?
            $student->classrooms()->latest()->first()->name : 'Pas de classe'}} </h3>
            
        </div>
        
        
    </div>
    
    <div class="content">
    
        
        <div class="row">


            <div class="col-md-6">

                @if($student->classrooms()->count())
                    <evaluations :student='{!! $student->toJson() !!}' limit="8"></evaluations>
                @else
                    <p>Aucune donnée disponible</p>
                @endif


            </div>

            <div class="col-md-6">

                @if($student->classrooms()->count())
                    <overview student="{{ $student->id }}"
                              classroom="{{ $student->classrooms()->latest()->first()->id }}">
                    </overview>
                @else
                    <p>Aucune donnée disponible</p>
                @endif
    
    
            </div>
        
        
        </div>
        
        <div class="row">


            <div class="col-md-6">

                @if($student->classrooms()->count())
                    <grade-chart :classroom='{!!
                 $student->classrooms()->latest()->first()->toJson()  !!}'>
                    </grade-chart>
                @else
                    <p>Aucune donnée disponible</p>
                @endif


            </div>

            <div class="col-md-6">

                @if($student->classrooms()->count())
                    <profile-overview :student='{!! $student->toJson() !!}'
                                      :classroom='{!! $student->classrooms()->latest()->first()->toJson()  !!}'
                    ></profile-overview>
                @else
                    <p>Aucune donnée disponible</p>
                @endif

            </div>
            
            
        </div>
        
        
       
    
    </div>
    
    


@endsection