@extends('layouts.master_navbar_free')


@section('styles')
    
    
    <link href="{{ asset('css/teacher.css') }}" rel="stylesheet">


@endsection


@section('content')
    
    
    
    
    <div class="container-fluid teacher">
        
        
        <div class="row equal">
    
    
            <!-- Left Menu -->
            
            <div class="col-md-2 sidebar-menu navbar-left ">
                
                
                <!-- Admin left menu -->
    
                @include('admin_teacher.side_navbar')
    

            </div>
    
            <!-- Work Zone  -->
    
            <div class="col-md-10 work-section">
    
    
                <!-- Header -->
                
                <div class="col-md-12 work-section-header">
    
                
                    <!-- NavBar -->
                    
                    @include('layouts.teacher.navbar')
    
    
                </div>
                
                <div class="header-breadcrumb">
                    
    
                    <ol class="breadcrumb pull-right">
    
    
                        @yield('breadcrumb')
                        
                        
                    </ol>
        
        
                </div>
        
                <!-- Work section -->
        
                <div class="col-md-12 work-section-content">
            
                    
                    @yield('work-section')
    
                    <div>
        
        
                        <ul class="list-inline pull-right">
            
            
                            <li>
                
                                © 2017 Clairefontaine ENT - Tous droits réservés.
            
                            </li>
            
                            <li>
                
                                <a href="http://www.clairefontaine.ci" target="_blank">
                    
                                    Clairefontaine
                
                                </a>
            
                            </li>
        
        
                        </ul>
    
    
                    </div>
                    
                </div>
                
                
                
                
            </div>
    
    
    
            
            
            
        </div>
            
        
        
    
    
           
    
    
    </div>




@endsection

@section('footer')
    
    
    <!-- Footer -->
    
    @include('layouts.teacher.footer_teacher')
    
    
@endsection