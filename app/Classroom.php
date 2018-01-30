<?php

namespace App;


class Classroom extends Model
{



    public function teachers()
    {


        return $this->belongsToMany(Teacher::class)->withPivot('subject_id');


    }



    public function students()
    {


        return $this->belongsToMany(Student::class)->withPivot('school_year_id', 'redouble');


    }



    public function level()
    {


        return $this->belongsTo(Level::class);


    }



    public function schoolYear()
    {


        return $this->belongsTo(SchoolYear::class);



    }



    public function teacher()
    {


        return $this->belongsTo(Teacher::class);


    }


    public function evaluations ()
    {


        return $this->hasMany(Evaluation::class);


    }


    public function getPeriods ()
    {


        return $this->schoolYear->schoolYearPeriods ;


    }



}
