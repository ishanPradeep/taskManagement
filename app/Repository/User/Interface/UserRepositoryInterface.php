<?php

namespace App\Repository\User\Interface;

interface UserRepositoryInterface
{
    public function all($request);
    public function update($request);
}
