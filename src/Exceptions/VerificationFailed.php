<?php

namespace MGGFLOW\AuthBase\Exceptions;

class VerificationFailed extends AuthBaseException
{
    protected $message = 'Failed to verify';
}