<?php

namespace App;


class ClassroomTeacher extends Model
{


    protected $table = 'classroom_teacher';



    public function teacher()
    {


        return $this->belongsTo(Teacher::class);


    }


    public function classroom()
    {


        return $this->belongsTo(Classroom::class);


    }

    public function subject()
    {


        return $this->belongsTo(Subject::class);


    }

}
