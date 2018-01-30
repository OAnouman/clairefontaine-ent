<template>


    <div>


        <div class="container">



            <h1 class="text-center">


                <slot name="error-name">


                    <i class="fa fa-ban text-danger" aria-hidden="true"></i> 403 <br>

                    <small class="text-uppercase">Accès non autorisé</small>


                </slot>


            </h1>

            <br>
            <br>

            <div class="row">


                <p class="lead text-center">


                    <slot name="error-description">


                        <strong> Vous n'êtes pas autorisé à acceder à cette ressource. </strong>
                        <br>

                        Si vous ne savez pas comment vous êtes arrivé ici,

                        veuillez simplement retourner  <br>  la page d'accueil. <br>

                        Si vous estimez avoir droit à cette ressource, veuillez contacter

                        les <br> adminstrateurs du site.

                    </slot>


                </p>


            </div>

            <div class="button-section">


               <p v-if=" refresh === false " class="text-center">


                   <a @click.prevent="back" href="" class="btn btn-primary btn-lg">


                       <i class="fa fa-arrow-circle-o-left  " aria-hidden="true"></i> &nbsp;Page précedente


                   </a>

                   <a @click.prevent="homePage" href="" class="btn btn-primary btn-lg">


                       <i class="fa fa-home" aria-hidden="true"></i> &nbsp; Page d'accueil


                   </a>


               </p>

                <p v-else class="text-center">


                    <a @click.prevent="back" href="" class="btn btn-success btn-lg">


                        <i class="fa fa-retweet  " aria-hidden="true"></i> &nbsp; Ressayer


                    </a>


                </p>



            </div>



        </div>


    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')

        },


        methods : {

            homePage(){


                let currentSite = window.location.hostname;

                window.location = "http://" + currentSite;


            },


            back(){


                history.back();


            },

        },

        props:
            {


                refresh : false,


            }
    }
</script>