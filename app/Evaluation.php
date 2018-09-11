<?php

namespace App;


use Carbon\Carbon;


class Evaluation extends Model
{
    protected $table = 'evaluations';

    public function subject()
    {


        return $this->belongsTo(Subject::class);


    }


    public function schoolYearPeriod ()
    {


        return $this->belongsTo(SchoolYearPeriod::class);


    }

    public function classroom ()
    {


        return $this->belongsTo(Classroom::class);


    }

    public function getEvaluationDateAttribute( $value )
    {


        if(!$value)
            return '';

            return Carbon::createFromFormat( 'Y-m-d', $value )
                     ->format('d-m-Y');


    }

    public function topStudents ()
    {


        $bestMark = $this->grades()->max('value');

        return $this->grades->where('value', $bestMark)->pluck('student_id');


    }

    public function grades()
    {


        return $this->hasMany(Grade::class);


    }

    public function worstStudents ()
    {


        $worstMark = $this->grades()->min('value');

        return $this->grades->where('value', $worstMark)->pluck('student_id');


    }

}
