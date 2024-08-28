<?php

namespace App\Repository\Task\Interface;

interface TaskRepositoryInterface
{
    public function all($request);
    public function store($request);
    public function update($request);
    public function delete($id);
    public function calculationPercentage();
    public function statusChange($request);

}
