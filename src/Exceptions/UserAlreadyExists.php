<?php

namespace MGGFLOW\PhpAuth\Exceptions;

class UserAlreadyExists extends Exception
{
    protected $message = 'Login or Email already exists';
}