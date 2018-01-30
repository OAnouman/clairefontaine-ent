<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 9/4/2017
 * Time: 5:05 PM
 */


namespace App\Repositories;


use App\SchoolYear;
use App\Teacher;
use Illuminate\Database\QueryException;


class TeacherRepository extends Repository
{


    /**
     * Number of teacher per page
     *
     * @var int
     */

    protected $nbPerPage = 20;



    /**
     * @inheritdoc
     *
     * @return \Illuminate\Database\Query\Builder|static
     */

    public function all()
    {


        return Teacher::orderBy('lastname', 'asc');


    }



    /**
     * Paginate query result
     *
     * @param $query
     */

    public function allPaginate(  )
    {


        return $this->all()->paginate( $this->nbPerPage );


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


        try
        {


            return Teacher::create( $data );


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


        // Retrieve teacher and delete it.

        if ( $teacher = Teacher::find( $id ) ) {


            return $teacher->delete();


        }


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


        return Teacher::find( $id );


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


            return Teacher::find( $id )

                          ->update( $data );


        }
        catch ( Exception $e )
        {


            return false;


        }




    }


    public function classrooms (Teacher $teacher)
    {


        $currentSchoolYear  = SchoolYear::latest()->first();

        return Teacher::find($teacher->id)->classrooms()

                                          ->where('school_year_id', $currentSchoolYear->id)

                                          ->orderBy('name', 'asc')

                                          ->get();


    }




}