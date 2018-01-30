<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\EmergencyPeople;
use Illuminate\Http\Request;

class EmergencyPeopleController extends Controller
{


    public function __construct()
    {


        $this->middleware( ['auth', 'admin'] );


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return string
     */

    public function store(Request $request)
    {


        $this->validate( $request, [

            'student_id' => 'required|integer|exists:students,id',

            'name' => 'string|required',

            'link' => 'string',

            'phones' => 'string|required'

        ]);


        $json = EmergencyPeople::create( $request->all() )->toJson();

        return $json;


    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return string
     */

    public function destroy(int $id)
    {


        if ( EmergencyPeople::find($id)->delete() )
        {


            return 'OK';


        }


    }


}


