<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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


            'reg_number' => 'required|unique:students,reg_number,' . $this->route('student'),

            'firstname' => 'required|string',

            'lastname' => 'required|string',

            'birth_date' => 'date|required|before:'. \Carbon\Carbon::now(),

            'birth_place' => 'required|string',

            'nationalities' => 'required',

            'origin_school' => 'string|nullable',

            'father_name' => 'string|nullable',

            'father_job' => 'string|nullable',

            'father_phones' => 'string|nullable',

            'mother_name' => 'string|nullable',

            'mother_job' => 'string|nullable',

            'mother_phones' => 'string|nullable',

            'living_place' => 'string|nullable',

            'address' => 'string|nullable',

            'emails' => 'string|nullable',

            'resp_schooling' => 'string|nullable',

            'guardian_name' => 'string|nullable',

            'picture' => 'image|max:1024|mimes:jpeg,png|nullable',

            'sex' => 'required',

            'subscription_date' => 'date|before_or_equal:'. \Carbon\Carbon::now(),

            'is_removed' => 'boolean|nullable',

            'cned_id' => 'string|nullable',

            'cned_password' => 'string|nullable',

            'second_living_language' => 'string|nullable',

            'gave_id_picture' => 'boolean|nullable',

            'gave_birth_act' => 'boolean|nullable',

            'gave_vaccination_notebook' => 'boolean|nullable',

            'gave_cancellation_certificate' => 'boolean|nullable',

            'is_image_right_allowed' => 'boolean|nullable',

            'is_special_program' => 'boolean|nullable',

            'gave_gradebook' => 'boolean|nullable',


        ];


    }
}


