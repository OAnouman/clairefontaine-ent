<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ScholarshipRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScholarshipSettingsController extends Controller
{

    protected $scholarshipRepository;


    public function __construct(ScholarshipRepository $scholarshipRepository)
    {

        $this->scholarshipRepository = $scholarshipRepository;

        $this->middleware( ['auth', 'admin'] );

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $scholarships = $this->scholarshipRepository->allPaginate();

        return view('scholarship.index_settings', compact('scholarships'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
