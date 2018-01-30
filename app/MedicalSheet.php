<?php

namespace App;


class MedicalSheet extends Model
{



    public function student()
    {


        return $this->belongsTo(Student::class);


    }



}
