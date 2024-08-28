<?php
namespace App\Repositories\Interface;

use App\Repositories\RepositoryInterface;

interface FeatureRepositoryInterface extends RepositoryInterface
{
    public function getDataByPremiumLevel(int $level);
    public function getDataByFollowPremium(int $level);
    // public function getDataByFollowPremiumId(int $id, $level);
    
}