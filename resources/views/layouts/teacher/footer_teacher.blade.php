<footer class="footer text-center">


    <script src="{{ asset('js/app.js') }}"></script>
    
    <script src="https://use.fontawesome.com/9736c7c481.js"></script>


@if( request()->is('admin_teacher/*') )
        
        {{-- Script for datetime picker --}}
        
        <script type="text/javascript">

            

            $('.date input').datepicker({


                format: "dd-mm-yyyy",
                
                autoclose: true,
                
                todayHighlight: true,
                
                language : 'fr',

                endDate : '0d',

                todayBtn: "linked",
            
            });
            
            
        </script>
        
    @endif
    
    
    
    @include('flashy::message')
    
    
</footer>