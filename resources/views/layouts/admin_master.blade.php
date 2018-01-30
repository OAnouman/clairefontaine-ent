@extends('layouts.master')


@section('styles')
    
    
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    
    
@endsection


@section('content')


    <div class="container">

        <!-- Admin Header -->


        <div class="row header-breadcrumb">


            <breadcrumb>



                @yield('breadcrumb')



            </breadcrumb>



        </div>


        <!-- Admin left menu -->

        <div class="row content">


            @include('admin.side_navbar')
    
    
            <!-- Work section -->

            <div class="col-md-9  work-section">

                
                @yield('work-section')


            </div>


        </div>


    </div>

    
@endsection