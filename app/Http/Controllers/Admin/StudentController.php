<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Classroom;
use App\Http\Requests\StudentRequest;
use App\Repositories\StudentRepository;
use App\SchoolYear;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;


class StudentController extends Controller
{


    protected $redirectTo = 'student.index';

    protected $studentRepository;


    public function __construct(StudentRepository $studentRepository)
    {


        $this->middleware(['auth', 'admin']);

        $this->studentRepository = $studentRepository;


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $students = null;

        // If we should display only removed students

        $removedOnly = false;

        if (\request()->input('removed_only'))

            $removedOnly = true;


        if ($search = \request()->input('search')) {


            $students = $this->studentRepository->match($search, $removedOnly)->paginate();


        } else {


            $students = $this->studentRepository->allPaginate($removedOnly);


        }


        return view('student.index', compact('students'));


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        $classrooms = null;
        if (SchoolYear::all()->count() > 0) {
            $classrooms = Classroom::where('school_year_id', SchoolYear::latest()->first()->id);
        } else {
            $classrooms = collect();
        }

        return view('student.create', compact('classrooms'));


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(StudentRequest $request)
    {


        /*
       * Save and flash message to session
       */

        if ($this->studentRepository->create($request->all())) {


            session()->flash('success', 'L\' élève à été crée avec succès !');


        } else {


            session()->flash('failed', 'une erreur est survenue lors de l\'enregistrement.');


        }


        return redirect()->route($this->redirectTo);


    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {


        $student = $this->studentRepository->get($id);


        if (\request()->ajax())


            return view('student.show', compact('student'))->renderSections()['emergency-contact'];


        else


            return view('student.show', compact('student'));


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {


        $student = $this->studentRepository->get($id);

        return view('student.edit', compact('student'));


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {


        if ($this->studentRepository->update(
            $id,
            $request->all())) {


            session()->flash('success', 'L\' élève à été modifié avec succès !');


        } else {


            session()->flash('failed', 'Une erreur est survenue lors de la modification.');


        }

        return redirect()->route($this->redirectTo);


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {


        if ($this->studentRepository->destroy($id)) {


            session()->flash('success', 'L\' élève à été supprimé avec succès !');


        } else {


            session()->flash('failed', 'Une erreur est survenue lors de la suppression.');


        }


        return redirect()->route($this->redirectTo);


    }

    public function print($id)
    {


        $student = $this->studentRepository->get($id);

        $pdf = PDF::loadView('student.print', compact('student'));

        return $pdf->download('Profil de ' . $student->firstname . ' ' . $student->lastname);


    }


    public function import()
    {


        return view('student.import');


    }


    public function importCsv(Request $request)
    {


        $this->validate($request, [

            'csv' => 'required|mimes:csv,txt'

        ]);


        if ($this->studentRepository->importCsv($request->all()))


            session()->flash('success', 'Importation effectuée avec succès !');


        else


            session()->flash('failed', 'Une erreur est survenue lors du processus d\'importation !');


        return redirect()->route($this->redirectTo);


    }


}
