<?php

namespace App\Http\Controllers\Parent;

use App\Classroom;
use App\SchoolYearPeriod;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{



    public function __construct()
    {


        $this->middleware(['auth', 'parent']);


    }


    public function index ()
    {

        $student = Auth::user()->userable;


        return view('admin_parent.index', compact('student', 'dash'));


    }



    /**
     * Get all subject for a classroom
     *
     * @param $classroom_id
     *
     * @return mixed
     */

    public function subjects( $classroom_id )
    {


        return Classroom::find($classroom_id)->level->subjects->toJson() ;


    }


    public function grades ($subject_id, $begin_date, $end_date, $classroom_id )
    {


        $student = Auth::user()->userable;

        return $student->getGrades( $subject_id, $begin_date, $end_date, $classroom_id );


    }



    /**
     * Get subject by the given id
     *
     * @param Classroom $classroom
     *
     * @return string
     *
     * @internal param int $subject_id
     *
     */

    public function getSubjects (Classroom $classroom)
    {


        return $classroom->level->subjects()->orderBy('name', 'asc')->get()->toJson() ;


    }



    /**
     * Get average for each subject for a given student
     *
     * @param Student $student
     *
     * @return mixed
     */

    public function profileOverview ( Student $student )
    {


        return $student->profileOverview()->toArray();


    }



    /**
     * Show specified resourec form storage
     *
     * @param Student $student
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show ( Student $student )
    {

        if(\request()->ajax())


            return view( 'admin_parent.show', compact( 'student' ) ) ->renderSections()['emergency-contact'];


        else


            return view('admin_parent.show', compact('student'));




    }



    /**
     * Get school year periods for specified classroom
     *
     * @param Classroom $classroom
     *
     * @return mixed
     */

    public function getPeriods ( Classroom $classroom)
    {


        return $classroom->getPeriods()->toJson();


    }



    /**
     * Get average for specified period and classroom
     *
     * @param Student $student
     * @param SchoolYearPeriod $schoolYearPeriod
     * @param Classroom $classroom
     *
     * @return float|null
     */

    public function average (Student $student ,  SchoolYearPeriod $schoolYearPeriod, Classroom $classroom)
    {


        $average = null;

        if ($classroom !== null )

            $average = $student->periodAverage( $schoolYearPeriod->id, $classroom->id );

        else

            $average = $student->periodAverage( $schoolYearPeriod->id );


        return $average;


    }



    /**
     * Get latest specified number of evaluations
     *
     * If $limit is null
     *
     * @param Student $student
     *
     * @param int $limit = 10
     *
     */

    public function evaluations (Student $student, int $limit = 10)
    {


        return $student->evaluations($limit)->toJson();


    }


}
