<template>


    <div class="thumbnail overview">

        <div class="col-md-5">

            <h5>Moyennes</h5>

        </div>

        <div class="col-md-8>">


            <div class="dropdown pull-right">


                <button id="sortMenu" type="button" class="btn btn-default btn-xs"
                        @click="startup">

                    <i class="fa fa-refresh" aria-hidden="true"></i>


                </button>


            </div>


        </div>


        <div class="col-md-12 margin-top-xs">


            <div class="col-md-3 circle-container">


                <div class="circle circle-primary">

                    <p id="first-quarter">0</p>

                </div>

                <p class="circle-caption"> 1er trimestre </p>


            </div>

            <div class="col-md-3 circle-container">


                <div class="circle circle-success">

                    <p id="second-quarter">0</p>

                </div>

                <p class="circle-caption"> 2è trimestre </p>

            </div>

            <div class="col-md-3 circle-container">


                <div class="circle circle-danger">

                    <p id="third-quarter">0</p>

                </div>

                <p class="circle-caption"> 3è trimestre </p>

            </div>

            <div class="col-md-3 circle-container">


                <div class="circle circle-info">

                    <p id="annual">0</p>

                </div>

                <p class="circle-caption"> Annuelle </p>

            </div>


        </div>



    </div>

</template>

<script>

    export default {


        mounted() {


            $(document).ready(this.startup);

        },


        methods : {


            startup () {


                // Get school year periods for a given classroom

                axios.get('/periods/' + this.classroom )

                    .then( response => {


                        let student_id = this.student;

                        let periods = response.data;

                        let firstQ = null, secondQ = null, thirdQ = null ;

                        periods.forEach(function (period) {


                            // Get average for each period

                            axios.get('/averages/'+ student_id + '/' + period.id )

                                .then( response =>  {


                                    let average = parseFloat(response.data) ;

                                    if (period.index === 1)
                                    {

                                        firstQ = average;

                                        $('#first-quarter').animateNumber({


                                            number : average ,

                                            duration : 2000,

                                            numberStep: function(now, tween) {

                                                // Snippet from https://codepen.io/alexandr-borisov/details/egNVmR

                                                let formatted = now.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
                                                $(tween.elem).text(formatted);
                                            }

                                        });


                                    }
                                    else if (period.index === 2)
                                    {


                                        secondQ = average;

                                        $('#second-quarter').animateNumber({


                                            number : average ,

                                            duration : 2000,

                                            numberStep: function(now, tween) {

                                                // Snippet from https://codepen.io/alexandr-borisov/details/egNVmR

                                                let formatted = now.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
                                                $(tween.elem).text(formatted);
                                            }

                                        });


                                    }
                                    else
                                    {


                                        thirdQ = average;

                                        $('#third-quarter').animateNumber({


                                            number : average ,

                                            duration : 2000,

                                            numberStep: function(now, tween) {

                                                // Snippet from https://codepen.io/alexandr-borisov/details/egNVmR

                                                let formatted = now.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
                                                $(tween.elem).text(formatted);
                                            }

                                        });


                                    }

                                    let annual =  ( firstQ + secondQ + thirdQ ) / periods.length  ;

                                    // Set annual average

                                    $('#annual').animateNumber({


                                        number : annual ,

                                        duration : 2000,

                                        numberStep: function(now, tween) {

                                            // Snippet from https://codepen.io/alexandr-borisov/details/egNVmR

                                            let formatted = now.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
                                            $(tween.elem).text(formatted);
                                        }

                                    });



                                 });


                        });



                    });


            },

        },

        data ()
        {


            return {




            }


        },

        props :
            {


                student : null,

                classroom : null,


            }

    }
</script>