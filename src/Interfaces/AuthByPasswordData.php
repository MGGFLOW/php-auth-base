<?php

namespace MGGFLOW\AuthBase\Interfaces;

interface AuthByPasswordData
{
    /**
     * Get User object by Email.
     *
     * @param $email
     * @return object|null
     */
    public function getUserByEmail($email): ?object;

    /**
     * Get User object by Username.
     *
     * @param $username
     * @return object|null
     */
    public function getUserByUsername($username): ?object;
}