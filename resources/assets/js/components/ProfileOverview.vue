<template>


    <div class="thumbnail">

        <div class="col-md-5">

            <h5>Profil de l'élève</h5>

        </div>

        <div class="col-md-8>">


            <div class="dropdown pull-right">



                <button id="sortMenu" type="button" class="btn btn-default btn-xs">

                    <span class="glyphicon glyphicon-refresh"></span>


                </button>


            </div>

        </div>


        <canvas id="radarChart" height="190" ></canvas>


    </div>

</template>

<script>

    export default {


        mounted() {


            Chart.defaults.global.defaultFontFamily = "Raleway, sans-serif";

            this.context = $('#radarChart');

            let data = {


            };

            this.chart = new Chart(this.context, {

                type : 'radar',

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


                    },

                    scale: {


                        ticks: {


                            beginAtZero: true,

                            max: 20,


                        }


                    },


                },

            });

            $(this.subjectRequest);


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

                        let labels = [];

                        // Fetching subjects

                        $.each(subjects, (index, element) => {


                            labels.push(element.name);


                        });

                        // Display radar chart

                        this.fillChart(labels);


                    } );



            },


            /**
             * Draw chart with grades of given subject
             *
             * @param labels
             *
             * @param averages
             */

            fillChart (labels)
            {

                axios.get('/profile_overview/' + this.student.id)

                    .then(response => {

                            let subjects = [];

                            $.each(response.data, (index, element) => {


                                subjects.push(element);


                            });

                            // Sorting by name

                            subjects = subjects.sort(this.compare);

                            let averages = [];

                            // Fetching subjects

                            $.each(subjects, (index, element) => {


                                averages.push(element.avg);


                            });

                        this.chart.data.labels = labels;

                        let data = {


                            label : 'Moyennes',

                            data : averages,

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

            compare (a,b)
            {


                if (a.name < b.name)

                    return -1;

                if (a.name > b.name)

                    return 1;

                return 0;


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


                student : null,

                classroom : null,


            }

    }
</script>