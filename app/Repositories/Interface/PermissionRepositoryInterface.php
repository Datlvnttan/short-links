<?php
namespace App\Repositories\Interface;

use App\Repositories\RepositoryInterface;

interface PermissionRepositoryInterface extends RepositoryInterface
{
    public function getDataByRole($roleId);
    public function getStatus($roleId,$routeName);
    public function createOrUpdate(int $roleId,int $groupRouteId, bool $status);
    public function getRoutes($roleId);
}
