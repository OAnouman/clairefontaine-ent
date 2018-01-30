<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomTeacherRequest extends FormRequest
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


            'classroom_id' => 'required|integer',

            'subject_id' => 'required|integer',

            'teacher_id' => 'required|integer',


        ];
    }
}
