<?php
namespace App\Repositories\Interface;

use App\Repositories\RepositoryInterface;

interface PremiumRepositoryInterface extends RepositoryInterface
{
    public function getLevel();
    public function getDataFeatureWithSmallerLevels(int $id, $level);
}