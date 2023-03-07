<?php

namespace MGGFLOW\AuthBase\Exceptions;

class NoVerificationCode extends AuthBaseException
{
    protected $message = 'No verification code';
}