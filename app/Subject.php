<?php

namespace App;


/**
 * Class Subject
 * @package App
 *
 * Author Martial Anouman
 *
 * Represents a subject teach in the school
 *
 * ex: Maths, Français ...
 */

class Subject extends Model
{



    public function levels()
    {


        return $this->belongsToMany(Level::class)->withPivot('coefficient');


    }


    public function evaluations()
    {


        return $this->hasMany(Evaluation::class);


    }


    public function periodSubjectAssessments()
    {


        return $this->hasMany(PeriodAssessement::class);


    }


    public function topStudents ( $classroom_id)
    {


        $evaluations = $this->evaluations()->where('classroom_id', $classroom_id)->get();

        $grades = collect();

        foreach ($evaluations as $evaluation)
        {


            $grades = $grades->merge( $evaluation->grades );


        }

        $grades = $grades->groupBy('student_id');

        $rankings = [];

        foreach ( $grades as $studentGrades )
        {


            $rankings[$studentGrades->first()->student_id] = $studentGrades->avg('value')   ;


        }

        return $rankings;


    }

    public function bestStudent ( $classroom_id )
    {

        $student = null;

        $rankings = $this->topStudents($classroom_id);

        if ( count($rankings) > 0 )
        {


            $student = Student::find( array_search( max( $rankings ), $rankings ) );

            return  [ $student->lastname . ' ' . $student->firstname => $rankings[$student->id] ] ;


        }

        return [];


    }

    public function worstStudent ( $classroom_id )
    {


        $student =  null;

        $rankings = $this->topStudents($classroom_id);

        if ( count($rankings) > 0 )
        {


            $student = Student::find( array_search( min( $rankings ), $rankings ) );

            return [ $student->lastname . ' ' . $student->firstname => $rankings[$student->id] ] ;


        }

        return [];

    }


}
