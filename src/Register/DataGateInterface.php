<?php

namespace MGGFLOW\PhpAuth\Register;

interface DataGateInterface
{
    /**
     * Create User note by fields array.
     *
     * @param array $fields
     * @return mixed
     */
    public function createUser(array $fields);

    /**
     * Check User existence by Email or Username.
     *
     * @param $email
     * @param $username
     * @return bool
     */
    public function existsByEmailOrUsername($email, $username): bool;
}