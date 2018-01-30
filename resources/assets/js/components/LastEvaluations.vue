<template>


    <div class="thumbnail overview">

       <div class="row">


           <div class="col-md-5">

               <h5>Evaluations récentes</h5>

           </div>

           <div class="col-md-8>">


               <div class="dropdown pull-right">



                   <button type="button" class="btn btn-default btn-xs"
                           @click="startup">

                       <i class="fa fa-refresh" aria-hidden="true"></i>


                   </button>

                   <button id="sortMenu" type="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" class="btn btn-default btn-xs">

                       <span class="glyphicon glyphicon-menu-hamburger"></span>


                   </button>

                   <ul aria-labelledby="sortMenu" class="dropdown-menu">

                       <li> <a data-target = "#" > 10 dernières </a> </li>

                       <li> <a data-target = "#" > 20 dernières </a> </li>

                   </ul>

               </div>


           </div>


           <div id="evaluation-list" class="col-md-12 margin-top-xs">


               <table class="table table-hover table-condensed ev-list">


                   <thead>


                   <tr>


                       <th class="col-md- text-uppercase">

                           Date

                       </th>

                       <th class="col-md-3 text-uppercase">

                           Matière

                       </th>

                       <th class="col-md-1 text-uppercase">

                           Note

                       </th>

                       <th class="col-md-6 text-uppercase">

                           Commentaires

                       </th>


                   </tr>


                   </thead>

                   <tbody id="evaluation-list-content">





                   </tbody>


               </table>


           </div>


           <div class="row sr-only loading">


               <i class="fa fa-refresh fa-spin fa-4x fa-fw"></i>


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


            startup ()
            {


                // Hiding table and showing spinner

                $('#evaluation-list').addClass('sr-only');

                $('.loading').removeClass('sr-only');

                axios.get('/evaluations/' + this.student.id + '/' + this.limit)

                    .then( response => {


                        let evaluations = response.data;

                        // We empty table content

                        $('#evaluation-list-content').empty();

                        $.each( evaluations , (index, element) => {


                            $('#evaluation-list-content').append(`

                                <tr>


                                    <td> ` + element.date +`</td>

                                    <td> ` + element.subject +`</td>

                                    <td> <strong> ` + element.grade +`</strong> </td>

                                    <td> ` + element.comments +`</td>


                                </tr>

                            `)


                        });

                        if (evaluations.length > 0)
                        {


                            // Hide spinner and show table

                            $('.loading').addClass('sr-only');

                            $('#evaluation-list').removeClass('sr-only');


                        }
                        else
                        {


                            // Hide spinner and show table

                            $('.loading').addClass('sr-only');

                            $('#evaluation-list').removeClass('sr-only');


                        }



                    })


            }


        },

        data ()
        {


            return {


                result : null,


            }


        },

        props : {


                student : null,

                limit : null,


        },

        computed : {





        }


    }
</script>