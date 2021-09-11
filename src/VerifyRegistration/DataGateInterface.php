<?php

namespace MGGFLOW\PhpAuth\VerifyRegistration;

interface DataGateInterface
{
    public function setUserVerifiedByCode($verificationCode) : bool;
}