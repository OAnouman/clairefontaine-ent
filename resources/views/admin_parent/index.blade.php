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
    
            <h3 class="text-right"> {{ $student->classrooms()->latest()->first()->name }} </h3>
            
        </div>
        
        
    </div>
    
    <div class="content">
    
        
        <div class="row">


            <div class="col-md-6">


                <evaluations :student='{!! $student->toJson() !!}' limit="8"></evaluations>


            </div>

            <div class="col-md-6">
        
                <overview student="{{ $student->id }}"
                          classroom="{{ $student->classrooms()->latest()->first()->id }}"></overview>
    
    
            </div>
        
        
        </div>
        
        <div class="row">


            <div class="col-md-6">


                <grade-chart :classroom='{!!   $student->classrooms()->latest()->first()->toJson() !!}'></grade-chart>


            </div>

            <div class="col-md-6">
        
        
                <profile-overview :student='{!! $student->toJson() !!}'
                    :classroom='{!!  $student->classrooms()->latest()->first()->toJson() !!}'></profile-overview>
    
    
            </div>
            
            
        </div>
        
        
       
    
    </div>
    
    


@endsection