<?php

namespace App\Http\Controllers\Parent;

use App\Classroom;
use App\SchoolYearPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvaluationController extends Controller
{


    protected $redirectTo = '';



    public function __construct()
    {


        $this->middleware(['auth', 'parent']);


    }



    /**
     * Show resource from storage
     *
     * @param $school_year_id
     * @param $classroom_id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show ( int $school_year_id , int $classroom_id )
    {

        $grades = null;

        $student = auth()->user()->userable ;

        $schoolYearPeriod = SchoolYearPeriod::find($school_year_id);

        $subjects = Classroom::find($classroom_id)->level->subjects ;

        if( $subject_id = \request()->input('subject_id'))
        {


            $grades = $schoolYearPeriod->getStudentGrades($classroom_id, $student->id, $subject_id)

                                       ->paginate();


        }
        else{


            $grades = $schoolYearPeriod->getStudentGrades($classroom_id, $student->id)

                                       ->paginate();

        }

        return view ('admin_parent.evaluation.show',
            compact('student', 'schoolYearPeriod', 'grades', 'subjects'));


    }




}
