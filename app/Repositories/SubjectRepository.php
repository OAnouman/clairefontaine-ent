<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 9/6/2017
 * Time: 10:29 AM
 */


namespace App\Repositories;


use App\Subject;
use Illuminate\Database\QueryException;


class SubjectRepository extends Repository
{


    /**
     * Pagination step
     *
     * @var int
     */
    protected $nbPerPage = 20;



    /**
     * @inheritdoc
     *
     * @return mixed
     */

    public function all()
    {


        return Subject::orderBy( 'name', 'asc' );


    }



    /**
     * Paginate query
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


            return Subject::create( $data );


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


        if ( $subject = Subject::find( $id ) ) {


            if ( count( $subject->levels ) > 0 ) {


                return false;


            }

            else {


                return $subject->delete();


            }


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


        return Subject::find( $id );


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


            return Subject::find( $id )

                          ->update( $data );


        }
        catch ( Exception $e )
        {


            return false;


        }


    }




}