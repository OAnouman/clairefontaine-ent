<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 9/23/2017
 * Time: 10:42 AM
 */


namespace App\Repositories;


use App\Evaluation;
use App\Http\Requests\EvaluationRequest;
use Illuminate\Database\QueryException;


class EvaluationRepository extends Repository
{


    protected $nbPerPage = 10;



    /**
     * @inheritdoc
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */

    public function all()
    {


        return Evaluation::latest()->get();


    }


    public function paginate ()
    {


        return Evaluation::latest()->paginate($this->nbPerPage);


    }


    public function create( array $data )
    {


        try
        {


            return Evaluation::create( $data );


        }
        catch ( QueryException $e )
        {


            return false ;


        }


    }


    // TODO : Put this fonctionality in the model boot method or in an observer

    public function destroy( int $id )
    {


        $evaluation = Evaluation::find($id);

        if ( $evaluation->grades()->count() > 0 )
        {


            $evaluation->grades()->delete();


        }

        return Evaluation::find($id)->delete();


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


        return Evaluation::find( $id );


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


            return Evaluation::find( $id )

                             ->update( $data );


        }
        catch ( Exception $e )
        {


            return false;


        }


    }




}