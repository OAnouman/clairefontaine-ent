<?php

namespace App;


class Schoolarship extends Model
{

    protected  $fillable  =  [

        'price',

        'level_id',

        'registration_fees',

        ];

    public function level()
    {

        return $this->belongsTo(Level::class);

    }


}
