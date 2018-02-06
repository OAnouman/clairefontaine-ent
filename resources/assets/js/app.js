
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.axios = require('axios');

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


window.Event = new class {


    constructor()
    {


        this.vue = new Vue();


    }


    fire(event, data = null)
    {


        this.vue.$emit(event, data);


    }


    listen(event , callback) {


        this.vue.$on(event, callback);


    }


}


Vue.component('breadcrumb', {

    template : `
   
        <div class="col-md-12 ">


                <ol class="breadcrumb">


                   <slot></slot>


                </ol>


        </div>
   
   `,


    data (){

        return {}

    }


});


Vue.component('toggle-menu',{


    template : `
    
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        :data-target="data_target" aria-expanded="false">


                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>


            </button>
    `,

    props : [

        'target',
    ],

    computed : {

        data_target () {


            return '#' + this.target;
        }

    }


});


Vue.component('panel-default', {


    props : ['id'],

    template : `
   
        <div class="panel panel-default" :id="id">


            <div class="panel-heading">
    
    
                <h3 class="panel-title">
                
                       <slot name="header"></slot>
                
                </h3>
    
    
            </div>

            <div class="panel-body">
    
    
                <slot>
                
                    Panel Content goes here !
                
                </slot>
    
    
            </div>


        </div>
   
   `

});


Vue.component('modal-confirm', {


   template : `
   
        
        <div class="modal fade" :id="ariaLabelled" tabindex="-1" role="dialog" :aria-labelledby="ariaLabelled">
        
        
          <div class="modal-dialog" role="document">
        
        
            <div class="modal-content">
        
        
              <div class="modal-header">
        
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span 
                aria-hidden="true">&times;</span></button>
        
                <h4 class="modal-title"> 
                
                    <slot name="header"></slot>
                
                </h4>
        
        
              </div>
        
              <div class="modal-body">
        
        
                <p>
                
                        
                        <slot>
                        
                               Modal body goes here !!
                        
                        </slot>
                
                
                </p>
        
        
              </div>
        
              <div class="modal-footer">
        
        
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>

                    <button @click="confirm" type="button"
                                        class="btn btn-danger">Confirmer</button>
        
        
              </div>
        
        
            </div><!-- /.modal-content -->
        
        
          </div><!-- /.modal-dialog -->
        
        
        </div><!-- /.modal -->
        
        
   `,


    data () {

        return {

            ariaLabelled : this.labelledby,

        }

    },


    props : [


        'labelledby'

    ],


    methods : {


       confirm (){

           schoolYearDeleteForm(1);

       }

    }

});


Vue.component('alert-dismiss', {


    props : ['success','danger'],


    template : `
    
            
             <div :class="[isSuccess ? success_class : '', isError ? error_class : '']" role="alert">

                <button type="button" class="close"
                        data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                    <slot>
                    
                    
                        Alert message
                    
                    
                    </slot>


            </div>
    
    
    `,




    computed : {


        isSuccess () {


            return this.success;

        },

        isError() {


            return this.danger;


        }


    },

    data () {


        return {


            success_class : 'alert alert-success alert-dismissable fade in',

            error_class : 'alert alert-danger alert-dismissable fade in',


        }

    },

    mounted() {

    }

});



Vue.component('example', require('./components/Example.vue'));

Vue.component('error', require('./components/Error.vue'));

Vue.component('grade-chart', require('./components/GradeChart.vue'));

Vue.component('overview', require('./components/OverviewAverage.vue'));

Vue.component('evaluations', require('./components/LastEvaluations.vue'));

Vue.component('profile-overview', require('./components/ProfileOverview.vue'));



const app = new Vue({


    el: '#app',


    data : {


        levelName : '',

        ajaxClassrooms : [],


    },

    methods: {

        /**
         * Submit delete form in index views
         *
         * @param event
         */
        deleteForm (event) {


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

                form.submit();


        },


        sendMessageToStudent(event)
        {

            // Get <a> elt

            let sendMessageLinkElt = event.currentTarget;

            let form = $(sendMessageLinkElt).find('form')[0];

            form.submit();


        },


        syncClass(event)
        {

            //Class name input

            $('#name')[0].value = event.currentTarget.value ;


        },

        /**
         * Just go to the previous page
         *
         */
        back()
        {


            history.back();


        },

        /**
         *  Trigger when student emergency
         *
         *  people modal form is submited
         *
         */

        submitEmergencyForm ()
        {

            // Submit form

            let form = $('#emergencyContactForm');

            // We call onEmergencyFormSubmit with

            // the form as parameter

            this.onEmergencyFormSubmit(form[0]);


        },

        onEmergencyFormSubmit(form)
        {

            // Retrieve form inputs values

            let data = this.objectifyForm(form);

            // Executing ajax request with form

            // inputs values

            axios.post('/ajax/add_emergency_contact',data)

            .then( response => {

                // Then promise to handle request

                // success execution


                // Close form modal

                $('#emergencyFormModal').modal('hide');


                // Refreshing emergency people section


                if ( location.href.search('admin_parent') !== -1 )


                    axios.get('/admin_parent/profile/' + data.student_id )

                        .then(response =>  $('#emergency').html(response.data) )



                else


                    axios.get('/admin/student/' + data.student_id )

                        .then(response =>  $('#emergency').html(response.data) )




            })
            .catch(error => {

                // Catch promise to handle

                // request failure. If errors occur

                // add has-error bs class and

                // display them with help-block


                // Retrieve each inputs <div>

                let nameDiv = $('#name-div');

                let linkDiv = $('#link-div');

                let phonesDiv = $('#phone-div');

                // Errors message

                let messages = error.response.data ;

                nameDiv.addClass('has-error');

                nameDiv.append('<span class="help-block"><strong>'+ messages.name[0] +' </strong></span>');

                linkDiv.addClass('has-error');

                linkDiv.append('<span class="help-block"><strong>'+ messages.link[0] +' </strong></span>');

                // Could be removed 'cause inputTags doesn't recognize it

                phonesDiv.addClass('has-error');

                phonesDiv.append('<span class="help-block"><strong>'+ messages.phones[0] +' </strong></span>');


            });


        },


        /**
         * Use too hide / show form on
         *
         * Liste de classe form
         *
         * @param event
         *
         * @deprecated
         */

        hideShow (event)
        {

            let button = $(event.currentTarget);

            $('#classroom-student-form').toggle(300, () => {

                // Update button label

                if ($.trim( button.html() ) === 'Ajouter')

                    button.html('Masquer');

                else

                    button.html('Ajouter');

            });



        },

        onClassroomSelect ()
        {


            axios.get('/admin/classroom_student?class_to_show=' + $('#class_to_show').selectpicker('val'))

                .then(response => {


                    $('#student_list').html(response.data);

                    let currentSite = window.location.hostname;

                    let href = "http://" + currentSite + '/admin/classroom_student/' + $('#class_to_show').val();

                    $('#printList').prop('href', href);


                });


        },

        onClassroomStudentFormSubmit (event)
        {


            let form = event.currentTarget;

            let student_id = form.elements.student_id.value;

            let classroom_id = form.elements.classroom_id.value;

            let redouble = form.elements.redouble.checked;

            axios.post('/admin/classroom_student', {


                    student_id : student_id,

                    classroom_id : classroom_id,

                    redouble : redouble,

                })
                .then( response => {


                    let displayMessageDiv = $('#display_message');

                    // displayMessageDiv.empty();

                    displayMessageDiv.html(`
                    
                          
                     <div class="alert alert-success alert-dismissable fade in" role="alert">
        
                        <button type="button" class="close"
                                data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
        
                            `+ response.data +`
        
        
                    </div>`);

                    axios.get('/admin/classroom_student?class_to_show=' + $('#class_to_show').selectpicker('val'))

                        .then(response => {


                            $('#student_list').html(response.data);

                            let currentSite = window.location.hostname;

                            let href = "http://" + currentSite + '/admin/classroom_student/' + $('#class_to_show').val();

                            $('#printList').prop('href', href);


                        });



                })
                .catch(error => {

                    $('#display_message').append(`
                    
                          
                     <div class="alert alert-danger alert-dismissable fade in" role="alert">
        
                        <button type="button" class="close"
                                data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
        
                            Une erreur est survenue lors de l'ajout !
        
        
                    </div>
        
                    
                    `)

                })

        },

        hideShowNew ()
        {


            $('#toggle').find('div.panel-body').toggle('fast', function () {


                let toggleButton = $('.toggle-button');

                if ( $(toggleButton).hasClass( 'glyphicon-eye-close' ) )
                {


                    toggleButton.removeClass('glyphicon-eye-close')

                        .addClass('glyphicon-eye-open');


                }
                else
                {


                    toggleButton.removeClass('glyphicon-eye-open')

                        .addClass('glyphicon-eye-close');


                }


            });


        },

        /**
         * Transform a given form value
         *
         * to an object
         *
         * @param form
         *
         * @returns {{}}
         */

        objectifyForm (form)
        {


            let objectForm = {};

            let jsonForm = $(form).serializeArray();

            $.each(jsonForm, function() {


                if (objectForm[this.name]) {


                    if (!objectForm[this.name].push) {


                        objectForm[this.name] = [objectForm[this.name]];


                    }

                    objectForm[this.name].push(this.value || '');


                }
                else
                {


                    objectForm[this.name] = this.value || '';


                }


            });

            return objectForm;


        },

        submitEvaluationForm ()
        {


            let form = $('#evaluationForm')[0];

            let data = this.objectifyForm(form);

            axios.post('/admin_teacher/evaluation' ,data)

                .then( response => {

                    // Destroy tooltip

                    $('div#evaluation_date')

                        .find('input#evaluation_date')

                        .tooltip('destroy');

                    $('div#classroom_id')

                        .find('div.btn-group')

                        .tooltip('destroy');

                    $('div#school_year_period_id')

                        .find('div.btn-group')

                        .tooltip('destroy');

                    $('div#subject_id')

                        .find('div.btn-group')

                        .tooltip('destroy');

                    $('div#coefficient')

                        .find('input#coefficient')

                        .tooltip('destroy');


                    location.reload();

                })

                .catch(errors => {

                    // Set tooltip with errors message

                    let messages = errors.response.data;

                    if (messages.evaluation_date !== undefined) {


                        $(form).find('div#evaluation_date')

                            .addClass('has-error')

                            .find('input#evaluation_date')

                            .attr('data-toggle', 'tooltip')

                            .attr('data-placement', 'top')

                            .attr('title', messages.evaluation_date[0])

                            .tooltip({trigger: "hover"});


                    }
                    else
                    {


                        if ($(form).find('div#evaluation_date').hasClass('has-error')) {


                            $(form).find('div#evaluation_date')

                                .removeClass('has-error')

                                .find('input#evaluation_date')

                                .tooltip('destroy');


                        }


                    }

                    if (messages.classroom_id !== undefined) {


                        $(form).find('div#classroom_id')

                            .addClass('has-error')

                            .find('div.btn-group')

                            .attr('data-toggle', 'tooltip')

                            .attr('data-placement', 'top')

                            .attr('title', messages.classroom_id[0] )

                            .tooltip();


                    }
                    else
                    {


                        if ( $(form).find('div#classroom_id').hasClass('has-error')) {


                            $(form).find('div#classroom_id')

                                .removeClass('has-error')

                                .find('div.btn-group')

                                .tooltip('destroy');


                        }


                    }

                    if (messages.school_year_period_id !== undefined) {


                        $(form).find('div#school_year_period_id')

                            .addClass('has-error')

                            .find('div.btn-group')

                            .attr('data-toggle', 'tooltip')

                            .attr('data-placement', 'top')

                            .attr('title', messages.school_year_period_id[0])

                            .tooltip({trigger: "hover"});


                    }
                    else
                    {


                        if ( $(form).find('div#school_year_period_id').hasClass('has-error')) {


                            $(form).find('div#school_year_period_id')

                                .removeClass('has-error')

                                .find('div.btn-group')

                                .tooltip('destroy');


                        }


                    }

                    if (messages.subject_id !== undefined) {


                        $(form).find('div#subject_id')

                            .addClass('has-error')

                            .find('div.btn-group')

                            .attr('data-toggle', 'tooltip')

                            .attr('data-placement', 'top')

                            .attr('title', messages.subject_id[0])

                            .tooltip({trigger: "hover"});


                    }
                    else
                    {


                        if ($(form).find('div#subject_id').hasClass('has-error')) {


                            $(form).find('div#subject_id')

                                .removeClass('has-error')

                                .find('div.btn-group')

                                .tooltip('tooltip');


                        }


                    }


                    if (messages.coefficient !== undefined) {


                        $(form).find('div#coefficient')

                            .addClass('has-error')

                            .find('input#coefficient')

                            .attr('data-toggle', 'tooltip')

                            .attr('data-placement', 'top')

                            .attr('title', messages.coefficient[0])

                            .tooltip({trigger: "hover"});


                    }
                    else
                    {


                        if ($(form).find('div#coefficient').hasClass('has-error')) {


                            $(form).find('div#coefficient')

                                .removeClass('has-error')

                                .find('input#coefficient')

                                .tooltip('destroy');


                        }


                    }


                });


        },

        submitEvaluationEditForm (event)
        {


            let button = event.currentTarget;

            let form = $(button).parent().parent().find('div.modal-body form')[0];

            let data = this.objectifyForm(form);

            axios.patch('/admin_teacher/evaluation/' + data.id , data)

                .then( response => {


                    $('div#display_message').append(displayMessageBlock);

                    // Destroy tooltip

                    $(form).find('div#evaluation_date')

                        .find('input#evaluation_date')

                        .tooltip('destroy');

                    $(form).find('div#classroom_id')

                        .find('div.btn-group')

                        .tooltip('destroy');

                    $(form).find('div#school_year_period_id')

                        .find('div.btn-group')

                        .tooltip('destroy');

                    $(form).find('div#subject_id')

                        .find('div.btn-group')

                        .tooltip('destroy');

                    $(form).find('div#coefficient')

                        .find('input#coefficient')

                        .tooltip('destroy');





                    // Close modal

                    let modalSelector = '#evaluationEditForm'+data.id;

                    $(modalSelector).modal('hide');

                    // Roload page

                    location.reload();

                })

                .catch(errors => {

                    // Set tooltip with errors message

                    let messages = errors.response.data;

                    if (messages.evaluation_date !== undefined) {


                        $(form).find('div#evaluation_date')

                            .addClass('has-error')

                            .find('input#evaluation_date')

                            .attr('data-toggle', 'tooltip')

                            .attr('data-placement', 'top')

                            .attr('title', messages.evaluation_date[0])

                            .tooltip({trigger: "hover"});


                    }
                    else
                    {


                        if ($(form).find('div#evaluation_date').hasClass('has-error')) {


                            $(form).find('div#evaluation_date')

                                .removeClass('has-error')

                                .find('input#evaluation_date')

                                .tooltip('destroy');


                        }


                    }

                    if (messages.classroom_id !== undefined) {


                        $(form).find('div#classroom_id')

                            .addClass('has-error')

                            .find('div.btn-group')

                            .attr('data-toggle', 'tooltip')

                            .attr('data-placement', 'top')

                            .attr('title', messages.classroom_id[0] )

                            .tooltip();


                    }
                    else
                    {


                        if ( $(form).find('div#classroom_id').hasClass('has-error')) {


                            $(form).find('div#classroom_id')

                                .removeClass('has-error')

                                .find('div.btn-group')

                                .tooltip('destroy');


                        }


                    }

                    if (messages.school_year_period_id !== undefined) {


                        $(form).find('div#school_year_period_id')

                            .addClass('has-error')

                            .find('div.btn-group')

                            .attr('data-toggle', 'tooltip')

                            .attr('data-placement', 'top')

                            .attr('title', messages.school_year_period_id[0])

                            .tooltip({trigger: "hover"});


                    }
                    else
                    {


                        if ( $(form).find('div#school_year_period_id').hasClass('has-error')) {


                            $(form).find('div#school_year_period_id')

                                .removeClass('has-error')

                                .find('div.btn-group')

                                .tooltip('destroy');


                        }


                    }

                    if (messages.subject_id !== undefined) {


                        $(form).find('div#subject_id')

                            .addClass('has-error')

                            .find('div.btn-group')

                            .attr('data-toggle', 'tooltip')

                            .attr('data-placement', 'top')

                            .attr('title', messages.subject_id[0])

                            .tooltip({trigger: "hover"});


                    }
                    else
                    {


                        if ($(form).find('div#subject_id').hasClass('has-error')) {


                            $(form).find('div#subject_id')

                                .removeClass('has-error')

                                .find('div.btn-group')

                                .tooltip('tooltip');


                        }


                    }


                    if (messages.coefficient !== undefined) {


                        $(form).find('div#coefficient')

                            .addClass('has-error')

                            .find('input#coefficient')

                            .attr('data-toggle', 'tooltip')

                            .attr('data-placement', 'top')

                            .attr('title', messages.coefficient[0])

                            .tooltip({trigger: "hover"});


                    }
                    else
                    {


                        if ($(form).find('div#coefficient').hasClass('has-error')) {


                            $(form).find('div#coefficient')

                                .removeClass('has-error')

                                .find('input#coefficient')

                                .tooltip('destroy');


                        }


                    }



                });



        },

        submitEvaluationGrade(event)
        {


            let buttonSubmit = $(event.currentTarget);

            $(buttonSubmit).button('loading');

            let forms = $('.list-group form');

            $.each(forms, (index, element) => {


                let data = this.objectifyForm(element);

                let pElt =  $(element).parent().parent().find('p span.icon');

                // Check if it's a new record or if we have

                // to update an older one

                if (data.id === '' )
                {


                    // New record -> save

                    // Make ajax post request

                    // to store grades

                    axios.post('/admin_teacher/grade',data )

                        .then( response => {

                            // Remove error and Add ok glyph if success

                            $(pElt)

                                .empty()

                                .html(`
                                
                                    <span class="pull-right glyphicon glyphicon-ok text-success">
                                    </span>
                                
                                `);



                            // Set id field value

                            // to be able to update grade just

                            // after creation

                            $(element).find('input#id').val(response.data.id);

                            // Remove error class

                            if ($(element).find('input#value').parent().parent().hasClass('has-error'))
                            {


                                $(element).find('input#value')

                                    .parent()

                                    .parent()

                                    .removeClass('has-error');

                                $(element).find('input#value')

                                    .removeAttr('data-toggle')

                                    .removeAttr('title')

                                    .tooltip('destroy')


                            }

                            if ($(element).find('input#teacher_assessment').hasClass('has-error'))
                            {


                                $(element).find('input#teacher_assessment')

                                    .parent()

                                    .parent()

                                    .removeClass('has-error');

                                $(element).find('input#teacher_assessment')

                                    .removeAttr('data-toggle')

                                    .removeAttr('title')

                                    .tooltip('destroy')


                            }


                        })

                        .catch( errors => {


                            let messages = errors.response.data;

                            // Add error glyph if failed

                            $(pElt)

                                .empty()

                                .html(`
                                
                                    <span class="pull-right glyphicon glyphicon-remove text-danger">
                                    </span>
                                
                                `);

                            // Notify the error

                            if (messages.value !== undefined)
                            {


                                $(element).find('input#value')

                                    .parent()

                                    .parent()

                                    .addClass('has-error');


                                $(element).find('input#value')

                                    .attr('data-toggle', 'tooltip')

                                    .attr('title', messages.value)

                                    .attr('data-placement', 'top')

                                    .tooltip('trigger', 'hover');


                            }
                            else
                            {


                                if ($(element).find('input#value').hasClass('has-error'))
                                {


                                    $(element).find('input#value')

                                        .parent()

                                        .parent()

                                        .removeClass('has-error');

                                    $(element).find('input#value')

                                        .removeAttr('data-toggle')

                                        .removeAttr('data-placement')

                                        .removeAttr('title')

                                        .tooltip('destroy')


                                }


                            }


                        });


                }
                else // Older one -> update
                {


                    // Make ajax patch request

                    // to update grades

                    axios.patch('/admin_teacher/grade/'+data.id ,data )

                        .then( response => {


                            // Add ok glyph if success

                            $(pElt)

                                .empty()

                                .html(`
                                
                                    <span class="pull-right glyphicon glyphicon-ok text-primary">
                                    </span>
                                
                                `);

                            // Remove error class

                            if ($(element).find('input#value').parent().parent().hasClass('has-error'))
                            {


                                $(element).find('input#value')

                                    .parent()

                                    .parent()

                                    .removeClass('has-error');

                                $(element).find('input#value')

                                    .removeAttr('data-toggle')

                                    .removeAttr('data-placement')

                                    .removeAttr('title')

                                    .tooltip('destroy')


                            }

                            if ($(element).find('input#teacher_assessment').hasClass('has-error'))
                            {


                                $(element).find('input#teacher_assessment')

                                    .parent()

                                    .parent()

                                    .removeClass('has-error');

                                $(element).find('input#teacher_assessment')

                                    .removeAttr('data-toggle')

                                    .removeAttr('title')

                                    .tooltip('destroy')


                            }


                        })

                        .catch( errors => {


                            let messages = errors.response.data;

                            $(pElt)

                                .empty()

                                .html(`
                                
                                    <span class="pull-right glyphicon glyphicon-remove text-danger">
                                    </span>
                                
                                `);

                            // Notify the error

                            if (messages.value !== undefined)
                            {


                                $(element).find('input#value')

                                    .parent()

                                    .parent()

                                    .addClass('has-error');


                                $(element).find('input#value')

                                    .attr('data-toggle', 'tooltip')

                                    .attr('title', messages.value)

                                    .attr('data-placement', 'top')

                                    .tooltip('trigger', 'hover');


                            }
                            else
                            {


                                if ($(element).find('input#value').hasClass('has-error'))
                                {


                                    $(element).find('input#value')

                                        .parent()

                                        .parent()

                                        .removeClass('has-error');

                                    $(element).find('input#value')

                                        .removeAttr('data-toggle')

                                        .removeAttr('data-placement')

                                        .removeAttr('title')

                                        .tooltip('destroy')


                                }


                            }
                            {


                                if ($(element).find('input#value').hasClass('has-error'))
                                {


                                    $(element).find('input#value')

                                        .parent()

                                        .parent()

                                        .removeClass('has-error');

                                    $(element).find('input#value')

                                        .removeAttr('data-toggle')

                                        .removeAttr('title')

                                        .tooltip('destroy')


                                }


                            }

                        });


                }


            });


            $(buttonSubmit).button('reset');


        },


        filterGradeBySubject(event)
        {


            $(event.currentTarget).closest('form').submit();


        },


        submitMessageThreadForm ()
        {


            $('#message-thread-form').submit();


        },


        showMessageThread (event)
        {


            let currentMessageThread = event.currentTarget;

            window.location = $(currentMessageThread).attr('data-href');


        },


        formatDate(date)
        {


            return date.getDate() + '-' + (date.getMonth() + 1) + '-' +
                date.getFullYear() + ' à ' + date.getHours() + ':' + date.getMinutes() ;


        },

        onMessageSubmit (event)
        {

            let button = $(event.currentTarget);

            $(button).button('loading');

            let form = $(button).closest('form')[0];

            let data = this.objectifyForm(form);

            axios.post('/message', data)

                .then(response => {


                    let message = `
                    
                    <li class="message-item highlight">
        
                        
                        
        
                        <div class="message-sender text-right">
                            
                            <div class="timestamp text-left col-md-4">
                                            
                                <em class="text-muted"> ` + this.formatDate(new Date())  + `</em>
                                                
                            </div>
                            
                            <div class="sender col-md-8 text-right"> Moi </div>
            
                        </div>
            
                        <hr>
            
                        <p class="message-text"> `


                            +
                
                                response.data.body

                            + `
                                       
            
                        </p>
    
    
                    </li>
                    
                    `;

                    // adding message in the thread

                    $('.message-thread').prepend(message).fadeIn('slow', 'swing');

                    // Clear textarea

                    $('textarea').val('');

                    $(button).button('reset');



                })
                .catch(error => {


                    $(button).button('reset');


                })


        },


        allowSendingMessage (event)
        {


            let val = $(event.currentTarget).val();

            if (val.length === 0)

                $('.send-button').attr('disabled', true);

            else

                $('.send-button').removeAttr('disabled');



        },


        /**
         * Turn a button to on processing state
         *
         * @param event
         */

        loadingState(event)
        {


            $(event.currentTarget).button('loading');


        },


        setActive (event)
        {


            let link = event.currentTarget;

            if ($(link).find('.submenu').hasClass('in'))
            {


                $(link).removeClass('active');

            }
            else
            {


                $(link).addClass('active');


            }


        },

        /**
         * Uppercase text input content
         * @param event
         */

        upperCaseInput(event)
        {

            // Retrieve input field

            let inputField = $(event.currentTarget);

            // Upper case its content

            let upperCaseValue = $(inputField).val().toUpperCase();

            $(inputField).val(upperCaseValue);



        },

        generatePassword()
        {

            let password = this.randomString(8);

            $('#password').val(password);

            if ( $('#password_confirmation').length )

                $('#password_confirmation').val(password);

            else

                $('#password-confirm').val(password);
        },

        /**
         * Generate a random string
         * @param length : The length of the generated string
         * @returns {string}
         */

        randomString(length)
        {


            let randomPassword = "";

            let baseChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (let i = 0; i < length; i++)

                randomPassword += baseChars.charAt(Math.floor(Math.random() * baseChars.length));

            return randomPassword;


        },

        /**
         * Show / hide a password input type content
         */

        togglePassword()
        {

            let passwordInputField = $('#password');

            if ( passwordInputField.attr('type') === 'password' )

                passwordInputField.attr('type', 'text');

            else

                passwordInputField.attr('type', 'password');

        },



    },



    mounted () {

        // Set opt-in component

        $('[data-toggle="tooltip"]').tooltip();

        $('[data-toggle="popover"]').popover();

        // Initialy hide evaluation form for

        // teacher admin evaluation index

        this.hideShowNew();


    }

});


