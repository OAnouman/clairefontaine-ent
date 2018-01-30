<?php

namespace App;


/**
 * Class SchoolFeature
 * @package App
 *
 * Author Martial Anouman
 *
 * Represents features a student may subcribe
 * for each year (ex: canteen, school buses)
 *
 */

class SchoolFeature extends Model
{


    public function schoolYear()
    {


        return $this->belongsTo(SchoolYear::class);


    }


}
