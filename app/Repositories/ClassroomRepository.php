<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 9/3/2017
 * Time: 8:51 AM
 */


namespace App\Repositories;


use App\Classroom;
use App\ClassroomTeacher;
use App\SchoolYear;
use App\Teacher;
use Illuminate\Database\QueryException;


class ClassroomRepository extends Repository
{


    protected $nbPerPage = 10;



    /**
     * @inheritdoc
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function all()
    {


        return Classroom::latest();


    }



    /**
     * Pagignate result query
     *
     * @param $query
     */

    public function scopePaginate( $query )
    {


        $query->paginate( $this->nbPerPage );


    }



    /**
     * Get all class of a given school year
     *
     * @param SchoolYear $schoolYear
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function getClassroomsOfYear(SchoolYear $schoolYear)
    {


        return $schoolYear->clasrooms();


    }



    /**
     * @inheritdoc
     *
     * @param array $data
     *
     * @return $this|\Illuminate\Database\Eloquent\Model
     */

    public function create( array $data )
    {


        try {


            return Classroom::create( $data );


        }
        catch ( QueryException $e )
        {


            return null;


        }


    }



    /**
     * @inheritdoc
     *
     * @param int $id
     *
     * @return bool|null
     */

    public function destroy( int $id )
    {


        // Retrieve classroom, check if it's

        // linked to teacher and students . If not we can delete it

        // Otherwise no

        if ( $classroom = Classroom::find( $id ) ) {


            if ( count( $classroom->students ) === 0 && count( $classroom->teachers ) === 0 ) {


                return $classroom->delete();


            }
            else {


                return false;


            }


        }

        return false;


    }



    /**
     * @inheritdoc
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */

    public function get( int $id )
    {


        return Classroom::find( $id );


    }



    /**
     * @inheritdoc
     *
     * @param int $id
     * @param array $data
     *
     * @return bool
     */

    public function update( int $id, array $data )
    {


        try
        {


            return Classroom::find( $id )
                            ->update(


                                $data


                            );


        }
        catch ( QueryException $e )
        {


            return null;


        }


    }



    /**
     * Get classroom id and name where
     *
     * according to a school year
     *
     * @param int $schoolYearId
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */

    public function getBySchoolYear(int $schoolYearId)
    {


        return Classroom::latest()->where('school_year_id', $schoolYearId)->get(['id', 'name']);


    }



    /**
     * Get all clssroom teacher pivot
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function allClassroomTeacher()
    {


        return ClassroomTeacher::paginate($this->nbPerPage);


    }




    /**
     * Link a teacher to a classroom
     *
     * @param $data
     *
     * @return bool
     *
     * @internal param int $classroomId
     * @internal param int $teacherId
     *
     */

    public function attachTeacher( $data )
    {


        try
        {


            Classroom::find( $data[ 'classroom_id' ] )

                     ->teachers()

                     ->attach( $data[ 'teacher_id' ],

                         [
                             'subject_id' => $data[ 'subject_id' ],

                         ] );

            return true;


        }
        catch ( QueryException $e )
        {


            return false;


        }


    }



    /**
     * Detach a given teacher
     *
     * @param int $classroom
     * @param int $teacher
     *
     * @return bool
     */

    public function detachTeacher(int $classroom, int $teacher, int $subject)
    {


        Classroom::find( $classroom )

             ->teachers()

             ->wherePivot('subject_id', $subject)

             ->detach();


        return true;


    }



    /**
     * Update classroom teacher link
     *
     * @param $data
     *
     * @return mixed
     */

    public function updateTeacher( $data )
    {


        try
        {


            return Classroom::has( 'teachers' )

                            ->where( 'id', $data[ 'classroom_id' ] )

                            ->first()

                            ->teachers()

                            ->where( 'id', $data[ 'teacher_id' ] )

                            ->first()

                            ->pivot->update( $data );


        }
        catch ( QueryException $e )
        {


            return null;


        }


    }



    /**
     * Get classroom teacher link
     *
     * @param $classroom
     * @param $teacher
     *
     * @return mixed
     */

    public function getClassroomTeacherPivot($classroom,$teacher)
    {


        return Classroom::has( 'teachers' )

                    ->where( 'id', $classroom )

                    ->first()

                    ->teachers()

                    ->where( 'id', $teacher )

                    ->first()->pivot->toArray();


    }



    /**
     * Get all students for a given
     *
     * classroom id
     *
     * @param int $id
     *
     * @return mixed
     */

    public function getClassroomStudent( int $id )
    {


        return Classroom::find($id)->students()->orderBy('lastname', 'asc')->get(   ) ;


    }



    /**
     * Link a student to a
     *
     * classroom
     *
     * @param array $data
     *
     * @return bool
     */

    public function attachStudent(array $data)
    {


        $classroom = Classroom::find( $data[ 'classroom_id' ] );

        try
        {


            $classroom->students()
                      ->attach( $data[ 'student_id' ],
                          [

                              'redouble' => $data[ 'redouble' ],

                              'school_year_id' => $classroom->schoolYear->id,

                          ] );

            return true;


        }
        catch ( QueryException $e )
        {


            return false;


        }



    }



    /**
     * Remove a student from a
     *
     * classroom
     *
     * @param int $classroomId
     *
     * @param int $studentId
     *
     * @return bool
     */

    public function detachStudent(int $classroomId , int $studentId)
    {


        Classroom::find($classroomId)->students()

                                     ->detach($studentId);


        return true;

    }



}