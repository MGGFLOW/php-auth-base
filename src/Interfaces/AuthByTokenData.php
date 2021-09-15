<?php

namespace MGGFLOW\PhpAuth\Interfaces;

interface AuthByTokenData
{
    /**
     * Get User object by Access Token.
     *
     * @param $token
     * @return object|null
     */
    public function getUserByToken($token): ?object;
}