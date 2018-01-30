<footer class="footer text-center">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
    
    <script src="{{ asset('js/http_cdnjs.cloudflare.com_ajax_libs_Chart.js_2.7.0_Chart.js') }}"></script>
    
    <script src="https://use.fontawesome.com/9736c7c481.js"></script>
    
    <script src="{{ asset('js/app.js') }}"></script>
    
    
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
        
        $('.input-daterange').datepicker({


            format: "dd-mm-yyyy",

            autoclose: true,

            todayHighlight: true,

            language : 'fr',

            endDate : '0d',

            todayBtn: "linked",

        });

        function emergencyPeopleDeletion() {


            // Delete link

            let deleteLink = event.currentTarget;

            // Get the child form

            let form = $(deleteLink).find('form')[0];

            let emergency_people_id = form.elements.emergency_people_id.value ;

            let student_id = form.elements.student_id.value;

            // Submit form

            if ( confirm('Confirmer la suppression ?') )
            {


                axios.delete('/ajax/emergency_contact/' + emergency_people_id )

                    .then( response => {


                        axios.get('/admin_parent/profile/' + student_id )

                            .then(response =>  {


                                $('#emergency').html(response.data)


                            } )


                    } )




            }

            event.preventDefault();


        }
    
    
    </script>
    
    
    
    @include('flashy::message')


</footer>