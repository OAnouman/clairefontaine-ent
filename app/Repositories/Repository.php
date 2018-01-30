<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 8/31/2017
 * Time: 5:38 PM
 */

namespace App\Repositories;


abstract class Repository
{

    protected $nbPerPage;

    /**
     * @return mixed
     *
     * Get all records
     */

    public abstract function all();


    /**
     * @param array $data
     * @return mixed
     *
     * Create new record
     */

    public abstract function create(array $data) ;


    /**
     * @param int $id
     * @return mixed
     *
     * Delete one record
     */

    public abstract  function destroy(int $id);


    /**
     * @param int $id
     * @return mixed
     *
     * Get a record by its id
     */

    public abstract function get(int $id);


    /**
     * @param int $id
     * @param array $data
     * @return mixed
     *
     * Update one record
     */

    public abstract function update(int $id, array $data);

}