<?php
namespace App\Repositories\Interface;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * Get paginated records.
     *
     * @param mixed $perPage
     * @param array $columns
     * @return mixed
     */
    public function getSortPaginated(mixed $perPage, ?int $sortUName, ?int $sortBDay,  ?int $sortCreatedAt, mixed $columns = ['*']);
    public function findByField($field_value);
    public function getField($field_value);
    public function checkPassword($id,$password);
}
