<?php

namespace MGGFLOW\AuthBase\Interfaces;

interface VerifyRegData
{
    /**
     * Change verified state to "true" for User by Verification Code.
     *
     * @param $verificationCode
     * @return bool
     */
    public function setUserVerifiedByCode($verificationCode): bool;
}