<?php

namespace App\Repositories\User;

use App\Models\User\UserLevel;
use App\Repository\User\Interface\UserLevelRepositoryInterface;

class UserLevelRepository implements UserLevelRepositoryInterface
{
    public function findByScope($scope){
        return UserLevel::where('scope',$scope)->get();
    }
}
