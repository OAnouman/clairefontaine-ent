<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 9/2/2017
 * Time: 7:08 PM
 */


namespace App\Repositories;


use App\Http\Requests\LevelRequest;
use App\Level;
use App\Subject;
use Illuminate\Database\QueryException;


class LevelRepository extends Repository
{


    /**
     * @var int
     *
     * Number of record par page.
     *
     * Used for pagination
     */

    protected $nbPerPage = 20;



    /**
     * @inheritdoc
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function all()
    {


        return Level::orderBy( 'name', 'asc' );


    }



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


            return Level::create( $data );


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


        // Retrieve level, check if it has

        // linked classrooms . If not we can delete it

        // Otherwise no

        if ( $level = Level::find( $id ) ) {


            if ( count( $level->classrooms ) > 0 ) {


                return false;


            }
            else {


                return $level->delete();


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


        return Level::find( $id );


    }



    /**
     * @inheritdoc
     *
     * @param int $id
     *
     * @param array $data
     *
     * @return bool
     */

    public function update( int $id, array $data )
    {


        try
        {


            return Level::find( $id )
                        ->update(


                            $data


                        );


        }
        catch ( QueryException $e )
        {


            return false;


        }


    }



    public function getLevelsBy( string $academicGrade )
    {


        return Level::where( 'academic_grade', '=', $academicGrade )

                    ->get();


    }



    /**
     * Get level by its name
     *
     * @param $name
     *
     * @return mixed
     */

    public function getByName( $name )
    {


        return Level::where( 'name', '=', $name )

                    ->first();


    }



    /**
     * Link a subject
     *
     * @param $data
     *
     * @return bool
     */

    public function attachSubject( $data )
    {


        try
        {


            Level::find( $data[ 'level_id' ] )

                 ->subjects()

                 ->attach( $data[ 'subject_id' ],
                     [ 'coefficient' => $data[ 'coefficient' ] ] );

            return true;


        }
        catch ( QueryException $e )
        {


            return false;


        }


    }



    /**
     * Fetch all levels, all their subject
     *
     * and return an array of ['level.name' => 'subject.name']
     *
     * @return array
     */

    public function allLevelSubject()
    {


        return Level::has( 'subjects' )

                    ->get();


    }



    /**
     * Get the links between level
     * and classroom
     *
     * @param int $levelId
     * @param int $subjectId
     *
     * @return mixed
     */

    public function getLevelSubjectPivot( int $levelId, int $subjectId )
    {


        return Level::has( 'subjects' )

                    ->where( 'id', $levelId )

                    ->first()

                    ->subjects()

                    ->where( 'subject_id', $subjectId )

                    ->first()->pivot;


    }



    /**
     * Remove link between level an subject
     *
     * @param int $level
     * @param int $subject
     *
     * @return bool
     */

    public function detachSubject(int $level , int $subject)
    {


        Level::find( $level )

             ->subjects()

             ->detach( $subject );



        return true;


    }


    public function updateLevelSubject( $data )
    {


        try
        {


            return Level::has( 'subjects' )

                        ->where( 'id', $data[ 'level_id' ] )

                        ->first()

                        ->subjects()

                        ->where( 'subject_id', $data[ 'subject_id' ] )

                        ->first()

                        ->pivot->update( $data );


        }
        catch ( QueryException $e )
        {


            return false;


        }





    }

}