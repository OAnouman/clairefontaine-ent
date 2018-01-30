<?php

namespace App;


/**
 * Class SchoolYearRepository
 * @package App
 *
 * Author Martial Anouman
 *
 * Represents a school year
 */

class SchoolYear extends Model
{


    protected $fillable = [

        'name',

    ];


    public function schoolYearPeriods()
    {


        return $this->hasMany(SchoolYearPeriod::class);


    }


    public function SchoolFeatures()
    {


        return $this->hasMany(SchoolFeature::class);


    }


    public function clasrooms()
    {


        return $this->hasMany(Classroom::class);


    }


    public function getRoutKeyName()
    {


        return 'name';


    }


}
