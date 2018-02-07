{{--

 * Created by PhpStorm.
 * User: CLAIREFONTAINE
 * Date: 07/02/2018
 * Time: 12:52

 --}}

@extends('layouts.admin_master')


@section('breadcrumb')


    <li>

        <a href="{{ route('home') }}">Accueil</a>

    </li>

    <li>

        Paramètres

    </li>

    <li>

        <a href="{{ route('scholarship.index') }}">Scolarité</a>

    </li>


@endsection

@section('work-section')

    <panel-default>

        <template slot="header">

            Scolarité

        </template>

        @include('layouts.display-message')

        <div class="row">

            <div class="col-md-9">

                <p>

                    <strong>

                        {{ $scholarships->firstItem() . ' à ' . $scholarships->lastItem() .
                        ' sur ' . $scholarships->total() }}

                    </strong>

                </p>

            </div><!-- Pagination state -->

            <div class="col-md-3 pull-right">

                {{-- Create button --}}

                <a href="{{ route('scholarship.create') }}" class="btn btn-success pull-right">


                    Créer


                </a>

            </div>

        </div>

        <table class="table table-responsive table-hover table-condensed">


            <thead>

                <td class="col-md-1">

                    <strong>
                        #
                    </strong>

                </td>

                <td class="col-md-3">

                    <strong>

                        Niveau

                    </strong>

                </td>

                <td class="col-md-3">

                    <strong>

                        Droit Inscrip.

                    </strong>

                </td>

                <td class="col-md-5">

                    <strong>

                        Scolarité

                    </strong>

                </td>



            </thead>

            <tbody>

                @foreach($scholarships as $scholarship)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            {{ $scholarship->level->name }}

                        </td>

                        <td>

                            {{ $scholarship->registration_fees . 'F CFA' }}

                        </td>

                        <td>

                            {{ $scholarship->price . 'F CFA' }}

                        </td>

                    </tr>

                @endforeach

            </tbody>


        </table>

        {{ $scholarships->links() }}

    </panel-default>

@endsection