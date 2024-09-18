<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getLoginInfo($data);
    public function storeRegistrationInfo($data);
}