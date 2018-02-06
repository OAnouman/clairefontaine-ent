<template>


    <div class="thumbnail">

        <div class="col-md-5">

            <h5>Evolution de vos notes</h5>

        </div>

        <div class="col-md-8>">


            <div class="dropdown pull-right">



                <button id="sortMenu" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" class="btn btn-default btn-xs">

                    <span class="glyphicon glyphicon-menu-hamburger"></span>


                </button>

                <ul aria-labelledby="sortMenu" class="dropdown-menu" id="subject-list">

                </ul>

            </div>

        </div>


        <canvas id="gradeChart" height="150"></canvas>


    </div>

</template>

<script>

    export default {


        mounted() {


            Chart.defaults.global.defaultFontFamily = "Raleway, sans-serif";

            this.context = $('#gradeChart');

            let data = {


            };

            this.chart = new Chart(this.context, {

                type : 'line',

                data : data,

                options: {


                    tooltips: {


                        backgroundColor: 'rgba(255,255,255,.8)',

                        titleFontSize: 12,

                        titleFontColor: '#000',

                        bodyFontColor: '#000',

                        bodyFontSize: 12,

                        displayColors: false,

                        borderColor : 'rgba(48, 160, 235, 0.7)',


                    }


                },

            });

            $(document).ready(this.subjectRequest);


        },


        methods : {

            /**
             *
             * Get all subject for current classroom
             *
             * and fill the dropdown menu with them
             *
             * student classroom
             *
             */

            subjectRequest ()
            {


                axios.get('/subjects/' + this.classroom.id)

                    .then(response => {


                        let subjects  = response.data ;

                        // Fetching subjects

                        $.each(subjects, (index, element) => {


                            $('#subject-list').append(`


                                <li> <a data-value= "`+ element.id +`" data-target = "#" > ` + element.name + ` </a> </li>


                            `)


                        });

                        // Attach event ton item

                        $.each( $('#subject-list').find('li'), (index, element) => {


                            $(element).on('click', this.onSubjectSelect)

                        });

                        // Display first suject grades

                        this.fillChart(subjects[0]);


                    } );



            },


            /**
             * Draw chart with grades of given subject
             *
             * @param subject
             */

            fillChart (subject)
            {

                let today = new Date();

                // Retrieving and formatting dates used to make query.

                // The interval is set to three months, so we display all grades

                // of a given subject within this interval

                let threeMonthsBackDate = new Date();

                threeMonthsBackDate.setMonth(new Date().getMonth() - 2);

                let beginDate =
                    threeMonthsBackDate.getFullYear() + '-' + (threeMonthsBackDate.getMonth() + 1) + '-' + ( threeMonthsBackDate.getDate() ),

                    endDate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + ( today.getDate()  );

                axios.get('/student_grade/'+  subject.id  +'/' + beginDate + '/'
                    + endDate + '/' + this.classroom.id)

                    .then( response => {


                        // Building chart data

                        let evaluations = response.data;

                        // X axis labels and grades

                        let labels = [];

                        let grades = [];

                        $.each(evaluations, (index, grade)  => {


                            labels.push( grade.date );

                            grades.push( grade.grade );


                        });

                        this.chart.data.labels = labels;

                        let data = {


                            label : subject.name,

                            data : grades,

                            backgroundColor: [

                                'rgba(48, 160, 235, 0.1)',
                            ],

                            borderColor : 'rgba(48, 160, 235, 0.7)',

                            borderWidth : 1,

                            pointBorderColor: 'rgba(48, 160, 235, 0.7)',

                            pointBackgroundColor: 'rgba(255,255,255,0.9)',

                            pointRadius: 3,

                            pointHoverRadius: 6,

                            pointHitRadius: 18,

                            pointBorderWidth: 2,


                        };

                        this.chart.data.datasets.length =  0;

                        this.chart.data.datasets.push( data );

                        this.chart.update();


                    });


            },


            /**
             * Triggered on subject selection
             *
             * @param event
             */

            onSubjectSelect (event)
            {


                let el = event.currentTarget;

                let id = $(el).find('a').attr('data-value');

                let subject  = {

                    id : id,

                    name : $(el).find('a').text(),

                };

                this.fillChart(subject);

            }


        },

        data ()
        {


            return {


                context :  null,

                chart : null,

                subject : null,


            }


        },

        props :
        {


            classroom : null,


        }

    }
</script>