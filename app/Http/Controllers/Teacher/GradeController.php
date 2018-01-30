<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Repositories\GradeRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GradeController extends Controller
{



    protected $gradeRepository ;


    public function __construct(GradeRepository $gradeRepository)
    {


        $this->gradeRepository = $gradeRepository;


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
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
     *
     * @return Model
     */

    public function store(Request $request)
    {


        $this->validate($request , [


            'value' => 'required|numeric|min:0' ,

            'teacher_assessment' => 'string|nullable',

            'student_id' => 'integer|required|exists:students,id',

            'evaluation_id' => 'integer|required|exists:evaluations,id',


        ]);

        if ( $grade = $this->gradeRepository->create( $request->all() ) )
        {


            return $grade->toJson();


        }

        return 'Une erreur est survenue lors de l\'enregistrement.';



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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return string
     */

    public function update(Request $request, $id)
    {


        $this->validate($request , [


            'value' => 'required|numeric|min:0' ,

            'teacher_assessment' => 'string|nullable',

            'student_id' => 'integer|required|exists:students,id',

            'evaluation_id' => 'integer|required|exists:evaluations,id',

            'id' => 'integer|required|exists:grades,id'


        ]);

        if ( $this->gradeRepository->update( $id, $request->all() ) )
        {


            return 'Enregistrée !';


        }

        return 'Une erreur est survenue lors de la modification.';


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function destroy($id)
    {
        //
    }


}
