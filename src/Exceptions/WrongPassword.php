<?php

namespace MGGFLOW\AuthBase\Exceptions;

class WrongPassword extends AuthBaseException
{
    protected $message = 'Wrong password';
}