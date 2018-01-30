<?php

namespace App;


use Illuminate\Support\Facades\DB;


/**
 * Class SchoolYearPeriodController
 * @package App
 *
 * Author Martial Anouman
 *
 * Represents an academic period
 *
 * like trimester, semester,...
 *
 */

class SchoolYearPeriod extends Model
{


    protected $fillable = [


        'name',

        'school_year_id',

        'index',


    ];

    public function schoolYear()
    {


        return $this->belongsTo(SchoolYear::class);


    }


    public function evaluations()
    {


        return $this->hasMany(Evaluation::class);


    }



    public function periodSubjectAssessments()
    {


        return $this->hasMany(PeriodSubjectAssessement::class);


    }



    public function periodAssessments()
    {


        return $this->hasMany(PeriodAssessement::class);


    }



    /**
     * Get student grades for a given period
     *
     * @param int $classroom_id
     * @param int $student_id
     * @param null $subject_id
     *
     * @return
     */

    public function getStudentGrades ( int $classroom_id, int $student_id, $subject_id = null )
    {

        $grades = null;


        if ( $subject_id === null )
        {


            $evaluations = $this->evaluations()

                                ->where( 'school_year_period_id', $this->id )

                                ->where( 'classroom_id', $classroom_id )

                                ->pluck( 'id' );


            $grades =  DB::table( 'grades' )

                        ->whereIn( 'evaluation_id', $evaluations )

                        ->where( 'student_id', $student_id )

                        ->join( 'evaluations', 'grades.evaluation_id', 'evaluations.id' )

                        ->join( 'subjects', 'evaluations.subject_id', 'subjects.id' )

                        ->orderBy( 'evaluation_date', 'asc' )

                        ->select( 'grades.value', 'grades.teacher_assessment as comments',
                            'evaluations.evaluation_date', 'subjects.name as subject' );


        }
        else
        {


            $evaluations = $this->evaluations()

                                ->where( 'school_year_period_id', $this->id )

                                ->where( 'classroom_id', $classroom_id )

                                ->where('subject_id', $subject_id)

                                ->pluck( 'id' );


            $grades = DB::table( 'grades' )

                        ->whereIn( 'evaluation_id', $evaluations )

                        ->where( 'student_id', $student_id )

                        ->join( 'evaluations', 'grades.evaluation_id', 'evaluations.id' )

                        ->join( 'subjects', 'evaluations.subject_id', 'subjects.id' )

                        ->orderBy( 'evaluation_date', 'asc' )

                        ->select( 'grades.value', 'grades.teacher_assessment as comments',
                            'evaluations.evaluation_date', 'subjects.name as subject' );


        }


        return $grades;


    }


    public function scopePaginate( $query )
    {


        return $query->paginate(20);


    }


}
