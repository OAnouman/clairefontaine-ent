<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolYearPeriodRequest extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     *
     */

    public function authorize()
    {



        if($this->user()->account_type === 'administrateur' ||
            $this->user()->account_type === 'personnel')
        {


            return true;


        }


        return false;


    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {


        return [


            'name' => 'required',

            'school_year_id' => 'required',

            'index' =>  'required|integer|max:3'


        ];


    }
}
