<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 8/31/2017
 * Time: 5:37 PM
 */

namespace App\Repositories;


use App\SchoolYearPeriod;
use Illuminate\Database\QueryException;


class SchoolYearPeriodRepository extends Repository
{

    protected $nbPerPage = 10;



    /**
     * @inheritdoc
     *
     * @return \Illuminate\Database\Query\Builder|static
     */

    public function all()
    {


        return  SchoolYearPeriod::latest();


    }



    public function scopePaginate($query)
    {


        $query->paginate($this->nbPerPage);


    }



    /**
     * @inheritdoc
     *
     * @param array $data
     *
     * @return $this|\Illuminate\Database\Eloquent\Model
     *
     * @throws QueryException if operation fails
     */

    public function create(array $data)
    {


        try
        {


            return SchoolYearPeriod::create( $data );


        }
        catch ( QueryException $e )
        {


            return null;


        }


    }



    public function destroy(int $id)
    {

        // Retrieve school year period, check if it has

        // period assessments. If not we can delete it

        // Otherwise no

        if( $schoolYearPeriod = SchoolYearPeriod::find($id) )
        {


            if( count( $schoolYearPeriod->periodAssessments ) > 0 )
            {


                return false;


            }
            else
            {


                return $schoolYearPeriod->delete();


            }


        }


        return false;


    }




    public function get(int $id)
    {


        return SchoolYearPeriod::find($id);


    }



    /**
     * @inheritdoc
     *
     * @param int $id
     * @param array $data
     *
     * @return bool
     *
     * @throws QueryExceptions
     */

    public function update(int $id, array $data)
    {


        try
        {


            return SchoolYearPeriod::find( $id )

                                   ->update( $data );


        }
        catch ( QueryException $e )
        {


            return false;


        }


    }


}