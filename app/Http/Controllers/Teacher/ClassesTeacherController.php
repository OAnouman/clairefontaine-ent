<?php

namespace App\Http\Controllers\Teacher;

use App\Classroom;
use App\Http\Controllers\Controller;
use App\Repositories\ClassroomRepository;
use App\Repositories\TeacherRepository;
use App\Teacher;
use Illuminate\Http\Request;

class ClassesTeacherController extends Controller
{


    protected $teacherRepository ;

    protected $classroomRepository;



    public function __construct(TeacherRepository $teacherRepository, ClassroomRepository $classroomRepository)
    {


        $this->middleware( ['auth', 'teacher'] );

        $this->teacherRepository = $teacherRepository ;

        $this->classroomRepository = $classroomRepository;


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        $teacher = \request()->user()->userable;

        $classrooms = $this->teacherRepository->classrooms($teacher);

        return view( 'admin_teacher.classroom.index', compact( 'classrooms' ) );


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show(Classroom $classroom)
    {


        $students = $this->classroomRepository->getClassroomStudent($classroom->id);

        return view( 'admin_teacher.classroom.show', compact( 'students', 'classroom' ) );


    }








}
