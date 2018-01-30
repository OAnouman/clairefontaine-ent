@extends('layouts.admin_master')


@section('breadcrumb')


    <li>

        <a href="{{ route('home') }}">Accueil</a>

    </li>

    <li>

        Paramètres

    </li>

    <li>

        <a href="{{ route('school_year_period.index') }}">Découpage annuel</a>

    </li>




@endsection


@section('work-section')




    <panel-default>

        {{-- Panel Header --}}

        <template slot="header">

            Découpage annuel

        </template>


        {{-- Panel Body --}}


        @include('layouts.display-message')


        {{-- Create button --}}

        <a href="{{ route('school_year_period.create') }}" class="btn btn-success pull-right">


            Créer


        </a>


        <table class="table table-responsive table-hover table-condensed">


            <thead>

            <td class="col-md-1">

                #

            </td>

            <td class="col-md-5">


                <strong>

                    Libellé

                </strong>


            </td>

            <td class="col-md-1">


                <strong>

                    Index

                </strong>


            </td>

            <td class="col-md-3">


                <strong>

                    Année scolaire

                </strong>


            </td>

            <td></td>

            <td></td>

            </thead>

            @foreach($schoolYearPeriods as $schoolYearsPeriod)


                <tr>


                    <td>


                        {{ $schoolYearsPeriod->id }}


                    </td>

                    <td>


                        {{ $schoolYearsPeriod->name }}


                    </td>

                    <td>


                        {{ $schoolYearsPeriod->index }}


                    </td>

                    <td>


                        {{ $schoolYearsPeriod->schoolYear->name }}


                    </td>

                    <td>


                        <a href="{{ route('school_year_period.edit',[$schoolYearsPeriod->id]) }}"
                           title="{{ 'Modifier ' . $schoolYearsPeriod->name }}" data-toggle="tooltip"
                           data-placement="top">


                            <span class="glyphicon glyphicon-edit " aria-hidden="true"></span>


                        </a>


                    </td>

                    <td>


                        <a v-on:click.prevent="deleteForm($event)" href="#"
                           title="{{ 'Supprimer ' . $schoolYearsPeriod->name }}" data-toggle="tooltip"
                           data-placement="top">


                            <span  class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>


                            {{--Form for requesting school year deletion --}}

                            <form action="{{ route('school_year_period.destroy',[$schoolYearsPeriod->id]) }}"
                                  method="POST">


                                {{ csrf_field() }}

                                <input name="_method" type="hidden" value="DELETE">


                            </form>


                        </a>



                    </td>




                </tr>


            @endforeach


        </table>


        {{ $links }}

    </panel-default>




@endsection
