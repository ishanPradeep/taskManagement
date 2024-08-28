<?php

namespace App\Repository\User\Interface;

interface UserLevelRepositoryInterface
{
    public function findByScope($scope);

}
