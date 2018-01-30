<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 1/26/2018
 * Time: 1:56 PM
 */


namespace App\Utils;


class TextUtils
{


    /**
     * Replace specials chars by normal one
     *
     * @param $str
     *
     * @return null|string|string[]
     *
     * @author BBignozz from Openclassrooms.com
     *
     * @version 1.0
     */

    public static function strToNoAccent($str)
    {


        $strToConvert = $str;

        $strToConvert = preg_replace('#Ç#', 'C', $strToConvert);

        $strToConvert = preg_replace('#ç#', 'c', $strToConvert);

        $strToConvert = preg_replace('#è|é|ê|ë#', 'e', $strToConvert);

        $strToConvert = preg_replace('#È|É|Ê|Ë#', 'E', $strToConvert);

        $strToConvert = preg_replace('#à|á|â|ã|ä|å#', 'a', $strToConvert);

        $strToConvert = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $strToConvert);

        $strToConvert = preg_replace('#ì|í|î|ï#', 'i', $strToConvert);

        $strToConvert = preg_replace('#Ì|Í|Î|Ï#', 'I', $strToConvert);

        $strToConvert = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $strToConvert);

        $strToConvert = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $strToConvert);

        $strToConvert = preg_replace('#ù|ú|û|ü#', 'u', $strToConvert);

        $strToConvert = preg_replace('#Ù|Ú|Û|Ü#', 'U', $strToConvert);

        $strToConvert = preg_replace('#ý|ÿ#', 'y', $strToConvert);

        $strToConvert = preg_replace('#Ý#', 'Y', $strToConvert);

        return ($strToConvert);


    }


}