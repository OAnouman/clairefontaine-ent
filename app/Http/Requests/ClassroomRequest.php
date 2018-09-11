<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class ClassroomRequest extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {


        if ( $this->user()->account_type === 'administrateur' ||
            $this->user()->account_type === 'personnel' ) {


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

            'level_id' => 'required|string',

            'school_year_id' => 'required|integer',

            'teacher_id' => 'integer'


        ];


    }
}
