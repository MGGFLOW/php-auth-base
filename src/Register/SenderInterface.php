<?php

namespace MGGFLOW\PhpAuth\Register;

interface SenderInterface
{
    /**
     * Send verification code on User Email.
     *
     * @param $email
     * @param $code
     * @return bool
     */
    public function sendCode($email, $code): bool;
}