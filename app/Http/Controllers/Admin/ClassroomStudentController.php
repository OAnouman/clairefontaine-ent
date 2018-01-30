<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Classroom;
use App\Repositories\ClassroomRepository;
use App\SchoolYear;
use App\Student;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;


class ClassroomStudentController extends Controller
{


    protected $classroomRepository;


    public function __construct(ClassroomRepository $classroomRepository)
    {


        $this->middleware( ['auth', 'admin'] );

        $this->classroomRepository = $classroomRepository;


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        $students = null;

        // only classrooms for the last year

        $classrooms = $this->classroomRepository->withSchoolYear(SchoolYear::latest()->first())->get();

        // TODO : Find a way to get only students with no classroom for latest school year

        $allStudents = Student::orderBy('lastname', 'asc')->get();


        // if request make in ajax mode in order

        // to refresh student list for a given classroom

        // we only render student list section

        if (\request()->ajax())
        {


            if ($classToShow =  \request()->input('class_to_show'))
            {


                $students = $this->classroomRepository->getClassroomStudent($classToShow);


            }


            return view('classroom.list', compact('students','allStudents', 'classrooms'))
                       ->renderSections()['student-list'];

        }

        // otherwise we render all the view with

        // without any student in the list

        $students = [];

        return view('classroom.list', compact('students', 'allStudents', 'classrooms'));


    }



    /**
     * Store a newly created resource in storage.
     *
     * Exclusively in ajax mode
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return string
     */

    public function store(Request $request)
    {


        $message = null;

        $this->validate($request, [


            'student_id' => 'required|integer|exists:students,id',

            'classroom_id' => 'required|integer|exists:classrooms,id',

            'redouble' => 'boolean|nullable',


        ]);

        if ( $this->classroomRepository->attachStudent( $request->all() ) ) {


            $message = 'Elève ajouté !';


        }

        else {


            $message = 'une erreur est survenue lors de l\'ajout' ;


        }

        return $message;



    }



    /**
     * Remove the specified resource from storage.
     *
     * Ajax mode only
     *
     * @param  int $classroom
     *
     * @param int $student
     *
     * @return array
     */

    public function destroy(int $classroom, int $student )
    {


        if ( $this->classroomRepository->detachStudent( $classroom, $student ) ) {


            $message = 'Elève retiré !';


        }

        else {


            $message = 'Une erreur est survenue lors du retrait' ;


        }

        return [$message];


    }


    public function print (Classroom $classroom)
    {


        $pdf = PDF::loadView('classroom.print', compact('classroom') )
            ->setOrientation('landscape');

        return $pdf->download('Liste de la ' . $classroom->name . ' - ' . $classroom->schoolYear->name);


    }
}
