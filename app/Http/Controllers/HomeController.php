<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {


        $this->middleware('auth')->except('index');


    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {



        if(auth()->guest())
        {


            return view('auth.login');


        }

        switch (auth()->user()->account_type)
        {

            case 'personnel' :

            case 'administrateur':

                return view('admin.index');

                break;

            case 'eleve_parent':

                return redirect()->route('parent.dashboard');

                break;

            case 'professeur' :

                return view('admin_teacher.index');


        }


    }


}
