<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;


/**
 * Class Student
 * @package App
 *
 * Author Martial Anouman
 *
 * Represent a student, purpil
 *
 */

class Student extends Model
{

    use Notifiable;


    public function getBirthDateAttribute($value)
    {


        if(!$value)
            return '';

        return Carbon::createFromFormat( 'Y-m-d', $value )
                     ->format('d-m-Y');


    }



    public function getSubscriptionDateAttribute($value)
    {


        if(!$value)
            return '';

        return Carbon::createFromFormat( 'Y-m-d', $value )
                     ->format('d-m-Y');



    }



    public function delayAbsences()
    {


        return $this->hasMany(DelayAbsence::class);


    }



    public function schoolFeature()
    {


        return $this->hasMany(SchoolFeature::class);


    }


    public function emergencyPeople()
    {


        return $this->hasMany(EmergencyPeople::class);


    }



    public function medicalSheet()
    {


        return $this->hasOne(MedicalSheet::class);


    }



    public function periodSubjectAssessments()
    {


        return $this->hasMany(PeriodSubjectAssessement::class);


    }



    public function grades()
    {


        return $this->hasMany(Grade::class);


    }



    public function periodAssessments()
    {


        return $this->hasMany(PeriodAssessement::class);


    }



    public function classrooms()
    {


        return $this->belongsToMany(Classroom::class)->withPivot('school_year_id', 'redouble');


    }



    public function schoolYearPeriod()
    {


        return $this->belongsTo(SchoolYearPeriod::class);


    }






    public function getFirstFatherNumber()
    {


        $numbers = explode(',',$this->father_phones);

        return reset($numbers);


    }


    public function getFirstMotherNumber()
    {


        $numbers = explode(',',$this->mother_phones);

        return reset($numbers);


    }


    public function user()
    {


        return $this->morphOne( User::class, 'userable' );


    }



    /**
     * Get student grades
     *
     * @param int $subject_id
     * @param $beginDate
     * @param $endDate
     * @param int|null $classroomId
     *
     * @return Grade[]
     */

    public function getGrades ( int $subject_id, $beginDate, $endDate, int $classroomId = null)
    {


        $classroomId = ( $classroomId === null ? $this->classrooms->first()->id : $classroomId ) ;

        $evaluations = $this->classrooms()->where('classroom_id', $classroomId )

                                          ->first()->evaluations()

                                                   ->where('subject_id', $subject_id)

                                                   ->whereBetween('evaluation_date', array($beginDate, $endDate))

                                                   ->pluck('id');


        $grades = DB::table('grades')->whereIn('evaluation_id', $evaluations)

                       ->where('student_id', $this->id)

                        ->join('evaluations', 'grades.evaluation_id', 'evaluations.id')

                        ->join( 'subjects', 'evaluations.subject_id', 'subjects.id' )

                        ->orderBy('evaluation_date', 'asc')

                        ->selectRaw("grades.value as grade, grades.teacher_assessment as comments,
                            DATE_FORMAT( evaluations.evaluation_date, '%d-%m-%y' ) as date, subjects.name as subject")

                        ->get();


        return $grades;


    }


    /**
     * Get average for a period
     *
     * Set $classroom_id if you want average
     *
     * for a specific previous classroom
     *
     * @param int $school_year_period_id
     *
     * @param null $classroom_id
     *
     * @return $avg. Average for the period
     *
     */

    public function periodAverage ( int $school_year_period_id , $classroom_id = null)
    {


        if ($classroom_id === null)

            $classroom_id = $this->classrooms()->latest()->first()->id;

        $avg = SchoolYearPeriod::find($school_year_period_id)->getStudentGrades($classroom_id, $this->id )

                               ->get()

                                ->avg('value');


        return round($avg, 2);


    }



    /**
     * Get n number of latest evaluation with grade
     *
     * @param int $limit
     *
     * @return mixed
     *
     */

    public function evaluations ( int $limit )
    {


        $evaluations = $this->classrooms()->latest()

                                  ->first()

                                  ->evaluations()

                                  ->latest()

                                  ->take($limit)

                                  ->pluck('id');

        $grades = DB::table('grades')->whereIn('evaluation_id', $evaluations)

                       ->where('student_id', $this->id)

                       ->join('evaluations', 'grades.evaluation_id', 'evaluations.id')

                       ->join('subjects', 'evaluations.subject_id', 'subjects.id')

                       ->selectRaw("DATE_FORMAT(evaluations.evaluation_date, '%d-%m-%y' ) as date, subjects.name as subject, 
                                grades.value as grade, grades.teacher_assessment as comments" )

                       ->get();

        return $grades;


    }


    public function profileOverview ()
    {


        $classroomId = $this->classrooms->first()->id ;

        $evaluations = $this->classrooms()->where('classroom_id', $classroomId )

                            ->first()->evaluations()

                            ->pluck('id');


        $averages = DB::table( 'grades' )->whereIn('evaluation_id', $evaluations)

                    ->where( 'student_id', $this->id )

                    ->join( 'evaluations', 'grades.evaluation_id', 'evaluations.id' )

                    ->join( 'subjects', 'evaluations.subject_id', 'subjects.id' )

                    ->select('subjects.name', DB::raw('ROUND(AVG(value), 2) as avg'))

                    ->groupBy( 'subjects.name' )

//                    ->orderBy('subjects.name')

                    ->get();

        $subjectsWithNoGrades = Classroom::find($classroomId)->level->subjects()->whereDoesntHave('evaluations')

                                                     ->pluck('name');


        foreach ($subjectsWithNoGrades as $subjectsWithNoGrade)
        {


            $averages->push( [

                'name' => $subjectsWithNoGrade,

                'avg' => 0,

            ]);


        }



        return $averages->sortBy('name');


    }


    /**
     * Get all message threads where
     *
     * student (parent) is involved in
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */

    public function messageThreads()
    {


        return MessageThread::where('originator', $this->user->id)

                            ->orWhere('recipient', $this->user->id)

                            ->orderBy('updated_at', 'desc')

                            ->get();


    }

    /**
     * Get unseen messages count
     *
     * @return int
     */

    public function unreadMessages ()
    {


        return Message::where('recipient', $this->user->id)

                      ->where('seen', false)

                      ->count();


    }

    public function teachers ()
    {


        return $this->classrooms()->latest()

                           ->first()

                           ->teachers()

                           ->orderBy('lastname')

                           ->get();


    }


    public function currentClassroom()
    {


        return $this->classrooms()->latest()->first();


    }

    public function fullName ()
    {


        return strtoupper($this->lastmname )  . ' ' . $this->firstname ;


    }

}
