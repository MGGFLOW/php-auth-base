<?php

namespace MGGFLOW\AuthBase\Exceptions;

class UserAlreadyExists extends Exception
{
    protected $message = 'Login or Email already exists';
}