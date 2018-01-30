<?php

namespace App;



class DelayAbsence extends Model
{



    public function student()
    {


        return $this->belongsTo(Student::class);


    }


}
