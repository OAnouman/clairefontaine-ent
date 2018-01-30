<?php

namespace App;


use Illuminate\Notifications\Notifiable;


class Grade extends Model
{

    use Notifiable;

    public function student()
    {



        return $this->belongsTo(Student::class);



    }



    public function evaluation ()
    {


        return $this->belongsTo(Evaluation::class);


    }



}
