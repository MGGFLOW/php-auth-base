<?php

namespace MGGFLOW\PhpAuth\Authenticate\ByToken;

interface DataGateInterface
{
    /**
     * Get User object by Access Token.
     *
     * @param $token
     * @return object|null
     */
    public function getUserByToken($token): ?object;
}