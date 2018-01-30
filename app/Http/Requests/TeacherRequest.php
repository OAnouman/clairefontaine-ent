<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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


            'lastname' => 'required|min:2|string',

            'firstname' => 'required:min:2|string',

            'birth_date' => 'date|nullable',

            'email' => 'email|unique:teachers,email,' . $this->route('teacher'),

            'adress' => 'string|nullable',

            'mobile' => 'string|nullable',

            'other_phoone' => 'string|nullable',

            'hire_date' => 'date|nullable',

            'leaving_date' => 'date|nullable',

            'password' => 'sometimes|min:8|confirmed|nullable'


        ];
    }
}
