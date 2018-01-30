<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolYearRequest;
use App\Repositories\SchoolYearRepository;


class SchoolYearController extends Controller
{

    protected $schoolYearRepository;

    protected $redirectTo = 'school_year.index';


    public function __construct(SchoolYearRepository $schoolYearRepository)
    {



        $this->middleware( ['auth', 'admin'] );

        $this->schoolYearRepository = $schoolYearRepository;


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        $schoolYears = $this->schoolYearRepository->allPaginate();



        return view('school_year.index', compact('schoolYears'));


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {


        return view('school_year.create');


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(SchoolYearRequest $request)
    {

        //Create year

        if( $schoolYear =  $this->schoolYearRepository->create( $request->all() ) )
        {


            //Flash success message in session

            $request->session()->flash('success', 'L\'année scolaire à été créée avec succès !');


        }

        else
        {


            $request->session()->flash('failed', 'Une erreur est survenue lors de l\'enregistrement.');


        }



        //Redirect to school year index

        return redirect( )->route($this->redirectTo);


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {




    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {


        $schoolYear = $this->schoolYearRepository->get($id);

        return view('school_year.edit', compact('schoolYear'));


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(SchoolYearRequest $request, $id)
    {



        if( $this->schoolYearRepository->update(
            $id,
            $request->all()) )
        {


            session()->flash('success', 'L\'année à été modifiée avec succès !');


        }

        else
        {


            session()->flash('failed', 'Une erreur est survenue lors de la modification.');


        }


        return redirect( )->route($this->redirectTo);


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {


        if( $this->schoolYearRepository->destroy($id))
        {


            session()->flash('success', 'L\'année à été supprimée avec succès !');


        }

        else
        {


            session()->flash('failed', 'Une erreur est survenue lors de la suppression.');


        }


        return redirect( )->route($this->redirectTo);


    }
}
