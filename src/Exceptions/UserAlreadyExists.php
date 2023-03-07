<?php

namespace MGGFLOW\AuthBase\Exceptions;

class UserAlreadyExists extends AuthBaseException
{
    protected $message = 'Login or Email already exists';
}