<?php

namespace MGGFLOW\AuthBase\Exceptions;

class UserCreationFailed extends AuthBaseException
{
    protected $message = 'Failed to create new User';
}