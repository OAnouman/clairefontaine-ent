<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 9/26/2017
 * Time: 1:50 PM
 */


namespace App\Repositories;


use App\Grade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;


class GradeRepository extends Repository
{


    /**
     * @return mixed
     *
     * Get all records
     */

    public function all()
    {
        // TODO: Implement all() method.
    }



    /**
     * @inheritdoc
     *
     * @param array $data
     *
     * @return mixed
     *
     * Create new record
     *
     * @return Model
     */

    public function create( array $data )
    {


        try
        {


            return Grade::create( $data );


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
     * @return mixed
     *
     * Delete one record
     */

    public function destroy( int $id )
    {


        return Grade::find($id)->delete();


    }



    /**
     * @inheritdoc
     *
     * @param int $id
     *
     * @return mixed
     *
     * Get a record by its id
     */

    public function get( int $id )
    {


        Grade::find($id);


    }



    /**
     * @inheritdoc
     *
     * @param int $id
     * @param array $data
     *
     * @return bool
     *
     */

    public function update( int $id, array $data )
    {


        try
        {


            return Grade::find( $id )

                        ->update( $data );


        }
        catch ( QueryException $e )
        {


            return false;


        }


    }

}