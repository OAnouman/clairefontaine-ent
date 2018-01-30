<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 10/17/2017
 * Time: 3:11 PM
 */


namespace App\Api;


class ApiCredential
{


    protected $customerId;

    protected $username;

    protected $password;

    protected $originator;



    public function __construct(array $data)
    {


        $this->customerId =  $data['customer_id'] ;

        $this->username =  $data['username'] ;

        $this->password =  $data['password'] ;

        $this->originator = $data['originator'] ;


    }



    /**
     * @return mixed
     */
    public function getCustomerId()
    {


        return $this->customerId;


    }



    /**
     * @return mixed
     */
    public function getUsername()
    {


        return $this->username;


    }



    /**
     * @return mixed
     */
    public function getPassword()
    {


        return $this->password;


    }



    /**
     * @return mixed
     */
    public function getOriginator()
    {


        return $this->originator;


    }




}