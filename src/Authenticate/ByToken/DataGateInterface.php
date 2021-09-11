<?php

namespace MGGFLOW\PhpAuth\Authenticate\ByToken;

interface DataGateInterface
{
    public function getUserByToken($token): ?object;
}