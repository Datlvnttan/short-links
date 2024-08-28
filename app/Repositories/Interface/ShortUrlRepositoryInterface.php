<?php
namespace App\Repositories\Interface;

use App\Repositories\RepositoryInterface;

interface ShortUrlRepositoryInterface extends RepositoryInterface
{
    public function deleteWhere(int $id, int $userId);
    public function findByPaginate($field, $value, int $perpage);
    public function getPaginate($status, ?int $perpage);
}
