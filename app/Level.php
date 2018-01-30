<?php

namespace App;


class Level extends Model
{



    public function subjects()
    {


        return $this->belongsToMany(Subject::class)->withPivot('coefficient');


    }


    public function classrooms()
    {


        return $this->hasMany(Classroom::class);


    }



}
