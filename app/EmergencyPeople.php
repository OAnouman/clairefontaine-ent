<?php

namespace App;



class EmergencyPeople extends Model
{



    public function students()
    {


        return $this->belongsTo(Student::class);


    }



}
