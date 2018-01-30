<?php

namespace App;


class PaperRequest extends Model
{




    public function student()
    {


        return $this->belongsTo(Student::class);


    }



}
