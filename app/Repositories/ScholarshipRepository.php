<?php
/**
 * Created by PhpStorm.
 * User: CLAIREFONTAINE
 * Date: 07/02/2018
 * Time: 13:17
 */

namespace App\Repositories;

use App\Repositories\Repository;
use App\Schoolarship;


class ScholarshipRepository extends Repository
{

    /**
     * @inheritdoc
     * @var int
     */
    protected $nbPerPage = 20;

    /**
     * @inheritdoc
     *
     * @return mixed
     */

    public function all()
    {
        return Schoolarship::latest()->get();
    }

    public function allPaginate()
    {

        return Schoolarship::latest()->paginate($this->nbPerPage);

    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function destroy(int $id)
    {
        // TODO: Implement destroy() method.
    }

    public function get(int $id)
    {
        // TODO: Implement get() method.
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }


}