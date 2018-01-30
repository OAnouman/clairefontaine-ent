<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 8/30/2017
 * Time: 8:28 PM
 */


namespace App\Repositories;


use App\SchoolYear;
use Illuminate\Database\QueryException;


class SchoolYearRepository extends Repository
{



    protected $nbPerPage = 20;

    /**
     * @inheritdoc
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */

    public function all()
    {



        return SchoolYear::latest()->get();


    }


    public function allPaginate ()
    {


        return SchoolYear::latest()->paginate($this->nbPerPage);


    }



    /**
     * @inheritdoc
     *
     * @param array $data
     *
     * @return $this|\Illuminate\Database\Eloquent\Model
     *
     * @throws QueryException
     */

    public function create( array $data )
    {



        try
        {


            return SchoolYear::create( $data );


        }
        catch ( QueryException $e )
        {


            return null;


        }


    }



    public function destroy( int $id )
    {



        //Check if thi year has school year periods.

        //If not we can delete it, otherwise cancel deletion


        if ( $schoolYear = SchoolYear::find( $id ) ) {



            if ( count( $schoolYear->schoolYearPeriods ) > 0 ) {

                return false;

            }
            else {


                return SchoolYear::find( $id )

                                 ->delete();


            }


        }


        return false;


    }



    public function get( int $id )
    {



        return SchoolYear::find( $id );


    }



    /**
     * @inheritdoc
     *
     * @param int $id
     * @param array $data
     *
     * @return bool
     *
     * @throws QueryException
     */

    public function update( int $id, array $data )
    {


        try
        {


            return SchoolYear::find( $id )

                             ->update( [ $data ] );


        }
        catch ( QueryException $e )
        {


            return false ;


        }


    }



    /**
     * Get sschool year by name
     *
     * @param $name
     *
     * @return $this
     */

    public function getByName( $name )
    {


        return SchoolYear::where('name', $name)->first();


    }

}