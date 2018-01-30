<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {


        if ( $this->user()->account_type === 'professeur') {


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


            'evaluation_date' => 'date|required',

            'comment' => 'string|nullable',

            'classroom_id' => 'integer|required|exists:classrooms,id',

            'school_year_period_id' => 'required|integer|exists:school_year_periods,id',

            'subject_id' => 'integer|required|integer|exists:subjects,id',

            'coefficient' => 'integer|min:1|required'


        ];
    }
}
