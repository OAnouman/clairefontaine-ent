<?php


namespace App;


use Carbon\Carbon;
use Illuminate\Database\Query\Builder;


/**
 * Class Teacher
 *
 * @package App
 *
 * Author Martial Anouman
 *
 * Represent a teacher in the school
 */

class Teacher extends Model
{


    protected $fillable = [


        'lastname',

        'firstname',

        'birth_date',

        'email',

        'adress',

        'mobile',

        'other_phoone',

        'hire_date',

        'leaving_date',


    ];



    public function getBirthDateAttribute( $value )
    {


        if(!$value)
            return '';

        return Carbon::createFromFormat( 'Y-m-d', $value )
                     ->format('d-m-Y');


    }



    public function getHireDateAttribute( $value )
    {


        if(!$value)
            return '';

        return Carbon::createFromFormat( 'Y-m-d', $value )
                     ->format('d-m-Y');


    }



    public function getLeavingDateAttribute( $value )
    {


        if(!$value)
            return '';

        return Carbon::createFromFormat( 'Y-m-d', $value )
                     ->format('d-m-Y');


    }



    public function classrooms()
    {


        return $this->belongsToMany( Classroom::class )->withPivot('subject_id');


    }



    public function user()
    {


        return $this->morphOne( User::class, 'userable' );


    }


    /**
     * Get all teacher sugjects
     *
     * for a given classroom
     *
     * @param $query
     *
     * @param int $classroom_id
     */

    public function subjects( int $classroom_id )
    {


        return $this->classrooms()->where('classroom_id', $classroom_id);


    }


    public function scopeCount( $query )
    {


        return $query->count();


    }


    public function students ()
    {


        $currentSchoolYear = SchoolYear::latest()->first();

        $classrooms = $this->classrooms()->where('school_year_id', $currentSchoolYear->id)

                                         ->distinct()->get();

        $students = collect();

        foreach ($classrooms as $classroom)
        {


            $students = $students->merge($classroom->students);


        }

        return $students->sortBy('lastname')->unique('reg_number');


    }



    /**
     * Get all message threads where
     *
     * teacher is involved in
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


    public function unreadMessages ()
    {


        return Message::where('recipient', $this->user->id)

                      ->where('seen', false)

                      ->count();


    }


    public function fullName ()
    {


        return strtoupper($this->lastname )  . ' ' . $this->firstname ;


    }



}
