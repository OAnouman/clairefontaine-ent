<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 1/26/2018
 * Time: 3:15 PM
 */


namespace App\Observers;

use App\Grade;
use App\Notifications\GradeNotification;


class GradeObserver
{


    public function created(Grade $grade)
    {


        $grade->notify( new GradeNotification( $grade, $grade->student ));


    }

}