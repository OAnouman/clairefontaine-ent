<?php

namespace App;


class PeriodAssessement extends Model
{


    public function student()
    {


        return $this->belongsTo(Student::class);


    }


    public function schoolYearPeriod()
    {


        return $this->belongsTo(SchoolYearPeriod::class);


    }

}
