<?php

namespace MGGFLOW\PhpAuth\Interfaces;

interface RegisterData
{
    /**
     * Create User note by fields array.
     *
     * @param array $fields
     * @return mixed
     */
    public function createUser(array $fields) : ?int;

    /**
     * Check User existence by Email or Username.
     *
     * @param $email
     * @param $username
     * @return bool
     */
    public function existsByEmailOrUsername($email, $username): bool;
}