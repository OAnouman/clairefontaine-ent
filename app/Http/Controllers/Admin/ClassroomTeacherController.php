<?php

namespace App\Http\Controllers\Admin;


use App\ClassroomTeacher;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomTeacherRequest;
use App\Repositories\ClassroomRepository;
use App\SchoolYear;
use App\Subject;
use App\Teacher;


class ClassroomTeacherController extends Controller
{


    protected $classroomRepository;

    protected $redirectTo = 'classroom_teacher.index';



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

        $classroomTeachers = $this->classroomRepository->allClassroomTeacher();

        return view('classroom_teacher.index', compact('classroomTeachers'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {


        $teachers = Teacher::all();

        $classrooms = $this->classroomRepository->getBySchoolYear(SchoolYear::latest()->first()->id);

        $subjects = Subject::orderBy('name', 'asc')->get();

        return view('classroom_teacher.create', compact('teachers',
            'classrooms', 'subjects'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(ClassroomTeacherRequest $request)
    {


        if ( $this->classroomRepository->attachTeacher( $request->all() ) ) {


            session()->flash( 'success', 'Liaison créée avec succès !' );


        }

        else {


            session()->flash( 'failed', 'une erreur est survenue lors de l\'enregistrement.' );


        }


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
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(int $classroom, int $teacher)
    {


        $teachers = Teacher::all();

        $schoolYears = SchoolYear::latest()->get();

        $classroomTeacher = new ClassroomTeacher(
            $this->classroomRepository->getClassroomTeacherPivot($classroom, $teacher)
        );

        $classrooms = $this->classroomRepository->getBySchoolYear(SchoolYear::latest()->first()->id);

        $subjects = Subject::orderBy('name', 'asc')->get();

        return view('classroom_teacher.edit', compact('teachers',
            'classrooms','schoolYears', 'classroomTeacher', 'subjects'));


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(ClassroomTeacherRequest $request)
    {


        if ( $this->classroomRepository->updateTeacher( $request->all() ) ) {


            session()->flash( 'success', 'Liaison modifiée avec succès !' );


        }

        else {


            session()->flash( 'failed', 'Une erreur est survenue lors de la modification.' );


        }

        return redirect( )->route($this->redirectTo);


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy( $classroom, $teacher, $subject)
    {


        if ( $this->classroomRepository->detachTeacher( $classroom, $teacher , $subject) ) {


            session()->flash( 'success', 'Liaison supprimée avec succès !' );


        }

        else {


            session()->flash( 'failed', 'Une erreur est survenue lors de la suppression.' );


        }


        return redirect( )->route($this->redirectTo);

    }
}
