<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 9/8/2017
 * Time: 5:39 PM
 */


namespace App\Repositories;



use App\Student;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use TextUtils;


class StudentRepository extends Repository
{


    /**
     * Pagination
     *
     * @var int
     */

    protected $nbPerPage = 40;



    /**
     * @inheritdoc
     *
     * @return
     */

    public function all()
    {


        return Student::orderBy('lastname', 'asc');


    }



    /**
     * @inheritdoc
     *
     * @param $query
     */

    public function allPaginate($removedOnly)
    {


        return Student::where('is_removed', $removedOnly)

                      ->orderBy('lastname', 'asc')->paginate($this->nbPerPage);


    }



    /**
     * Get all records matching the given
     *
     * parameter
     *
     * @param $search
     *
     * @param $removedOnly
     *
     * @return $this
     */

    public function match($search, $removedOnly)
    {


        return  Student::latest()

                      ->whereRaw("MATCH(lastname,firstname,reg_number,nationalities,sex) AGAINST (? IN BOOLEAN MODE)",
                                                                                                                        $search)
                      ->where("is_removed", $removedOnly);
                      ;


    }

    /**
     * @inheritdoc
     *
     * @param int $id
     *
     * @return bool|mixed
     */

    public function destroy( int $id )
    {


        if ( $student = Student::find( $id ) ) {


            // We delete student picture before

            // deleting the record

            File::delete( config('image.uploads_path') . '/' . $student->picture);

            $student->delete();

            if ( count( $student->grades ) > 0 ) {


                return $student->grades()->delete();


            }

            return true;


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


        return Student::find($id);


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


        // Validate image

        if( isset($data['picture']) )
        {


            if($filename = $this->validateImage($data['picture']) )
            {


                $data['picture'] = $filename;


            }
            else
            {


                return null;


            }




        }

        // We need to properly format date fields

        $data[ 'birth_date' ] = Carbon::createFromFormat( 'd-m-Y', $data[ 'birth_date' ] );

        $data[ 'subscription_date' ] = Carbon::createFromFormat( 'd-m-Y', $data[ 'subscription_date' ] );

        try
        {


            return Student::find( $id )

                          ->update( $data );


        }
        catch ( QueryException $e )
        {


            return false;


        }


    }

    /**
     * Validate student image
     *
     * @param array $data
     *
     * @return array|bool|null
     */

    public function validateImage($image): string
    {


        // Image validation if present

        if ($image->isValid()) {


            $basePath = config('image.uploads_path');

            $extension = $image->getClientOriginalExtension();

            // Generating random filename

            do {


                $filename = str_random(20) . '.' . $extension;


            } while (file_exists($basePath . '/' . $filename));

            $image->move($basePath, $filename);

            return $filename;


        } else {


            return null;


        }


    }

    /**
     * Parse CSV file from MS SQL DB containing students
     *
     * @param $data
     *
     * @return bool
     */

    public function importCsv ( $data )
    {


        set_time_limit(1000);

        $csvFile = $data['csv'];

        $row = 1;
        
        if ( ( $handle = fopen( $csvFile, "r") ) !== FALSE ) {


            while ( ($data[] = fgetcsv($handle, 0, ';')) !== FALSE) {


                $row++;

                // Last added item

                $lastEntry = end($data);

                if ( ! empty($lastEntry)  )
                {


                    $studentData = [


                        'reg_number' => $lastEntry[ 34 ],

                        'firstname' => ucwords( strtolower( $lastEntry[ 2 ] ) ),

                        'lastname' => $lastEntry[ 1 ],

                        'birth_date' => Carbon::createFromFormat( 'Y-m-d', substr( $lastEntry[ 3 ], 0, 10 ) )
                                              ->format( 'd-m-Y' ),

                        'birth_place' => ucwords( strtolower( $lastEntry[ 40 ] ) ),

                        'origin_school' => ucwords( strtolower( $lastEntry[ 6 ] ) ),

                        'father_name' => $lastEntry[ 15 ],

                        'father_job' => $lastEntry[ 16 ],

                        'father_phones' => str_replace( '+225', '',
                            preg_replace( '/\s+/', '', $lastEntry[ 17 ] . ',' . $lastEntry[ 18 ] . ',' . $lastEntry[ 19 ] ) ),

                        'mother_name' => $lastEntry[ 20 ],

                        'mother_job' => $lastEntry[ 21 ],

                        'mother_phones' => str_replace( '+225', '',
                            preg_replace( '/\s+/', '', $lastEntry[ 22 ] . ',' . $lastEntry[ 23 ] . ',' . $lastEntry[ 24 ] ) ),

                        'living_place' => $lastEntry[ 25 ],

                        'address' => $lastEntry[ 26 ],

                        'emails' => $this->validateMail( strstr( $lastEntry[ 27 ], '@' ) === false ? '' : ( $lastEntry[ 27 ] === '0@0.fr' ) ? '' : $lastEntry[ 27 ] ),

                        'guardian_name' => $lastEntry{29},

                        'guardian_phones' => $lastEntry[ 30 ],

                        'sex' => strtolower( $lastEntry[ 35 ] ),

                        'subscription_date' => Carbon::createFromFormat( 'Y-m-d', substr( $lastEntry[ 36 ], 0, 10 ) )
                                                     ->format( 'd-m-Y' ),

                        'second_living_language' => $this->getLivingLanguageName( $lastEntry[ 43 ] ),


                    ];

                    $this->create( $studentData );


                }


            }

            fclose($handle);

            set_time_limit(120);

            return true;

        }
        else
        {


            return false;


        }


    }

    public function validateMail($email)
    {


        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


            return $email;


        }

        return '';


    }

    public function getLivingLanguageName ($index)
    {


        switch ($index)
        {


            case 1 :

                return 'Allemand';

                break;

            case 2 :

                return 'Espagnol';

                break;

            default :

                return '';

                break;


        }


    }

    /**
     * @inheritdoc
     *
     * @param array $data
     *
     * @return $this|\Illuminate\Database\Eloquent\Model
     */

    public function create(array $data)
    {


        if (isset($data['picture'])) {


            if ($filename = $this->validateImage($data['picture'])) {

                $data['picture'] = $filename;

            } else {


                return null;


            }


        }

        // Generating username

        /*
         * Turn firstname to array
         */
        $firstnames = explode(' ', $data['firstname']);
        $formattedFirstname = '';
        foreach ($firstnames as $f) {
            $formattedFirstname .= $formattedFirstname ? '-' . $f : $f;
        }

        $data['username'] = TextUtils::strToNoAccent(strtolower($data['firstname']))
            . '.' .
            TextUtils::strToNoAccent(
                str_replace(' ', '.', strtolower($data['lastname']))
            )
            . '@clfe-ent.ci';


        // We need to properly format date fields

        $data['birth_date'] = Carbon::createFromFormat('d-m-Y', $data['birth_date']);

        $data['subscription_date'] = Carbon::createFromFormat('d-m-Y', $data['subscription_date']);

        try {


            return Student::create($data);


        } catch (QueryException $e) {

            dd($e);
//            return null;


        }


    }


}