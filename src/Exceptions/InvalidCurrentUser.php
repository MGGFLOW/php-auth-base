<?php

namespace MGGFLOW\AuthBase\Exceptions;

class InvalidCurrentUser extends AuthBaseException
{
    protected $message = 'Invalid current User data';
}