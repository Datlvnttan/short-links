<?php
namespace App\Repositories\Interface;

use App\Repositories\RepositoryInterface;

interface PremiumFeatureRepositoryInterface extends RepositoryInterface
{
    public function getDataByPremium($premium_id);
    public function updateOrCreate(int $premiumid,int $featureid, bool $status);
    public function createOrDelete($premium,int $featureid, bool $create, ?bool $hold = false);
    
}