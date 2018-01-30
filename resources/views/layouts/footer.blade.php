<footer class="footer navbar-fixed-bottom text-center">
    
    
    <div class="container">
        
        <div class="row">
        
            {{--<span class="text-muted">© Clairefontaine 2017 - Tous droits réservés.</span>--}}
            
            <ul class="list-inline">
                
                
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
    





    <script src="{{ asset('js/app.js') }}"></script>
    
    <script src="https://use.fontawesome.com/9736c7c481.js"></script>


@if( request()->is('admin/student/*') || request()->is('admin/teacher/*') )
        
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
    
    @if(request()->is( 'admin/classroom_student' ))
        
        
        <script type="text/javascript">


            function ajaxDeleteForm (){


                // Delete link

                let deleteLink = event.currentTarget;

                // Fetch elt child and retrive the form related

                let childs = deleteLink.childNodes;

                let form;

                childs.forEach(function(e) {

                    if(e.tagName === "FORM")

                        form = e;

                });
                
                // Submit form

                if ( confirm('Confirmer la suppression ?') )
                {


                    let student_id = form.elements.student_id.value;
                    
                    let classroom_id = form.elements.classroom_id.value;
                    
                    axios.delete('/admin/classroom_student/' + classroom_id + '/' + student_id )
                        .then( response => {

                            let displayMessageDiv = $('#display_message');

                            displayMessageDiv.empty();

                            displayMessageDiv.append(`
                                 
                                 <div class="alert alert-success alert-dismissable fade in" role="alert">
                    
                                    <button type="button" class="close"
                                            data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                    
                                        `+ response.data +`
                    
                    
                                </div>`);

                            axios.get('/admin/classroom_student?class_to_show='  + $('#class_to_show').val())
                                .then(response => {


                                    $('#student_list').html(response.data);


                                })
                        
                        })
                    
                    
                }

                


            }
            
            
        </script>
        
        
    @endif
    
    @if(request()->is('admin/student/*'))
    
        
        <script type="text/javascript">
            

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


                            axios.get('/admin/student/' + student_id )

                                .then(response =>  {
                                    
                                    
                                    $('#emergency').html(response.data)
                                    
                                
                                } )
                            
                            
                        } )




                }
                
                event.preventDefault();
           
                
            }
            
            
            
        </script>
        
        
    @endif
    
    
</footer>