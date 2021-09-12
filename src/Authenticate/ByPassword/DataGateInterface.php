<?php

namespace MGGFLOW\PhpAuth\Authenticate\ByPassword;

interface DataGateInterface
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