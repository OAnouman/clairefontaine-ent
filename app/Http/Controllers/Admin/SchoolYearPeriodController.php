<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolYearPeriodRequest;
use App\Repositories\SchoolYearPeriodRepository;
use Illuminate\Http\Request;


class SchoolYearPeriodController extends Controller
{


    protected $schoolYearPeriodRepository;

    protected $redirectTo = 'school_year_period.index';



    public function __construct( SchoolYearPeriodRepository $schoolYearPeriodRepository )
    {


        $this->middleware( ['auth', 'admin'] );

        $this->schoolYearPeriodRepository = $schoolYearPeriodRepository;


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        $schoolYearPeriods = $this->schoolYearPeriodRepository->all()
                                                              ->paginate();

        $links = $schoolYearPeriods->links();

        return view( 'school_year_period.index', compact( 'schoolYearPeriods', 'links' ) );


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {


        $schoolYears = new \App\Repositories\SchoolYearRepository;

        $schoolYears = $schoolYears->all();

        return view( 'school_year_period.create', compact( 'schoolYears' ) );


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param SchoolYearPeriodRequest|Request $request
     *
     * @return \Illuminate\Http\Response
     */

    public function store( SchoolYearPeriodRequest $request )
    {


        /*
         * Save and flash message to session
         */

        if ( $this->schoolYearPeriodRepository->create( $request->all() ) ) {


            session()->flash( 'success', 'La période à été créee avec succès !' );


        }

        else {


            session()->flash( 'failed', 'une erreur est survenue lors de l\'enregistrement.' );


        }


        return redirect( )->route($this->redirectTo);


    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function show( $id )
    {



    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function edit( $id )
    {


        $schoolYearPeriod = $this->schoolYearPeriodRepository->get( $id );

        $schoolYears = new \App\Repositories\SchoolYearRepository;

        $schoolYears = $schoolYears->all();

        return view( "school_year_period.edit",
            compact( 'schoolYearPeriod', 'schoolYears' ) );


    }



    /**
     * Update the specified resource in storage.
     *
     * @param SchoolYearPeriodRequest|Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function update( SchoolYearPeriodRequest $request, $id )
    {


        if ( $this->schoolYearPeriodRepository->update(
            $id,
            $request->all() ) ) {


            session()->flash( 'success', 'La période à été modifiée avec succès !' );


        }

        else {


            session()->flash( 'failed', 'Une erreur est survenue lors de la modification.' );


        }

        return redirect( )->route($this->redirectTo);


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function destroy( $id )
    {


        if ( $this->schoolYearPeriodRepository->destroy( $id ) ) {


            session()->flash( 'success', 'La période à été supprimée avec succès !' );


        }

        else {


            session()->flash( 'failed', 'Une erreur est survenue lors de la suppression.' );


        }


        return redirect( )->route($this->redirectTo);


    }
}
