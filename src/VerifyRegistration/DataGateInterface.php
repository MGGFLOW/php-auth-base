<?php

namespace MGGFLOW\PhpAuth\VerifyRegistration;

interface DataGateInterface
{
    /**
     * Change verified state to "true" for User by Verification Code.
     *
     * @param $verificationCode
     * @return bool
     */
    public function setUserVerifiedByCode($verificationCode): bool;
}