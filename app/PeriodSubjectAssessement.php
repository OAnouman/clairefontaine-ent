<?php

namespace App;


class PeriodSubjectAssessement extends Model
{



    public function schoolYearPeriod()
    {


        return $this->belongsTo(SchoolYearPeriod::class);


    }


    public function student()
    {


        return $this->belongsTo(Student::class);


    }


    public function subject()
    {


        return $this->belongsTo(Subject::class);


    }



}
